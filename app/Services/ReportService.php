<?php

namespace App\Services;

use Storage;

class ReportService
{
	public function export($results, $data)
	{

        if ($data['type'] == 'new') {
        	$filename = $data['filename'];
            $title = 'No,'.strtoupper(str_replace('_', ' ', implode(',', $data['attribute'])));
            Storage::disk('csv')->put($filename, $title);
            $no = 1;
            foreach ($results as $row) {
            	$baris = [];
            	foreach ($data['attribute'] as $value) {
            		$baris[] = $row->{$value};
            	}
                $baris = $no . ',' . implode(',', $baris);
                Storage::disk('csv')->append($filename, $baris);
                $no++;
            }

        } else {
            if ($data['type'] == 'next') {
                $filename = $data['filename'];
                $no = $data['no'];
                foreach ($results as $row) {
                    $baris = [];
	            	foreach ($data['attribute'] as $value) {
	            		$baris[] = $row->{$value};
	            	}
	                $baris = $no . ',' . implode(',', $baris);
                	Storage::disk('csv')->append($filename, $baris);
                    $no++;
                }
            }
        }

        $lastPage = $results->lastPage();
        $params = [
            'type_request' => ($lastPage == $data['page'] || count($results) == 0) ? 'download' : 'next',
            'filename' => $filename,
            'page' => $data['page'] + 1,
            'no' => $no,
            'last' => $lastPage,
        ];

        return $params;
	}
}