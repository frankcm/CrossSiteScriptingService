# CrossSiteScriptingService
Your code makes an xmlhttp request to http://code.tagput.com/xss/xss.php?url=somefile.  Where some file is the url you actually
want to load.  Say you want to do a google search on your own page in javascript.  google.com does not allow xss, so instead you hit up http://code.tagput.com/xss/xss.php?url=http%3A%2F%2Fgoogle.com. 
It downloads the file server side and sends it back.
  
Example is at http://wwwold.charliefrank.com/code/xss/
