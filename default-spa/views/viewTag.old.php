<?php
	// deny direct access
	if(php_sapi_name() === 'cli-server')
	{
		if(basename(strtok($_SERVER['REQUEST_URI'], '?')) === 'viewTag.php')
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

			function spaBlog_getArticles(ida, idp, tag, url)
			{
				var params='';
				if(tag != null)
					var params='&tag=' + tag;

				getJSON(url + '?section=tag' + params, 'get', async function(err, response){
					if(err == null)
					{
						scroll(0,0);
						document.getElementById(ida).innerHTML=response.tags;
						document.getElementById(idp).innerHTML=response.pages;

						await sleep(60);
						// assign onclick function for each switch
						var elements=document.getElementsByClassName('taglink');
						for(var i=0; i<elements.length; i++)
							elements[i].addEventListener('click', function(){
								spaBlog_getArticles('articles', 'pages', this.hash.substring(6), '<?php echo $simpleblog['root_html'] . '/skins/' . $simpleblog['skin'] . '/api'; ?>');
							});
					}
				}, null);
			}
			document.addEventListener('DOMContentLoaded', function(){
				if(window.location.hash)
					spaBlog_getArticles('articles', 'pages', window.location.hash.substring(6), '<?php echo $simpleblog['root_html'] . '/skins/' . $simpleblog['skin'] . '/api'; ?>');
				else
					spaBlog_getArticles('articles', 'pages', null, '<?php echo $simpleblog['root_html'] . '/skins/' . $simpleblog['skin'] . '/api'; ?>');
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
		<div id="articles"></div>
		<div id="pages"></div>
		<div id="footer">
			<?php include $simpleblog['root_php'] . '/lib/footer.php'; ?>
		</div>
	</body>
</html>