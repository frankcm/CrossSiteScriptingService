<?
	//do a wget on $url, no-check-certificate makes ssl work without bitching
	// -O - means output to stdout
	$url=$_GET['url'];
	$url=escapeshellarg($url);
	$html=`wget  --no-check-certificate -O - $url `;
	
	//if a callback parameter was passed, output javascript code that calls the callback
	//with the webpage content as a string parameter.  Instead of an ajax request, this is used for
	//adding a script to the dom <script src='http://code.tagput.com/xss/xss.php?url=someurl&callback=myfunc'></script>  
	if($_GET['callback']){
		echo "$_GET[callback](".json_encode($html).");";
	}
	//otherwise just output it.  This is used when called from ajax
	else{
		echo $html;
	}
?>
