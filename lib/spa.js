// SPA template
// Settings:
//	var articlesDiv -> id of div with articles
//	var pagesDiv	-> id of div with page switches

function printConnectionError()
{
	alert('Connetction error');
}

function getArticles(id, page)
{
	var data='{"page":' + page + '}';
	getJSON('/api?articles', 'post', function(err, response){
		if(err == null)
		{
			var idelement=document.getElementById(id);
			idelement.innerHTML='';
			response.forEach(function(article){
				idelement.innerHTML=idelement.innerHTML + article;
			});
		}
		else
			printConnectionError();
	}, data);
}
function getPages(id)
{
	getJSON('/api?pages', 'get', function(err, response){
		if(err == null)
		{
			var idelement=document.getElementById(id);
			idelement.innerHTML='';
			for(i=1; i<=response; i++)
				idelement.innerHTML=idelement.innerHTML + '<div class="page"><a href="#!p=' + i + '" onclick="getArticles(articlesDiv, ' + i + ')">' + i + '</a></div>';
		}
		else
			printConnectionError();
	}, null);
}

document.addEventListener('DOMContentLoaded', function(){
	if(window.location.hash)
		getArticles(articlesDiv, window.location.hash.substring(4));
	else
		getArticles(articlesDiv, 1);
	getPages(pagesDiv);
});