<?php

class Conexao
{
    const HOST = 'localhost';
    const PASSWORD = '';
    const USER = 'root';
    const DATABASE = 'aguia';


    public static function conectar(): PDO
    {
        $connection = new PDO("mysql:host=localhost;dbname=aguia", 'root', 'Mariotti-jp281');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
		$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $connection;
    }
}