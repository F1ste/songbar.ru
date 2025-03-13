<?php

namespace App\Http\Controllers\Admin;

use App\Enum\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubdomainRequest;
use App\Models\Catalog;
use App\Models\Design;
use App\Models\Info;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use App\Jobs\ProcessExcelChunk;
use App\Models\ProcessingStatus;
use Faker\Factory as FakerFactory;
use App\Http\Requests\FilterRequest;
use App\Http\Filters\SongFilter;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    use WithFaker;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $catalogs = $user->catalogs;  

        return view('admin.catalog.index', compact('catalogs'));
    }

    public function preview(Request $request) 
    {
        $catalog_id = $request->catalog_id;
        $catalog = Catalog::findOrFail($catalog_id);
        $design = Design::where('catalog_id', $catalog_id)->first();
        $info = Info::where('catalog_id', $catalog_id)->first();
 
        return view('template', [
            'design' => $design,
            'info' => $info,
            'catalog_id' => $catalog_id,
            'head_script' => $catalog->head_script,
            'body_script' => $catalog->body_script,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate::authorize('createCatalog', User::class);
        $user_id = Auth::id();
        $catalog = new Catalog();
        $catalog->user_id = $user_id;
        $faker = FakerFactory::create();
        $catalog->address = $faker->unique()->lexify('????????');
        $catalog->save();

        $info = new Info();
        $info->catalog_id = $catalog->id;
        $info->save();
        $design = new Design();
        $design->catalog_id = $catalog->id;
        $design->save();

        return redirect()->route('catalog.edit', ['id' => $catalog->id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $catalog = Catalog::find($request->id);
        $catalogViews = [
            'catalogDay' => $catalog->view_per_day,
            'catalogWeek' => $catalog->view_per_week,
            'catalogMonth' => $catalog->view_per_month,
            'catalogAll' => $catalog->view_per_all,
        ];
        $design = Design::where('catalog_id', $request->id)->first();
        $info = Info::where('catalog_id', $request->id)->first();
        $songs = $catalog->songs();
        $countSongs = $songs->count();

        $songsViews = [
            'songsDay' => $catalog->songsByDay()->take(10)->get(),
            'songsWeek' => $catalog->songsByWeek()->take(10)->get(),
            'songsMonth' => $catalog->songsByMonth()->take(10)->get(),
            'songsAll' => $catalog->songsByAll()->take(10)->get(),
            'allViewsDay' => $songs->sum('songs.view_per_day'),
            'allViewsWeek' => $songs->sum('songs.view_per_week'),
            'allViewsMonth' => $songs->sum('songs.view_per_month'),
            'allViewsAllTime' => $songs->sum('songs.view_per_all'),
        ];
        return view('admin.catalog.edit', compact('design', 'info', 'catalog', 'songsViews', 'catalogViews', 'countSongs'));
    }

    public function fetchSongs(FilterRequest $request)
    {
        $filter = app()->make(SongFilter::class, ['queryParams' => ($request->validated())]);

        $catalog = Catalog::find($request->catalogId);
        $songs = $catalog->songs()->filter($filter)->paginate(20);

        if ($request->has('songInput') && $songs->isNotEmpty() && !strpos($_SERVER['HTTP_REFERER'], 'admin_panel')) {
            $songs->take(5)->each(function ($song) {
                $song->viewsCount();
            });
        }

        return response()->json([
            'songs' => $songs->items(),
            'pagination' => $songs->links()->render(),
        ]);
    }

    private function generateQRCode($catalog)
    {
        // Создание экземпляра QR-кода
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data('https://' . $catalog->address . '.songbar.ru')
            ->size(300)
            ->margin(10)
            ->build();

        // Сохранение QR-кода в формате PNG
        $filename = 'qr-' . $catalog->address . '.png';
        $path = storage_path('app/public/' . $filename);
        file_put_contents($path, $result->getString());
        // Возвращение Data URI и URL файла
        $downloadUrl = Storage::url($filename);
        $catalog->update(['qr_code_path' => $downloadUrl]);

        // Получение Data URI
        $dataUri = $result->getDataUri();

        // Возвращение Data URI и ссылки для скачивания в JSON
        return response()->json([
            'qr_code' => $dataUri,
            'download_link' => $downloadUrl,
            'href' => 'https://' . $catalog->address . '.songbar.ru'
        ]);
    }

    public function infoupdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'logo' => 'file|mimes:jpg,png,jpeg,gif,svg,pdf|max:2048',
        ]);


        $catalog = Catalog::find($request->catalog_id);
        $info = Info::where('catalog_id', $catalog->id)->first();

        if (is_null($info)) {
            $info = new Info();
            $info->catalog_id = $request->catalog_id;
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $info->logo = 'uploads/' . $fileName;
        }

        if ($user->hasRole([RoleEnum::MEDIUM->value, RoleEnum::VIP->value, RoleEnum::ADMIN->value])) {
            $info->contact = nl2br($request->contact);
            $info->button_text = $request->button_text;
            $info->button_href = $request->button_href;
            $info->ourlogo = $request->ourlogo;
        }



        if ($info->save()) {
            if (isset($catalog->address)) {
                return $this->generateQRCode($catalog);
            }
        }

        return response()->json(['message' => 'Form submitted successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $catalog = Catalog::find($id);
        $catalog->delete();
        return redirect()->route('catalogs')->withSuccess('Каталог удален!');
    }

    public function updateField(Request $request)
    {
        Gate::authorize('updateDesign', User::class);
        $fieldName = $request->input('fieldName');
        $fieldName = str_replace('-', '_', $fieldName);
        $fieldValue = $request->input('fieldValue');
        $catalog_id = $request->input('catalog_id');

        $design = Design::where('catalog_id', $catalog_id)->first();
        $design->$fieldName = $fieldValue;

        $design->save();

        return response()->json(['success' => true, 'message' => 'Данные обновлены']);
    }

    public function importExcell(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        $catalogId = $request->input('catalog_id');

        $filePath = $file->store('uploads');

        $fullFilePath = storage_path('/app/' . $filePath);

        ProcessExcelChunk::dispatch($fullFilePath, $catalogId, 1, 1000);

        return response()->json(['message' => 'Файл загружен и будет обработан в фоновом режиме.']);
    }


    public function checkProgress(Request $request)
    {
        $catalogId = $request->query('catalog_id');

        $status = ProcessingStatus::where('catalog_id', $catalogId)->first();

        if (!$status) {
            return response()->json(['error' => 'Статус не найден.'], 404);
        }

        $totalRows = $status->total_rows;
        $processedRows = $status->processed_rows;
        $progress = $totalRows > 0 ? ($processedRows / $totalRows) * 100 : 0;
        $statusText = $status->status;

        return response()->json([
            'progress' => $progress,
            'processed_rows' => $processedRows,
            'total_rows' => $totalRows,
            'status' => $statusText
        ]);
    }

    public function editSubdomain(SubdomainRequest $request)
    {
        Gate::authorize('updateDomainName', User::class);
        $catalog = Catalog::find($request->input('catalog_id'));

        if (!$catalog) {
            return redirect()->back()->withErrors(['message' => 'Каталог не найден']);
        }

        
        $catalog->update([
            'address' => $request->input('address')
        ]);

        $this->generateQRCode($catalog);

        return redirect()->back()->with('success', 'Поддомен успешно сохранен');
    }

    public function changeIsPublish(Request $request, $id)
    {
        // Gate::authorize('updateInfo', User::class);
        $catalog = Catalog::findOrFail($id);

        $catalog->is_published = !$catalog->is_published;
        
        $catalog->save();

        return redirect()->back()->with('success', 'Статус публикации успешно изменён.');
    }

    public function saveScripts(Request $request, $id)
    {
        Gate::authorize('updateCustomHTML', User::class);
        $catalog = Catalog::findOrFail($id);

        $catalog->head_script = $request['head-script'];
        $catalog->body_script = $request['body-script'];
        $catalog->save();

        return redirect()->back()->with('success', 'Скрипты успешно сохранены.');
    }
}
