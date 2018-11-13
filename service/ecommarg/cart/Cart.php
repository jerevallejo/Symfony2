<?php 
	namespace ecommarg\cart;
	use ecommarg\cart\SaveAdapterInterface as SaveAdapter;
	use ecommarg\cart\ProductoInterface as Product;

	class Cart implements CartInterface
	{
		Private $adapter;

		public function __construct(SaveAdapter $adapter)
		{
			$this->adapter = $adapter;	
		}


		public function add(Product $product)
		{
			$this->adapter->set($product->getId(), json_encode($product ));
		}

		public function get($id)
		{
			return $this->get($id);
		}

	}



 