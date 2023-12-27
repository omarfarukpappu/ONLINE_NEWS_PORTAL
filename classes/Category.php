<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../Library/Database.php');
    include_once ($filepath.'/../helpers/Format.php');

    class Category{

        public $db;
        public $fr;

        public function __construct()
        {
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function AddCategory($catName){
            $catName = $this->fr->validation($catName);

            if (empty($catName)) {
                $msg = "Category Name Fild Must Not Be Empty";
                return $msg;
            }else{

                $select_que = "SELECT * FROM tbl_category WHERE catName='$catName'";
                $select_re = $this->db->select($select_que);

                if ($select_re > 0) {
                    $msg = "This Category already exsist";
                    return $msg;
                }else {
                    $insert_que = "INSERT INTO tbl_category(catName) VALUES('$catName')";
                    $insert_result = $this->db->insert($insert_que);

                    if ($insert_result) {
                        $msg = "Category Inserted Successfully";
                        return $msg;
                    }else {
                        $msg = "Something Wrong Category Is not added";
                        return $msg;
                    }
                }

            }
        }


        //Select All Category
        public function AllCategory(){
            $select_cat = "SELECT * FROM tbl_category ORDER BY catId DESC";
            $all_cat = $this->db->select($select_cat);
            if ($all_cat != false) {
                return $all_cat;
            }else {
                return false;
            }
        }

       //Edit Cat Data
       public function getEditCat($id){
           $edit_data = "SELECT * FROM tbl_category WHERE catId = '$id'";
           $eidt_result = $this->db->select($edit_data);
           return $eidt_result;
       }

       //Update Category
       public function UpdateCategory($catName, $id){

            $catName = $this->fr->validation($catName);

            if (empty($catName)) {
                $msg = "Category Name Fild Must Not Be Empty";
                return $msg;
            }else{

                $select_que = "SELECT * FROM tbl_category WHERE catName='$catName'";
                $select_re = $this->db->select($select_que);

                if ($select_re > 0) {
                    $msg = "This Category already exsist";
                    return $msg;
                }else {
                    $update_que = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
                    $update_result = $this->db->insert($update_que);

                    if ($update_result) {
                        header('location:categorylist.php');
                        $msg = "Category Updated Successfully";
                        return $msg;
                        
                    }else {
                        $msg = "Something Wrong Category Is not Updated";
                        return $msg;
                    }
                }

            }

       }

       //Delete Cat
       public function DeleteCategory($id){
           $delete_query = "DELETE FROM tbl_category WHERE catId = '$id'";
           $result = $this->db->delete($delete_query);
           if ($result) {
               $msg = "Category Delete Successfully";
               return $msg;
           }else {
               $msg = "Something Wrong Category Is not Delete";
                        return $msg;
           }
       }

       public function modelData(){
           $mq = "SELECT * FROM tbl_category";
           $mr = $this->db->select($mq);
           return $mr;
       }

      
       //category Name for select Cat
       public function catName($id){
            $cat_id = "SELECT * FROM tbl_category WHERE catId = '$id'";
            $c_result = $this->db->select($cat_id);
            return $c_result;
       }

       //index page total category
       public function totalCategory(){
           $toal_q = "SELECT * FROM tbl_category";
           $total_r = $this->db->select($toal_q);
           return $total_r;
       }
    }

?>
