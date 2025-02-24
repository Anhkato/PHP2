<?php
namespace App\Models;
class Category extends BaseModel{
    protected $table = "categories";

    public function getCategories(){
        $sql = "SELECT * FROM $this->table";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function addCategory($id, $name_cate){
        $sql = "INSERT INTO $this->table VALUES(?,?)";
        $this->setQuery($sql);
        return $this->execute([$id, $name_cate]);
    }

    public function getDetailCategory($id){
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function updateCategory($id, $name_cate){
        $sql = "UPDATE $this->table SET name_cate = ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$name_cate, $id]);
    }

    public function deleteCategory($id){
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
}
