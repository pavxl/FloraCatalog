<?php
	include 'connection.php';
	include 'functions.php';

	$types = get_type();
	$types_tree = map_tree($types);
	$types_menu = types_to_string($types_tree);

	if(isset($_GET['type'])){
		$id = (int)$_GET['type'];

		//навигационная цепочка
		$brcr_array = brcr($types, $id);

		if($brcr_array){
			$brcr = "<a href='flores.php'>Главная</a> / ";
			foreach($brcr_array as $id => $type){
				$brcr .= "<a href='?type={$id}'>{$type}</a> / ";
			}
			$brcr = rtrim($brcr, " / ");
			$brcr = preg_replace("#(.+)?<a.+>(.+)</a>$#", "$1$2", $brcr);
		}
		else{
			$brcr = "<a href='/catalog/'>Главная</a> / Каталог";
		}

		//получение ID дочерних категорий
		// $ids = types_id($types, $id);
		// $ids = !$ids ? $id : rtrim($ids . ", ");
		
		// if($ids) $plants = get_all_plants($ids);
		// else $plants = null;
	}
	// else{
	// 	$plants = get_all_plants();
	// }
?>