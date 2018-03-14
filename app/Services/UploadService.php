<?php

namespace App\Services;

use Storage;
use Exception;

class UploadService
{

    public function uploadProductImage($driver, $userId, $file, $filename)
    {

        try {
            $folder = 'products/';
            // $folder = 'uploads/'.date('Y-m');

            $images = [
              'original' => [
                'file' => \Image::make($file)
                  ->encode(),
                'fileName' => $filename,
              ]
            ];

            $sizes = [
              'small' => [
                'width' => 200,
                'height' => 250,
              ],
              'medium' => [
                'width' => 400,
                'height' => 500,
              ],
            ];

            foreach ($sizes as $size => $detail) {
              $nameExplosion = explode('.', $filename);
              $currentFile = $file;


              $images[$size] = [
                'file' => \Image::make($file)
                  ->resize($detail['width'], $detail['height'])
                  ->encode(),
                'fileName' => $nameExplosion[0] . '-' . $size . '.' . $nameExplosion[1],
              ];
            }

            $driver = Storage::disk($driver);
            foreach ($images as $image) {
                $driver->put($folder . $image['fileName'], $image['file']->stream()->__toString(), 'public');
                // Storage::disk($driver)->putFileAs($folder, new \File($image['file']->stream()->__toString()), $image['fileName'], 'public');
            }

            return $folder . $filename;
            // $driver->put($filename, $file, 'public');

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
