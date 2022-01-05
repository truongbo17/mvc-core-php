<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>WEBSITE MVC PHP</title>
	<link rel="stylesheet" href="<?php echo _WEB_ROOT?>/public/assets/css/style.css">
</head>
<body>
	<?php
		$this->render('blocks/header');

		$this->render($content,$sub_content);

		$this->render('blocks/footer');
	?>
	<script type="text/javascript" src="<?php echo _WEB_ROOT?>/public/assets/js/script.js"></script>
</body>
</html>