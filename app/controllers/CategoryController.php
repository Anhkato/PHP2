<?php
namespace App\Controllers;
use App\Models\Category;

class CategoryController extends BaseController{
    public $category;

    public function __construct(){
        $this->category = new Category();
    }

    public function indexCate(){
        $categories = $this->category->getCategories();
        return $this->render('category.index', compact('categories'));
    }

    public function addCategory(){
        return $this->render('category.add');
    }

    public function storeCate(){
        if(isset($_POST['add'])){
            $errors = [];
            if(empty($_POST['name'])){
                $errors[] = "Tên danh mục không được bỏ trống";
            }
            if(count($errors) > 0){
                flash('errors', $errors, 'add-category');
            } else {
                $result = $this->category->addCategory(NULL, $_POST['name']);
                if($result) {
                    flash('success', 'Thêm thành công', 'list-category');
                }
            }
        }
    }

    public function detailCate($id){
        $category = $this->category->getDetailCategory($id);
        return $this->render("category.edit", compact('category'));
    }

    public function editCategory($id){
        if(isset($_POST['edit'])){
            $errors = [];
            if(empty($_POST['name'])){
                $errors[] = "Tên danh mục không được bỏ trống";
            }
            if(count($errors) > 0){
                flash('errors', $errors, 'detail-category/'.$id );
            } else {
                $result = $this->category->updateCategory($id, $_POST['name']);
                if($result) {
                    flash('success', 'Sửa thành công', 'list-category');
                }
            }
        }
    }

    public function destroyCate($id){
        $result = $this->category->deleteCategory($id);
        if($result){
            flash('success', 'Xóa thành công', 'list-category');
        }
    }
}