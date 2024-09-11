<?php

namespace App\Repositories;

use App\Core\Database;

class BaseRepository
{
    protected $db;
    protected $table;

    public function __construct(Database $database, $table)
    {
        $this->db = $database->getConnection();
        $this->table = $table;
    }

    public function getAll()
    {
        return $this->db->select($this->table, "*");
    }

    public function findBy($field, $value)
    {
        return $this->db->get($this->table, '*', [$field => $value]);
    }

    public function findById($id)
    {
        return $this->db->get($this->table, "*", ["id" => $id]);
    }

    public function insert(array $data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, array $data)
    {
        return $this->db->update($this->table, $data, ["id" => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ["id" => $id]);
    }

    public function deleteActive($id)
    {
        return $this->db->update($this->table, ["active" => false], ["id" => $id]);
    }

    public function getPaginated($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        return $this->db->select($this->table, "*", [
            "LIMIT" => [$offset, $perPage]
        ]);
    }

    public function countAll()
    {
        return $this->db->count($this->table);
    }
}
