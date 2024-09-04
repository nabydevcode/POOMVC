<?php
namespace App\Models;
use App\Core\Database;


class Model extends Database
{

    public $table;
    private $db;
    public function prepe($sql, array $attributes = null)
    {
        $this->db = Database::getinstance();
        if ($attributes) {
            $query = $this->db->prepare($sql);
            $query->execute($attributes);

        } else {

            $query = $this->db->query($sql);
        }
        return $query;
    }
    public function findAll()
    {
        return $this->prepe('SELECT * FROM ' . $this->table);
    }
    public function find($id)
    {
        $var[] = $id;
        $sql = $this->prepe('SELECT * FROM ' . $this->table . ' WHERE  id=? ', $var);
        return $sql;
    }
    public function findByIndice(array $indice)
    {
        $valeurs = [];
        foreach ($indice as $key => $value) {
            $champs = $key;
            $valeurs = $value;
        }
        $sql = $this->prepe('SELECT * FROM ' . $this->table . ' WHERE ' . $champs . '=?', $valeurs);

        return $sql;
    }
    public function delete(int $id)
    {
        $varleur[] = $id;
        $sql = $this->prepe('DELETE FROM ' . $this->table . ' WHERE id=? ', $varleur);
        return $sql;
    }
    public function createUpdate(Model $model, $attributes = null)
    {

        $champs = [];
        $valeurs = [];
        $inter = [];
        foreach ($model as $champ => $value) {
            if ($value !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = $champ;
                $valeurs[] = $value;
                $inter[] = '?';
            }
        }
        if ($attributes != null) {
            $lignedeschamps = implode('=?,', $champ) . '=?';
            $valeurs[] = $attributes;
            $sql = $this->prepe('UPDATE' . $this->table . ' SET ' . $lignedeschamps . ' WHERE id=? ', $valeurs);
        } else {
            $lignedeschamps = implode(',', $champs);
            $ligneInter = implode(',', $inter);
            $sql = $this->prepe('INSERT INTO ' . $this->table . '(' . $lignedeschamps . ') VALUES (' . $ligneInter . ')', $valeurs);
        }
        return $sql;


    }


}