<?php
	$scripts=[
		'lib/fjson.js',
		'spaSettings.js',
		'lib/spa.js'
	];

	foreach($scripts as $script)
		echo file_get_contents($script);
?>