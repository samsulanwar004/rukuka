<?php

namespace App\Repositories;

use App\Designer;
use App\Setting;

class DesignerRepository
{

	public function getDesigners()
	{
		return Designer::whereNull('deleted_at')->get()->toArray();
	}

    public function getDesignersNav()
    {
        return Setting::where('group_setting','Designer Navigation')->get()->toArray();
    }

    public function getWomensNav()
    {
        return Setting::where('group_setting','Women Navigation')->get()->toArray();
    }

    public function getMensNav()
    {
        return Setting::where('group_setting','Men Navigation')->get()->toArray();
    }

    public function getKidsNav()
    {
        return Setting::where('group_setting','Kids Navigation')->get()->toArray();
    }
}