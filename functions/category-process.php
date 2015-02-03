<?php 
	require_once '../core/init.php';

	$db = DB::getInstance();

	$subCat_1 = $_POST['subCat_1'];
	$subCat_2 = $_POST['subCat_2'];
	$subCat_3 = $_POST['subCat_3'];
	
	// TODO
	// $main_categories = $db->get_all('main_categories')->results();



	if ($subCat_1 == 1) {
		echo "<option value=\"0\">Моля изберете</option><option value=\"1\"> HEllo</option><option value=\"2\">Test</option><option value=\"3\">Pedo</option>"; 
	}else if ($subCat_1 == 2) {
		echo "<option value=\"0\">Моля изберете</option><option value=\"1\"> ALA BALA</option><option value=\"2\"> DOn Perinion</option><option value=\"3\"> SAnta fe</option>"; 
	}


	if ($subCat_2 == 1) {
		echo "<option value=\"0\">Моля изберете</option><option value=\"1\"> Haloooooooooooo</option><option value=\"2\">Testtttttttt</option><option value=\"3\">Pedo</option>"; 
	}else if ($subCat_2 == 2) {
		echo "<option value=\"0\">Моля изберете</option><option value=\"1\"> ALA BALAaaaaaaaaaaaaaa</option><option value=\"2\"> DOn Perinionmmmmmmmmmmmmmmmm</option><option value=\"3\"> SAnta fe</option>"; 
	}


	if ($subCat_3 == 1) {
		echo "<option value=\"0\">Моля изберете</option><option value=\"1\"> Predo bearrr</option><option value=\"2\">Testtttttttt</option><option value=\"3\">Pedo</option>"; 
	}else if ($subCat_3 == 2) {
		echo "<option value=\"0\">Моля изберете</option><option value=\"1\"> ALA aaaaaaaaaaaa</option><option value=\"2\"> DOn mmmmmmmmm</option><option value=\"3\"> SAnta fe</option>"; 
	}


?>


