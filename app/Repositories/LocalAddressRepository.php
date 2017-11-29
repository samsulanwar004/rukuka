<?php

namespace App\Repositories;

use App\Countries;
use App\LocalAddress;

class LocalAddressRepository
{
	public function processGetAllCountry()
	{
		$countries = Countries::orderBy('countries_name','asc')->get();

		if (count($countries) > 0) {

			return $this->result('000','success', $countries);

		}else{

			return $this->result('999','List of countries not available', $countries);

		}
	}

	public function processGetAllProvince(){

		$provinces = LocalAddress::select('province')->orderBy('province','asc')->distinct()->get();
		
		if (count($provinces) > 0) {

			return $this->result('000','success', $provinces);

		}else{

			return $this->result('999','List of provinces not available', $provinces);

		}
	}

	public function processGetAllCity($byProvince){

		if ($byProvince == null) {
			
			$cities = LocalAddress::select('city')->orderBy('city','asc')->distinct()->get();

		}else{

			$cities = LocalAddress::select('city')->where('province','=', $byProvince)->orderBy('city','asc')->distinct()->get();

		}
		
		if (count($cities) > 0) {

			return $this->result('000','success', $cities);

		}else{

			return $this->result('999','List of cities not available', $cities);

		}
	}

	public function processGetAllSubDistrict($byCity){

		if ($byCity == null) {
			
			$subDistricts = LocalAddress::select('sub_district')->orderBy('sub_district','asc')->distinct()->get();

		}else{

			$subDistricts = LocalAddress::select('sub_district')->where('city','=', $byCity)->orderBy('sub_district','asc')->distinct()->get();

		}
		
		if (count($subDistricts) > 0) {

			return $this->result('000','success', $subDistricts);

		}else{

			return $this->result('999','List of Sub District not available', $subDistricts);

		}
	}

	public function processGetAllVillage($bySubDistrict){

		if ($bySubDistrict == null) {
			
			$villages = LocalAddress::select('village', 'postal_code')->orderBy('village','asc')->distinct('village')->get();

		}else{

			$villages = LocalAddress::select('village', 'postal_code')->where('sub_district','=', $bySubDistrict)->orderBy('village','asc')->distinct('village')->get();

		}
		
		if (count($villages) > 0) {

			return $this->result('000','success', $villages);

		}else{

			return $this->result('999','List of villages not available', $villages);

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