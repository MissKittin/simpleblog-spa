<?php if(php_sapi_name() != 'cli-server') include '../../settings.php'; ?>
<?php
	if(php_sapi_name() === 'cli-server')
		if(substr(strtok($_SERVER['REQUEST_URI'], '?'), strlen(strtok($_SERVER['REQUEST_URI'], '?')) - 1) === '/')
		{
			include $simpleblog['root_php'] . '/lib/prevent-index.php';
			exit();
		}

	if(!isset($_GET['root']))
	{
		include $simpleblog['root_php'] . '/lib/prevent-index.php';
		exit();
	}

	header('Content-Type: text/css; X-Content-Type-Options: nosniff;');
?>


/* default skin */

/* standard resolution */
body { /* colors */
	background-color: #aaaaaa;
}
#headlinks {
	margin: 0 auto;
	padding: 5px;
	width: 800px;
	overflow: auto;
}
#headlinks a:link, #headlinks a:hover, #headlinks a:visited {
	text-decoration: none;
	color: #ffffff;
	font-size: 16px;
}
.headlink {
	width: 100px;
	height: 40px;
	background-color: #555555;
	justify-content: center;
	display: flex;
	align-items: center;
	margin: 2px;
	float: right;
	text-align: center;
}

#articles {
	margin: 0 auto;
	padding: 10px;
	padding-bottom: 2px;
	width: 100px;
	background-color: #888888;
	width: 800px;
}
.article {
	margin: 0 auto;
	margin-bottom: 10px;
	padding: 20px;
	background-color: #aaaaaa;
	width: 600px;
}
.art-tags {
	float: left;
	font-style: italic;
}
div.art-tags a:link, div.art-tags a:hover, div.art-tags a:visited {
	text-decoration: none;
	color: #000000;
}
.art-date {
	text-align: right;
}
.art-date a, .art-date a:hover, .art-date a:visited {
	color: #000000;  /* the same as in body */
	text-decoration: none;
}
.art-title a, .art-title a:hover, .art-title a:visited { /* link - article title */
	color: #000000;  /* the same as in body */
	text-decoration: none;
	-webkit-tap-highlight-color: transparent;
}
.art-title .placeholder_link_to_article { /* placeholder if title is empty */
	color: transparent;
	position: absolute;
}
.art-title .placeholder_link_to_article::selection {
	color: transparent;
	position: absolute;
}

.quotation { /* text formatting */
	text-align: center;
	font-style: italic;
	font-size: 20px;
}
del {
	color: #666666;
}
img, video {
	max-width: 100%;
}

#pages { /* page switches */
	margin: 0 auto;
	width: 800px;
	padding: 0;
	overflow: auto;
}
.page {
	float: left;
	width: 40px;
	height: 40px;
	background-color: #333333;
	justify-content: center;
	display: flex;
	align-items: center;
	margin: 2px;
}
div.page a:link, div.page a:hover, div.page a:visited {
	text-decoration: none;
	color: #ffffff;
}
#current_page { /* this page switch */
	background-color: #888888;
}
div#current_page a:link, div#current_page a:hover, div#current_page a:visited {
	text-decoration: none;
	font-weight: bold;
	color: #111111;
}
#footer {
	margin: 0 auto;
	padding: 5px;
	width: 800px;
	text-align: right;
	font-size: 15px;
}
#taglinks { /* for /tag */
	text-align: center;
	margin-bottom: 2px;
}
#taglinks a:link, #taglinks a:hover, #taglinks a:visited {
	text-decoration: none;
	color: #550000;
	font-size: 16px;
}
.taglink {
	/* empty */
}

/* phone and tablet resolution */
@media only screen and (max-width: 850px) {
	#headlinks {
		width: 600px;
		
	}
	.headlink {
		width: 90px;
		height: 30px;
	}
	#articles {
		width: 600px;
		padding: 5px;
		padding-top: 10px;
		padding-bottom: 1px;
	}
	.article {
		width: 500px;
	}
	#pages {
		width: 600px;
	}
	.page {
		width: 30px;
		height: 30px;
	}
	#footer {
		width: 600px;
	}
}

/* low resolution */
@media only screen and (max-width: 650px) {
	#headlinks {
		width: 420px;
	}
	#articles {
		width: 460px;
		background-color: #999999;
	}
	.article {
		width: 420px;
	}
	#pages {
		width: 420px;
	}
	.page {
		width: 25px;
		height: 25px;
	}
	#footer {
		width: 460px;
		font-size: 10px;
	}
}