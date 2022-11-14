<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /> -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>


	<!-- theme dark -->
	<link rel="icon" type="image/png" href="<?= Yii::app()->request->baseUrl; ?>/images/mib-icon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Material Dashboard Lite</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">


    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">


    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

<!-- jQuery -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<!-- jQuery -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ba-bbq.min.js"></script>
<!-- jQuery -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.yiigridview.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,100,700,900' rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/lib/getmdl-select.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/lib/nv.d3.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/application.min.css">
    <!-- mib css -->
    <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/main.css">
    <!-- endinject -->

    <!-- fin theme dark -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kybarg/mdl-selectfield@mdl-menu-implementation/mdl-selectfield.min.css">

    <link  rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/mib.css?q=<?= time(); ?>">
    <link  rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/mib-emoji.css?q=<?= time(); ?>">
    <link  rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/mdl-date-textfield.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://onesignal.github.io/emoji-picker/lib/css/emoji.css"> -->
    <script src="<?php echo Yii::app()->baseUrl; ?>/js/mib.js?q=<?= time(); ?>"></script>
</head>

<body>

<!-- <div class="container" id="page"> -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header is-small-screen">

	<?php echo $this->renderPartial('//layouts/header');  ?>

	<main class="mdl-layout__content">
			<?php echo $content; ?>
	</main>

	<!-- <?php echo $this->renderPartial('//layouts/footer');  ?> -->


</div><!-- page -->
<script type="text/javascript">
  const homeUrl = "<?php echo Yii::app()->baseUrl; ?>";
  const settingJson = JSON.parse('<?php echo json_encode(Utils::readJson('settings',false));?>');
</script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="http://onesignal.github.io/emoji-picker/lib/js/config.js"></script>
<script type="text/javascript" src="http://onesignal.github.io/emoji-picker/lib/js/util.js"></script>
<script type="text/javascript" src="http://onesignal.github.io/emoji-picker/lib/js/jquery.emojiarea.js"></script>
<script type="text/javascript" src="http://onesignal.github.io/emoji-picker/lib/js/emoji-picker.js"></script>
 -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/mib-emoji.js?q=<?= time(); ?>"></script>
<!-- <script src="<?php echo Yii::app()->baseUrl; ?>/js/mib.js?q=<?= time(); ?>"></script> -->
<!-- inject:js -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/d3.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/getmdl-select.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/material.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/nv.d3.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/js/mib-chart.js?q=<?= time(); ?>"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/layout/layout.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/scroll/scroll.min.js"></script>
<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/widgets/charts/linePlusBarChart.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/widgets/charts/stackedBarChart.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/widgets/employer-form/employer-form.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/widgets/line-chart/line-charts-nvd3.min.js"></script> -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/widgets/map/maps.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/widgets/pie-chart/pie-charts-nvd3.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/widgets/table/table.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/widgets/todo/todo.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/kybarg/mdl-selectfield@mdl-menu-implementation/mdl-selectfield.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/js/mdl-date-textfield.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js" type="text/javascript"></script>
<!-- endinject -->
</body>
</html>

