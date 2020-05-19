<?php
	header('Content-Type: application/json');

	switch($_GET['section'])
	{
		case 'index':
			include $simpleblog['root_php'] . '/lib/viewIndex.php';
			$simpleblog['page']['current_page']=$_GET['page'];

			ob_start();
			simpleblog_viewIndexArticles();
			$output['articles']=ob_get_contents();
			ob_end_clean();

			simpleblog_viewIndexPages();
			$output['pages']=str_replace('?page=', '#!page=', ob_get_contents());
			ob_end_clean();

			echo json_encode($output);
		break;
		case 'tag':
			include $simpleblog['root_php'] . '/lib/viewTag.php';
			if(isset($_GET['tag']))
			{
				ob_start();
				simpleblog_viewTagArticles();
				$output['tags']=str_replace('?tag=', '#!tag=', ob_get_contents());
				ob_end_clean();

				simpleblog_viewTagPages();
				$output['pages']=str_replace('?tag=', '#!tag=', ob_get_contents());
				ob_end_clean();
			}
			else
			{
				ob_start();
				simpleblog_viewTagArticles();
				$output['tags']=str_replace('?tag=', '#!tag=', ob_get_contents());
				ob_end_clean();
				$output['pages']='';
			}
			echo json_encode($output);
		break;
	}
?>