<?php 
	require_once '../core/init.php';

	$db = DB::getInstance();

	$category = isset($_POST['category'])? $_POST['category'] : null;
	$subCat_1 = isset($_POST['subCat_1'])? $_POST['subCat_1'] : null;
	// $subCat_2 = $_POST['subCat_2']; IF you need more sub-categories
	


	$sub_category_1 =  $db->get('categories', array("perant_id", "=", $category))->results();


	if(isset($category)){
		foreach ($sub_category_1 as $sub_category) {
			echo "<option value=\"{$sub_category->id}\"> {$sub_category->category}</option>";
		}
	}

	$sub_category_2 =  $db->get('categories', array("perant_id", "=", $subCat_1))->results();

	if (isset($subCat_1)) {
		foreach ($sub_category_2 as $sub_category) {
			echo "<option value=\"{$sub_category->id}\"> {$sub_category->category}</option>";
		}
	}


?>


