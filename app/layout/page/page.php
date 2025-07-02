<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title><?= $this->_titlepage ?></title>
	<meta name="description" content="<?= $this->_data['metadescription']; ?>" />
	<meta name="keywords" content="<?= $this->_data['metakeywords']; ?>" />

	<!-- Jquery -->
	<script src="/components/jquery/jquery-3.6.0.min.js"></script>
	<!-- Carousel -->
	<!-- Skins Carousel -->
	<link rel="stylesheet" type="text/css" href="/scripts/carousel/carousel.css">
	<script type="text/javascript" src="/scripts/carousel/carousel.js"></script>
	<link rel="stylesheet" href="/components/bootstrap-fileinput/css/fileinput.css">
	<!-- Slick CSS -->
	<link rel="stylesheet" href="/components/slick/slick/slick.css">
	<link rel="stylesheet" href="/components/slick/slick/slick-theme.css">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/components/bootstrap-5.3/css/bootstrap.min.css">
	<!-- Bootstrap Js -->
	<script src="/components/bootstrap-5.3/js/bootstrap.bundle.min.js"></script>
	<link href="/components/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="/components/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>

	<!-- metacolor -->
	<meta name="theme-color" content="#5475a1">

	<!-- FontAwesome -->
	<link rel="stylesheet" href="/components/Font-Awesome/css/all.css">

	<!-- AOS -->

	<link rel="stylesheet" href="/components/aos-master/dist/aos.css">

	<link rel="stylesheet" href="/skins/page/css/global.css?v=1.21">

	<link rel="shortcut icon" href="/favicon.png">

	<link rel="stylesheet" type="text/css" href="/components/tooltipster/dist/css/tooltipster.bundle.min.css" />
	<!-- SweetAlert -->
	<script src="/components/sweetalert/sweetalert.js"></script>

	<!-- Tiny -->
	<script src="/components/tinymce/tinymce.min.js"></script>

	<script type="text/javascript" id="www-widgetapi-script"
		src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflS50iB-/www-widgetapi.js" async=""></script>

	<script type="text/javascript" src="/components/select2/dist/js/select2.min.js"></script>
	<link rel="stylesheet" href="/components/select2-bootstrap-theme/dist/select2-bootstrap.min.css">
	<link rel="stylesheet" href="/components/select2/dist/css/select2.min.css">

	<?php if (1 == 0) { ?>
		<script src="https://www.youtube.com/player_api"></script>
	<?php } ?>

	<?= $this->_data['info_pagina_scripts']; ?>

	<meta name="viewport" content="width=device-width, user-scalable=no">
</head>

<body>
	<header>
		<?= $this->_data['header']; ?>
	</header>
	<main class="main-general"><?= $this->_content ?></main>
	<footer>
		<?= $this->_data['footer']; ?>
	</footer>
	<script type="text/javascript" src="/components/tooltipster/dist/js/tooltipster.bundle.min.js"></script>
	<script type="text/javascript" src="/components/zoom-master/jquery.zoom.js"></script>
	<script src="/components/bootstrap-fileinput/js/fileinput.min.js"></script>
	<script src="/components/bootstrap-fileinput/js/locales/es.js"></script>

	<script src="/components/aos-master/dist/aos.js"></script>
	<script type="text/javascript" src="/scripts/carousel/carousel.js"></script>
	<script src="/components/bootstrap-validator/dist/validator.min.js"></script>
	<script src="/skins/page/js/main.js?v=1.03"></script>
	<?php if ($this->_data['ocultarcarrito'] != 1) { ?>
		<div id="micarrito"></div>
	<?php } ?>
</body>

</html>