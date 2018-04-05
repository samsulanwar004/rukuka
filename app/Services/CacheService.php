<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
	const SETTING_HOME_CACHE = 'setting.home.cache';
    const SETTING_MEN_CACHE = 'setting.men.cache';
    const SETTING_WOMEN_CACHE = 'setting.women.cache';
    const SLIDER_HOME_CACHE = 'slider.home.cache';
    const SLIDER_MEN_CACHE = 'slider.men.cache';
    const SLIDER_WOMEN_CACHE = 'slider.women.cache';
    const DESIGNER_CACHE = 'designer.cache';
    CONST MENU_CACHE = 'menu.cache';
    CONST POPULAR_CACHE = 'popular.cache';
    CONST COLOR_CACHE = 'color.cache';

	public function clearCacheSetting()
	{
		Cache::forget(self::SETTING_HOME_CACHE);
		Cache::forget(self::SETTING_MEN_CACHE);
		Cache::forget(self::SETTING_WOMEN_CACHE);
	}

	public function clearCacheSlider()
	{
		Cache::forget(self::SLIDER_HOME_CACHE);
		Cache::forget(self::SLIDER_WOMEN_CACHE);
		Cache::forget(self::SLIDER_MEN_CACHE);
	}

	public function clearCacheDesigner()
	{
		Cache::forget(self::DESIGNER_CACHE);
	}

	public function clearCacheMenu()
	{
		Cache::forget(self::MENU_CACHE);
	}

	public function clearCachePopular()
	{
		$popular = array('Homepage', 'Women', 'Men');

		foreach ($popular as $group) {
			Cache::forget(self::POPULAR_CACHE.'.'.$group);
		}
	}

	public function clearCacheColor()
	{
		Cache::forget(self::COLOR_CACHE);
	}
}