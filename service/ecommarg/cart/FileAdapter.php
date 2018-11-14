<?php 

namespace ecommarg\cart;

use ecommarg\cart\SaveAdapterInterface;

Class FileAdapter implements SaveAdapterInterface
{
	CONST FILE= 'ecommarg_cart_list.txt';
	private $file =null;

	public function __construct($path, $file=null)
	{
		//sprintf es para concatenar de manera elegante lo que va en  %s es lçel prmier argumento,
		//  la barrra es una constante y el siguiente %s es el siguiente parametro 
		$this->file = sprintf('%s/%s', $path, null===$file ? self::FILE: $file);
	}
	public function set($key, $value)
	{
		file_put_contents($this->file, "$key=$value\n", \FILE_APPEND);
	}
	
	public function get($key)
	{
		return file_get_contents($this->file);
	}

	public function getAll()
	{
		return $this->get('');
	}

}