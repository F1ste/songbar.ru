<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Design;
use App\Models\Info;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use App\Jobs\ProcessExcelChunk;
use App\Models\ProcessingStatus;
use Faker\Factory as FakerFactory;

class CatalogController extends Controller
{
    use WithFaker;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        return view('admin.catalog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = Auth::id();
        $catalog = new Catalog();
        $catalog->user_id = $user_id;
            $faker = FakerFactory::create();
            $catalog->address = $faker->unique()->lexify('????????');
            $catalog_temaddress = $catalog->address.'.songbar.ru';
            $catalog->save();

            $info = new Info();
            $info->catalog_id = $catalog->id;
            $info->save();
            $design = new Design();        
            $design->catalog_id = $catalog->id;
            $design->save();

        return view('admin.catalog.create', compact('catalog','info','design','catalog_temaddress'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $catalog = Catalog::find($request->id);
        $design = Design::where('catalog_id', $request->id)->first();
        $info = Info::where('catalog_id', $request->id)->first();
        return view('admin.catalog.edit', compact('design','info','catalog'));
    }
    
    public function infoupdate(Request $request)
    {
        $request->validate([
            'logo' => 'required|file|mimes:jpg,png,jpeg,gif,svg,pdf|max:2048',
        ]);

        
        $catalog = Catalog::find($request->catalog_id);
        $info = Info::where('catalog_id', $catalog->id)->first();

        if(is_null($info)){
            $info = new Info();
            $info->catalog_id = $request->catalog_id;
        }        
        
        // Обработка файла
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $info->logo = 'uploads/' . $fileName;
        }

        $info->contact = nl2br($request->contact);
        $info->	button_text = $request->button_text;
        $info->	button_href = $request->button_href;
        $info->	ourlogo = $request->ourlogo;
        
        
        if($info->save()){
            if(isset($catalog->address)){
                // Создание экземпляра QR-кода
                $result = Builder::create()
                ->writer(new PngWriter())
                ->data('https://'.$catalog->address.'.songbar.ru')
                ->size(300)
                ->margin(10)
                ->build();

                // Сохранение QR-кода в формате PNG
                $filename = 'qr-'.$catalog->address.'.png';
                $path = storage_path('app/public/' . $filename);
                file_put_contents($path, $result->getString());
                // Возвращение Data URI и URL файла
                $downloadUrl = asset('storage/' . $filename);

                // Получение Data URI
                $dataUri = $result->getDataUri();

                // Возвращение Data URI и ссылки для скачивания в JSON
                return response()->json([
                    'qr_code' => $dataUri,
                    'download_link' => $downloadUrl,
                    'href' => 'https://'.$catalog->address.'.songbar.ru'
                ]);
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
        $catalog ->delete();
        return redirect()->back()->withSuccess('Каталог удален!');
    }

    public function updateField(Request $request)
    {
        $fieldName = $request->input('fieldName');
        $fieldName = str_replace('-','_', $fieldName);
        $fieldValue = $request->input('fieldValue');
        $catalog_id = $request->input('catalog_id');
    
        $design = Design::where('catalog_id', $catalog_id)->first();
        if(!$design){
            $design = new Design();
            $design->catalog_id = $catalog_id;
        }
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
    
        $fullFilePath = storage_path('\/app/' . $filePath);
    
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
}
