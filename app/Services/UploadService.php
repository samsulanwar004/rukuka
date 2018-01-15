<?php

namespace App\Services;

use Storage;
use Exception;

class UploadService
{
 
    public function uploadProductImage($driver, $userId, $file, $filename)
    {
        try {
            Storage::disk($driver)->putFileAs('uploads/'.$userId.'/'.date('Y-m'), $file, $filename, 'public');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());  
        }
    }
}