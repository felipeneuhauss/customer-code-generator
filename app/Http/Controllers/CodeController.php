<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Code;
use App\Models\ExportedFile;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Facades\Crypt;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CodeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = Code::all();
        return $codes;
    }
    
    public function generate() 
    {
        
        //if (Request::isMethod('post')) {
            $quantity = 5;//Request::input('quantity');
            $codes = [];
            for ($i = 0; $i < $quantity ; $i++) {
                $repetedCode = false;
                while (!$repetedCode) {
                    $codeGenerated = $this->_generateCode();
                    
                    if (!Code::where('code', $codeGenerated)->first()) {
                        
                        $qrCode = new QrCode(url('/check-code/'.$codeGenerated));
                        $qrCodeImage = $codeGenerated.'.png';
                        $storeDir = storage_path('app/public/codes').'/'.$qrCodeImage;
                        $qrCode->writeFile($storeDir);
                        
                        $code = Code::findOrNew(null);
                        $code->code = $codeGenerated;
                        $code->picture = $qrCodeImage;
                        $code->save();
                        $codes[] = $code;
                        
                        $repetedCode = true;
                    } else {
                        $repetedCode = false;
                    }
                }
            }
            
            $this->_exportCodesIntoAXLSFIle($codes);
            
        // }
    }
    
    public function check($code) {
        if (Code::where('code', $code)->first()) {
            return 'ok';
        }
        return 'ops';
    }
    
    private function _generateCode() 
    {
        $numbers = '0123456789';
        $numbersLength = strlen($numbers);
        $randomNumber = '';
        for ($i = 0; $i < 5; $i++) {
            $randomNumber .= $numbers[rand(0, $numbersLength - 1)];
        }
        
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 4; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return $randomString.$randomNumber;
    }
    
    private function _exportCodesIntoAXLSFIle($codes) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        foreach($codes as $key => $code) {
            $sheet->setCellValue('A'.$key, $code->code);    
            $sheet->setCellValue('B'.$key);
        }
        
        $writer = new Xlsx($spreadsheet);
        $xlsFileName = date('Y_m_d_H_i').'.xlsx';
        $exportDir = storage_path('app/public/exports').'/'.$xlsFileName;
        
        $exportedFile = ExportedFile::findOrNew(null);
        $exportedFile->name = $xlsFileName;
        $exportedFile->location = storage_path('app/public/exports').'/';
        $exportedFile->save();
        dd($exportDir);
        $writer->save($exportDir);
    }
    
 
}
