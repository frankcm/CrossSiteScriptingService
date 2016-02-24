<?
	//do a wget on $url and output it back as literal parameter to callback
	$url=$_GET['url'];
	$url=escapeshellarg($url);
	$html=`wget  --no-check-certificate -O - $url `;
	echo "$_GET[callback](".json_encode($html).");";

exit;
?>
<? ob_start();?>
	<script type='text/javascript' src='http://www.bridgewater.edu/bccode/jquery.js'></script>
		<script>	
		/*		
		$(function(){
			$('a').click(function(e){
				var url='http://code.tagput.com/cmf.php?url='+encodeURIComponent(this.href);
				this.href=url;
				console.log('clicked '+this.href);
//				e.preventDefault();
			});
			$("form").each(function(i,e){this.action='http://code.tagput.com/cmf.php?url='+encodeURIComponent(this.href);});
		});
		var cmf=XMLHttpRequest.prototype.open;
		XMLHttpRequest.prototype.open=function(){
			console.log("xmlhttprequest "+arguments[0]+","+arguments[1]);
			cmf.apply(this,arguments);
		}
		~*/
		</script>

<?
	$mycode=ob_get_clean();
	if($_GET["url"]){
	//	header("Content-Type: text/javascript");
		$url=$_GET['url'];
		
		preg_match('/(https?):\/\/([^\/]+)(.*?)\/([^\/]*)$/i',$url,$matches);
		$url=escapeshellarg($url);
		//$hs=getallheaders();
		//$headers=" --header=".escapeshellarg("Cookie: $hs[Cookie]");
		//$headers.=" --header=".escapeshellarg("User-Agent: ".$hs['User-Agent']);
		

		$html=`wget  $headers -O - $url `;
		$base=$matches[1]."://".$matches[2].$matches[3]."/";
		
		//$html=preg_replace('/(src|href)=([\'" ])(?!https?:)/i',"$1=$2$base",$html);
		
		$html=preg_replace('/<head[^>]*>|<body[^>]*>|$/i',"$0 <base href='$base'>",$html,1);
		echo "$_GET[callback](".json_encode($html).");";//echo htmlspecialchars("$html");
/*
		?>
		var stuff=<?=json_encode($conts)?>;
		var a=document.getElementById("a");
		a.textContent=stuff;
		<?
		
		ajax request are handled by over-riding XMLHttpObject.open
		*/
	} 
	if($_GET['top']=='1'){
		echo "url <input name='url' onchange='console.log(this.value);'/>";
	}
?>
<html>
<title>Proxy</title>
	<frameset rows="10%,*">
	  <frame src="?top=1" />
	  <frame name='bot' >
	</frameset>
</html>
