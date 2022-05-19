<?php

class Conexao
{
    const HOST = 'localhost';
    const PASSWORD = '';
    const USER = 'root';
    const DATABASE = 'aguia';

    private PDO $connection;

    public function conectar(): PDO
    {
        $this->connection = new PDO("mysql:host=localhost;dbname=aguia", 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
        return $this->connection;
    }

    public function executarQuery($consulta, $parametros, $fetchAll = true): bool
    {
        $statement = $this->connection->prepare($consulta);
        $statement->execute($parametros);
        return $fetchAll ? $statement->fetchAll(PDO::FETCH_ASSOC) : $statement->fetch(PDO::FETCH_ASSOC);
    }
}