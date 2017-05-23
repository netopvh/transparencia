<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 05/05/2017
 * Time: 15:36
 */

namespace App\Helpers;

use League\Flysystem\Exception;

class UploadHelper
{

    public static function UploadFile($file, $destinationPath, $fileName = NULL)
    {
        if( $file->isValid() )
        {
            $file->move(public_path($destinationPath), $fileName );
            return TRUE;
        }
        else {
            throw new Exception( "Something is wrong with the file." );
        }
    }

}