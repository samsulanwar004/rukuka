<?php

namespace App\Repositories;

use App\Setting;
use App\MainSlider;

class SettingRepository
{
	public function getSettingByGroup($group)
	{
		return Setting::where('group_setting', $group)
	    	->get();
	}

	public function getSliderByGroup($group)
	{
		return MainSlider::where('group_setting', $group)
	    	->get();
	}
}