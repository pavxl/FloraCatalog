<?php
	session_start();
	include 'catalog.php';

	if(!isset($_SESSION['fio'])){
		echo "session=".$_SESSION;
		echo '
			<script type="text/javascript">
	        	window.location = "/"
	      	</script>';
	}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Каталог</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="wrapper">
		<div class="sidebar">
			<ul class="category">
				<?php echo $types_menu;?>
				<?
					echo "<br>";
					echo "Привет, ".$_SESSION['fio'];
					echo "<br>";
					echo '
						<form action="logout.php" method="post">
							<input type="submit" value="Выйти из аккаунта">
						</form>';
				?>
			</ul>
		</div>
		<div class="content">
			<p><?=$brcr;?></p>
			<br>
			<hr>
			<div class="catalog">
			
			<?
			if(isset($_GET['type'])){
				$type = $_GET['type'];

				$plants = get_plants_by_type($type);
			}else{
				$plants = get_plants();
			}
			$types = get_type();

			foreach($plants as $id => $plant){
				echo '
				<div class="plant">
					<div class="name">'.$plant["name"].'</div>
					<img src="./images/'.$plant["image"].'" alt="">
					<div class="desc">'.$plant["desc"].'</div>
					<div class="type">Тип: '.$types[$plant["type_id"]]["type"].'</div>
					<div class="admin-buttons">';

				// foreach($plants as $plant){
				// 	echo ' 
				// 	<div class="name">'.$plant["name"].'</div>
				// 	<img src="./images/'.$plant["image"].'" alt="">
			 // 		<div class="desc">'.$plant["desc"].'</div>
			 // 		<div class="type">Тип: '.$types[$plant["type_id"]]["type"].'</div>
			 // 		<div class="admin-buttons">';		
				// }

				if($_SESSION['role'] == "admin" ){
					echo '
						<form action="editplant.php" method="get">
							<input type="hidden" value="'.$plant["id"].'" name="id">
							<input type="submit" value="Редактировать">
						</form>
						<form action="deleteplant.php" method="get">
							<input type="hidden" value="'.$plant["id"].'" name="id">
							<input type="submit" value="Удалить">
						</form>';
				}

				echo '		
					</div>
				</div>';
			}
			?>

			</div>

		</div>
	</div>

<style>
.plant{
	margin: 15px 0;
	padding: 15px;
	/*border: 1px solid #333;*/
}
.plant img{
	display: block;
	margin: 0 auto;
	height: 200px;
}
.plant .name{
	font-size: 1.5em;
	font-weight: bold;
}
input[type="submit"]{
	padding: 5px;
}
.admin-buttons form{
	display: inline-block;
}
</style>

	<script src="js/jquery-1.9.0.min.js"></script>
	<script src="js/jquery.accordion.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script>
		$(document).ready(function(){
			$(".category").dcAccordion();
		});
	</script>
</body>
</html>