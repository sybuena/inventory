
<?php //loadAssets($js, 'js'); ?>

<?php foreach ($js as $key => $value) :?>
	<script type="text/javascript" src="<?=auto_version($value);?>"></script>
<?php endforeach; ?>
		
</body>