<?php

namespace App\Repositories;

use App\ProductStock;

class ProductStockRepository
{

	public function model()
	{
		return new ProductStock;
	}

	public function getStockBySku($sku)
	{
		return $this->model()
			->where('sku', $sku)
			->first();
	}
}