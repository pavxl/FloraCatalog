<?
	include 'catalog.php';

	if(isset($_GET["action"])){
		if($_GET["action"] == "cancel"){
			echo '
			<script type="text/javascript">
	        	window.location = "flores.php"
	      	</script>';
		}
	}
	if (isset($_POST["action"])) {
		if($_POST["action"] == "save"){
			update_plants($_POST["name"], $_POST["desc"], $_POST["id"]);
			echo '
			<script type="text/javascript">
	        	window.location = "flores.php"
	      	</script>';
		}
	}

	$plants = get_plants();
	$plant = $plants[$_GET["id"]];

	echo '<form action="editplant.php" method="post">';
	echo '<input type="text" name="name" value="'.$plant["name"].'">';
	echo "<br>";
	echo '<textarea name="desc" rows=6 cols=70>'.$plant["desc"].'</textarea>';
	echo "<br>";

	echo '
		<br>
			<input type="hidden" value="'.$_GET["id"].'" name="id">
			<input type="hidden" value="save" name="action">
			<input type="submit" value="Сохранить">
		</form>
		<form action="editplant.php" method="get">
			<input type="hidden" value="cancel" name="action">
			<input type="submit" value="Отменить">
		</form>';
?>