<?php // phpinfo(); ?>
<form method="post">
	<input type="text" name="gris" value="Gris">
	<button type="submit" value="apa">Apa</button>
</form>

<?php foreach ($_POST as $key => $value) {
	echo $key;
} ?>

<pre><?php print_r($_POST); ?></pre>