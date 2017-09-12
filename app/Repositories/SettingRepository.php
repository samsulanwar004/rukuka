<?php

namespace App\Repositories;

use App\Setting;

class SettingRepository
{
	public function getSettingByGroup($group)
	{
		return Setting::where('group_setting', $group)
	    	->get();
	}
}