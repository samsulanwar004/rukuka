<?php

namespace App\Repositories;

use App\Countries;

class LocalAddressRepository
{
	public function processGetAllCountry()
	{
		$countries = Countries::orderBy('countries_name','asc')->get();

		if (count($countries) > 0) {

			return $this->result('000','success', $countries);

		}else{

			return $this->result('999','List of countries not available', null);

		}
	}

	public function result($error, $msg, $data){
		return
			[ 
				'error' => $error,
				'message' => $msg,
				'data' => $data
			];
	}
}