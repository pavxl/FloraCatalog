<?php
//Печать массива
function print_arr($array){
	echo "<pre>" . print_r($array, true) . "</pre>";
}
//Массив категорий
function get_type(){
	global $connect;
	//$query = "SELECT * FROM type_plant";
	$res = $connect->query("SELECT * FROM type_plant");

	$arr_type = array();
	while($row = mysqli_fetch_assoc($res)){
		$arr_type[$row['id']] = $row;
	}

	return $arr_type;
}

//удаление
function delete_plant($id){
	global $connect;

	$sql = "DELETE FROM `plants`
				WHERE `id`=".$id.";";
	$res = $connect->query($sql);
	if(!$res){
		die("Error: " . $sql . "<br>" . $connect->error);
	}

	return true;
}

//update
function update_plants($name, $desc, $id){
	global $connect;
	// $res = $connect->query("SELECT * FROM plants");

	$sql = "UPDATE `plants` SET
				`name`='".$name."',
				 `desc`='".$desc."'
				WHERE `id`=".$id.";";
	$res = $connect->query($sql);
	if(!$res){
		die("Error: " . $sql . "<br>" . $connect->error);
	}

	return true;
}

//Массив of plants by type_id
function get_plants_by_type($type){
	global $connect;
	//$query = "SELECT * FROM type_plant";
	$res = $connect->query("SELECT * FROM plants WHERE type_id=".$type);

	$arr_type = array();
	while($row = mysqli_fetch_assoc($res)){
		$arr_type[$row['id']] = $row;
	}

	return $arr_type;
}

//Массив of plants
function get_plants(){
	global $connect;
	//$query = "SELECT * FROM type_plant";
	$res = $connect->query("SELECT * FROM plants");

	$arr_type = array();
	while($row = mysqli_fetch_assoc($res)){
		$arr_type[$row['id']] = $row;
	}

	return $arr_type;
}

//Построение дерева
function map_tree($dataset) {
	$tree = array();

	foreach ($dataset as $id=>&$node) {    
		if (!$node['group']){
			$tree[$id] = &$node;
		}else{ 
            $dataset[$node['group']]['childs'][$id] = &$node;
		}
	}

	return $tree;
}

//Дерево в строку HTML
function types_to_string($data){
	foreach($data as $item){
		$string .= types_to_temp($item);
	}
	return $string;
}

//Шаблон вывода типов растений
function types_to_temp($type){
	ob_start();
	include 'type_temp.php';
	return ob_get_clean();
}

//Навигационная цепочка
function brcr($array, $id){
	if(!$id) return false;

	$count = count($array);
	$brcr_array = array();
	for($i = 0; $i < $count; $i++){
		if($array[$id]){
			$brcr_array[$array[$id]['id']] = $array[$id]['type'];
			$id = $array[$id]['group'];
		}
		else break;
	}
	return array_reverse($brcr_array, true);
}

//получение ID дочерних категорий
function types_id($array, $id){
	if(!$id) return false;

	foreach($array as $plant){
		if($plant['group'] == $id){
			$data .= $plant['id'] . ", ";
			$data .= types_id($array, $plant['id']);
		}
	}

	return $data;
}

// //получение растений
// function get_all_plants($ids = false){
// 	global $connect;
// 	if($ids){
// 		$query = "SELECT * FROM plants WHERE group IN($ids) ORDER BY name";
// 	}
// 	else{
// 		$query = "SELECT * FROM plants ORDER BY name";
// 	}

// 	$res = mysqli_query($connect, $query);
// 	$plants = array();
// 	while($row = mysqli_fetch_assoc($res)){
// 		$plants[] = $row;
// 	}
// 	return $plants;
// }
?>