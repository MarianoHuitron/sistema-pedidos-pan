<?php

class Conexion 
{
	public function conectar()
	{
		$link = new PDO("mysql:host=localhost; dbname=web_tic32; charset=UTF8", "root", "");

		return $link;
	}
}