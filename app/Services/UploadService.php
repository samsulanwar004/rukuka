<?php

namespace App\Services;

use Storage;
use Exception;
use App\Libraries\ImageFile;

class UploadService
{
    public function imageFromUrl($url)
    {
      
    }

    public function uploadProductImage($file)
    {

        try {
            $folder = 'products/';

            $random = date('YmdHis').rand(0,99);

            $filenameOriginal = sprintf(
                "%s-%s.%s",
                $random,
                'original',
                $file->getClientOriginalExtension()
            );

            $filename = sprintf(
                "%s.%s",
                $random,
                $file->getClientOriginalExtension()
            );

            $images = [
              'original' => [
                'file' => \Image::make($file)
                  ->encode(),
                'fileName' => $filenameOriginal,
              ]
            ];

            $sizes = [
              'small' => [
                'width' => config('common.image.small.width'),
                'height' => config('common.image.small.height'),
              ],
              'medium' => [
                'width' => config('common.image.medium.width'),
                'height' => config('common.image.medium.height'),
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

            $driver = Storage::disk();
            foreach ($images as $image) {
                $driver->put($folder . $image['fileName'], $image['file']->stream()->__toString(), 'public');
            }

            return $folder . $filenameOriginal;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
