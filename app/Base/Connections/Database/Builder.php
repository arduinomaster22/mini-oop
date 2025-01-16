<?php

namespace App\Base\Connections\Database;

use Exception;

class Builder
{
    public $table;

    public $connection; 
    
    public function __construct()
    {
        $servername = env('DATABASE_HOST');
        $username = env('DATABASE_USERNAME');
        $password = env('DATABASE_PASSWORD');
        $database = env('DATABASE_NAME');
        $port = env('DATABASE_PORT');

        $this->connection = mysqli_connect($servername, $username, $password, $database, $port);
    }

    public function table($table)
    {
        $query = "SHOW TABLES LIKE '{$table}'";
        $result = $this->connection->query($query);

        if ($result && $result->num_rows > 0) {
            $this->table = $table;

            return $this;
        }

        return throw new Exception("Table {$table} does not exist on the given database. Please create the table first.");
    }

    public function where($key, $value)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE {$key} = '{$value}'";
            $result = $this->connection->query($query);

            if ($result && $result->num_rows > 0) {
                $rows = [];
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }

                return collect($rows);
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function update($table, $data, $id)
    {
        $table = $this->table ?? $table;
        $setClause = implode(', ', array_map(
            fn ($key, $value) => "{$key} = '".$this->connection->real_escape_string($value)."'",
            array_keys($data),
            $data
        ));
        
        $query = "UPDATE {$table} SET {$setClause} WHERE id = {$id}";

        try {
            if ($this->connection->query($query)) {
                $query = "SELECT * FROM {$table} WHERE id = {$id}";
                $result = $this->connection->query($query);

                if ($result && $result->num_rows > 0) {
                    $rows = [];
                    while ($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }

                    return collect($rows);
                }
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function create($data) {
        $table = $this->table;
        $columns = implode(', ', array_keys($data));
        $values = implode("', '", array_map(fn ($value) => $this->connection->real_escape_string($value), $data));

        $query = "INSERT INTO {$table} ({$columns}) VALUES ('{$values}')";

        try {
            if ($this->connection->query($query)) {
                $id = $this->connection->insert_id;
                $query = "SELECT * FROM {$table} WHERE id = {$id}";
                $result = $this->connection->query($query);

                if ($result && $result->num_rows > 0) {
                    $rows = [];
                    while ($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }

                    return collect($rows);
                }
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }
}
