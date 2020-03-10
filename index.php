<?php // Simpleblog v2.1 - SPA ?>
<?php
	// import settings
	include 'blog/.router.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $simpleblog['title']; ?></title>
		<meta charset="utf-8">
		<?php include $simpleblog['root_php'] . '/lib/htmlheaders.php'; ?>
		<script type="text/javascript"><?php include 'lib/scripts.php'; ?></script>
	</head>
	<body>
		<div id="header">
			<?php include $simpleblog['root_php'] . '/lib/header.php'; ?>
		</div>
		<div id="headlinks">
			<?php /* include $simpleblog['root_php'] . '/lib/headlinks.php'; */ ?>
		</div>
		<div id="articles"></div>
		<div id="pages"></div>
		<div id="footer">
			<?php include $simpleblog['root_php'] . '/lib/footer.php'; ?>
		</div>
	</body>
</html>