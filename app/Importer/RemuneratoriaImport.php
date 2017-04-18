<?php

namespace App\Importer;


use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Files\ExcelFile;

class RemuneratoriaImport extends ExcelFile
{

    public function getFile()
    {
        $file = Input::file('arquivo');
        $filename = 'storage/app/'.$file->store('exports');

        return $filename;
    }

    public function getFilters()
    {
        return [
            'chunk'
        ];
    }
}