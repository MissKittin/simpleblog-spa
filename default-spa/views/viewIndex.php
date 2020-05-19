<?php
	// deny direct access
	if(php_sapi_name() === 'cli-server')
	{
		if(basename(strtok($_SERVER['REQUEST_URI'], '?')) === 'viewIndex.php')
		{
			include $simpleblog['root_php'] . '/lib/prevent-index.php'; exit();
		}
	}
	else
	{
		if(!isset($simpleblog))
		{
			include '../../../lib/prevent-index.php'; exit();
		}
	}
?>
<!DOCTYPE html>
<html lang="<?php echo $simpleblog['html_lang']; ?>">
	<head>
		<title><?php echo $simpleblog['title']; ?></title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="<?php echo $simpleblog['root_html']; ?>/skins/<?php echo $simpleblog['skin']; ?>?root=<?php echo $simpleblog['root_html']; ?>">
		<?php include $simpleblog['root_php'] . '/lib/htmlheaders.php'; ?>
		<style>
			html {
				scroll-behavior: smooth;
			}
			#spinner {
				display: table;
				margin: 0px auto;
			}
		</style>
		<style>
			/* loading.io */
			.lds-ring {
				display: inline-block;
				position: relative;
				width: 80px;
				height: 80px;
			}
			.lds-ring div {
				box-sizing: border-box;
				display: block;
				position: absolute;
				width: 64px;
				height: 64px;
				margin: 8px;
				border: 8px solid #fff;
				border-radius: 50%;
				animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
				border-color: #fff transparent transparent transparent;
			}
			.lds-ring div:nth-child(1) {
				animation-delay: -0.45s;
			}
			.lds-ring div:nth-child(2) {
				animation-delay: -0.3s;
			}
			.lds-ring div:nth-child(3) {
				animation-delay: -0.15s;
			}
			@keyframes lds-ring {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			}
		</style>
		<script>
			// sleep.js
			function sleep(ms)
			{
				return new Promise(resolve => setTimeout(resolve, ms));
			}

			// fjson.js
			var getJSON=function(url, method, callback, data)
			{
				var xhr=new XMLHttpRequest();
				xhr.open(method, url, true);
				xhr.responseType='json';
				xhr.onload=function() // send response or error to callback function
				{
					var status=xhr.status;
					if(status == 200)
						callback(null, xhr.response);
					else
						callback(status);
				};
				xhr.onerror=function(e){ callback(e);}; // catch network error
				xhr.send(data);
			};

			function spaBlog_getArticles(ida, idp, page, url)
			{
				getJSON(url + '?section=index&page=' + page, 'get', async function(err, response){
					if(err == null)
					{
						scroll(0,0);
						document.getElementById(ida).innerHTML=response.articles;
						document.getElementById(idp).innerHTML=response.pages;

						await sleep(60);
						// assign onclick function for each switch
						var elements=document.getElementsByClassName('page');
						for(var i=0; i<elements.length; i++)
							elements[i].getElementsByTagName('a')[0].addEventListener('click', function(){
								spaBlog_getArticles('articles', 'pages', this.hash.substring(7), '<?php echo $simpleblog['root_html'] . '/skins/' . $simpleblog['skin'] . '/api'; ?>');
							});
					}
				}, null);
			}
			document.addEventListener('DOMContentLoaded', function(){
				if(window.location.hash)
					spaBlog_getArticles('articles', 'pages', window.location.hash.substring(7), '<?php echo $simpleblog['root_html'] . '/skins/' . $simpleblog['skin'] . '/api'; ?>');
				else
					spaBlog_getArticles('articles', 'pages', 1, '<?php echo $simpleblog['root_html'] . '/skins/' . $simpleblog['skin'] . '/api'; ?>');
			});
		</script>
	</head>
	<body>
		<div id="header">
			<?php include $simpleblog['root_php'] . '/lib/header.php'; ?>
		</div>
		<div id="headlinks">
			<?php include $simpleblog['root_php'] . '/lib/headlinks.php'; ?>
		</div>
		<div id="articles">
			<div id="spinner">
				<div class="lds-ring"><div></div><div></div><div></div><div></div></div>
			</div>
		</div>
		<div id="pages"></div>
		<div id="footer">
			<?php include $simpleblog['root_php'] . '/lib/footer.php'; ?>
		</div>
	</body>
</html>