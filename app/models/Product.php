<?php
namespace App\Models;
class Product extends BaseModel{
    protected $table = "products";
    // tạo ra thuộc tính table gán tên bảng trên SQL
    // xây dựng hàm lấy danh sách sản phẩm

    public function getProduct(){
        $sql = "SELECT * FROM $this->table";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function addProduct($id, $name, $price,$img_thumbnail, $category_id){
        $sql = "INSERT INTO $this->table VALUES(?,?,?,?,?)"; //
        $this->setQuery($sql);
        return $this->execute([$id,$name,$price,$img_thumbnail, $category_id]);
    }

    public function getDetailProduct($id){
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function updateProduct($id, $name, $price,$img_thumbnail, $category_id){
        $sql = "UPDATE $this->table SET name = ?, price = ?, img_thumbnail= ?, category_id = ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$name, $price,$img_thumbnail,$category_id, $id]);
    }

    public function deleteProduct($id){
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }

    public function getConnectProductWithCategory(){
        $sql = "SELECT products.*, categories.name_cate as category_name 
                FROM products 
                LEFT JOIN categories ON products.category_id = categories.id";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
}