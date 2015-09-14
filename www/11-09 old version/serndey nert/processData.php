<html>
	<?php
		require 'validate.inc';
		$errors = array();
		validateForm($errors, $_POST);
		if ($errors != null){
			include 'page4form.inc';
		}
		else {
			header("Location: searchpage.php");
		}
	?>
</html>
