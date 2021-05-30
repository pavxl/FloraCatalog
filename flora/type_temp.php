<li>
	<a href="?type=<?=$type['id']?>"><?=$type['type']?></a>
	<?php /*Вложенный список*/ if($type['childs']):?>
	<ul>
		<?php echo types_to_string($type['childs']); ?>
	</ul>
	<?php endif; ?>
</li>