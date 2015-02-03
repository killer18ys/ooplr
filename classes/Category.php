<?php
class Category{

        public static function get_level(){
		    $i = 1;
	        while (true) {
	          if (isset($_POST["subcategory-" . $i])){
	             $i++;
	          }
	          else{
	           return $i - 1;
	          }
	        }
        }

        public static function get_validation_arr(){
	        $i = 1;
	        $cat_validation = array();

	        while (true) {
	          if (isset($_POST["subcategory-" . $i])) {
	          	array_push($cat_validation, array("subcategory-{$i}" => array('required' => true)));
	          	$i++;
	          }else{
	          	return $cat_validation;
	          }

	        }
        }

        public static function get_path(){
	       	$category_path = Input::get('category');
	        for ($i=1; $i <= self::get_level() ; $i++) { 
	            $category_path .= "/" . Input::get("subcategory-{$i}");
	        }
	        return $category_path;
        }
}


