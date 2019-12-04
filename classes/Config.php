<?php
class Config
{
	public static function get($path = null)
	{
		if($path)
		 {
			$config = $GLOBALS['config'];
			$path = explode('/', $path);

			foreach($path as $element) 
			{
				if(isset($config[$element]))
				{
					$config = $config[$element];
				}
			}
			return $config;
			
		}
		//return false;
	}
}