<?
	include 'catalog.php';

	delete_plant($_GET["id"]);

	echo '
			<script type="text/javascript">
	        	window.location = "flores.php"
	      	</script>';
?>