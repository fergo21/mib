<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/print.css?q=<?= time(); ?>">
</head>

<body>
	<main class="">
			<?php echo $content; ?>
			<?php echo $content; ?>
	</main>
</body>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		window.print();
		// window.onfocus=function(){ window.history.back();}
	});
</script>
</html>

