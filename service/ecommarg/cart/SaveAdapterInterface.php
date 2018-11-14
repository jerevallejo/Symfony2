<?php 
namespace ecommarg\cart;
use ecommarg\cart\ProductoInterface as Product;

	interface SaveAdapterInterface
	{
		public function set($key, $value);

		public function get($id);

		public function getAll();
	}


 