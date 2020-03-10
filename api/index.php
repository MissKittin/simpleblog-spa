<?php
	header('Content-Type: application/json');

	// import settings
	include '../blog/.router.php';

	// import coreIndex functions
	include $simpleblog['root_php'] . '/lib/coreIndex.php';

	// output array
	$output=array();

	// getPages()
	if(isset($_GET['pages']))
	{
		$output=simpleblog_countPages($simpleblog['root_php'] . '/articles', 1, $simpleblog['entries_per_page']);
		$output=explode('</div>', $output);
		$output=count($output)-1;
		echo json_encode($output);
		exit();
	}

	// import core functions
	include $simpleblog['root_php'] . '/lib/core.php';

	// set page number
	$simpleblog['page']['current_page']=json_decode(file_get_contents('php://input'), true);
	$simpleblog['page']['current_page']=$simpleblog['page']['current_page']['page'];

	// get articles
	$simpleblog['page']['emptyDatabase']=true;
	foreach(simpleblog_engineIndex($simpleblog['root_php'] . '/articles', $simpleblog['page']['current_page'], $simpleblog['entries_per_page']) as $simpleblog['page']['current_article'])
	{
		$simpleblog['page']['emptyDatabase']=false;
		ob_start();
		simpleblog_engineCore($simpleblog['page']['current_article'], $simpleblog['taglinks'], $simpleblog['postlinks'], $simpleblog['datelinks']);
		array_push($output, ob_get_contents());
		ob_end_clean();
	}
	if($simpleblog['page']['emptyDatabase']) array_push($output, $simpleblog['emptyLabel']);

	// print output
	echo json_encode($output);
?>