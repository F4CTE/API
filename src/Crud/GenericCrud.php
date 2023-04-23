<?php
namespace App\Crud;

use App\config\SinglePdo;
use PDO;

class GenericCrud
{
    private $db;

    public function __construct()
    {
        $this->db = SinglePdo::getInstance();
    }

    public function create($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => &$value) {
            $stmt->bindParam(":{$key}", $value);
        }

        return $stmt->execute();
    }

    public function read($table, $id)
    {
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($table, $id, $data)
    {
        $columns = '';

        foreach ($data as $key => $value) {
            $columns .= "{$key} = :{$key}, ";
        }

        $columns = rtrim($columns, ', ');

        $sql = "UPDATE {$table} SET {$columns} WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => &$value) {
            $stmt->bindParam(":{$key}", $value);
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
