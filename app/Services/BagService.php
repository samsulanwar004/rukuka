<?php

namespace App\Services;

use Cart;

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
}