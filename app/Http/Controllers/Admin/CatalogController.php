<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Design;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel as ExcelExcel;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Upload;
use Illuminate\Support\Facades\Log;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\ProcessExcelChunk;


class CatalogController extends Controller
{
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
            $table = 'catalogs'; // Название таблицы
            $column = 'address'; // Название столбца, где должна быть уникальная строка           
            $uniqueString = $this->generateUniqueString($table, $column);
            $catalog->address = $uniqueString;
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Catalog $catalog)
    {
        //
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }
    
    
    public function infoupdate(Request $request)
    {
        // Валидация данных
        $request->validate([
            'logo' => 'required|file|mimes:jpg,png,jpeg,gif,svg,pdf|max:2048',
        ]);

        

        
        $catalog = Catalog::find($request->catalog_id);
        if(!isset($catalog->address)){ 
            $table = 'catalogs'; // Название таблицы
            $column = 'address'; // Название столбца, где должна быть уникальная строка           
            $uniqueString = $this->generateUniqueString($table, $column);
            $catalog->address = $uniqueString;
            $catalog->save();
        }
        //$design = Design::where('catalog_id', $catalog->id)->first();
        $info = Info::where('catalog_id', $catalog->id)->first();

        // Сохранение данных в базу
        if(!isset($info)){
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
        $fieldName = str_replace('-','_',$fieldName);
        $fieldValue = $request->input('fieldValue');
        $catalog_id = $request->input('catalog_id');

        // Обновление поля в базе данных
        // Предположим, что вы обновляете запись с ID = 1. Замените это на необходимую логику.       
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
            'file' => 'required|mimes:xlsx,xls'
        ]);

        ini_set('memory_limit', '1000M'); // Увеличение лимита памяти
        ini_set('max_execution_time', 300); // Увеличение времени выполнения

        
            // Декодируем файл из base64
            $file = $request->file('file');
            $catalogId = $request->input('catalog_id');

            $path = $file->store('uploads');
        //$totalRows = $this->getRowCount($file);

        $upload = Upload::create([
            'file_path' => $path,
            'catalog_id' => $request->catalog_id,
        ]);        

        return response()->json(['message' => 'Файл загружен','path'=>$path]);

            /*// Читаем файл XLSX в массив
            $import = new XlsxImport();
            $data = Excel::import($import, $file);
    
            // Экспортируем данные в CSV
            $csvExport = new CsvExport($import->array($data));
    
            $csvFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.csv';
            return Excel::download($csvExport, $csvFilename, \Maatwebsite\Excel\Excel::CSV);*/
    }


    public function getStatus(Request $request)
    {
        
        
        $temp = ProcessExcelChunk::dispatch($request->filePath, 1);

        return response()->json(['message' => 'File uploaded and processing started.','result' => $temp]);
    }

    public function generateUniqueString($table, $column, $length = 8)
    {
        do {
            // Генерация случайной строки
            $string = Str::random($length);

            // Проверка уникальности строки в указанной таблице и столбце
            $exists = DB::table($table)->where($column, $string)->exists();
        } while ($exists);

        return $string;
    }
    
}
