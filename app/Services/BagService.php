<?php

namespace App\Services;

use Cart;
use App\Repositories\OrderRepository;

class BagService
{

	public function save($product, $instance)
	{
		return Cart::instance($instance)
			->add($product);
	}

	public function get($instance)
	{
		return Cart::instance($instance)
			->content();
	}

	public function subtotal()
	{
		return Cart::subtotal();
	}

	public function total()
	{
		return Cart::total();
	}

	public function search($id, $instance)
	{
		$bags = $this->get($instance);

		return $bags->search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });
	}

	public function getItemByRowId($rowId)
	{
		return Cart::get($rowId);
	}

	public function update($rowId, $qty)
	{
		return Cart::update($rowId, $qty);
	}

	public function remove($rowId)
	{
		return Cart::remove($rowId);
	}

	public function restock($stockId, $decrease)
	{
		$stock = (new OrderRepository)->getStockById($stockId);
        $newUnitStock = $stock->unit - $decrease;
        $stock->unit = $newUnitStock <= 0 ? 0 : $newUnitStock;
        $stock->timestamps = false;

        $stock->update();
	}
}