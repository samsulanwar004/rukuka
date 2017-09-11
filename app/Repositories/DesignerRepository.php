<?php

namespace App\Repositories;

use App\Designer;

class DesignerRepository
{

	public function getDesigners()
	{
		return Designer::get()->toArray();
	}
}