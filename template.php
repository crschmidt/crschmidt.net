<?
include "includes/header.php";
/* ==================================================================== */
/* Standard page template format										*/
/* To enable, add the following directive to apache site config:		*/
/* AliasMatch ^(.*)\.php$ /unixweb/web/{DOMAIN}/htdocs/template.php		*/
/* ==================================================================== */

if(!$norender){
	ob_start("template");				// Start Output Buffer
	}
	


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// [S] P A G E  T E M P L A T E
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

#$comments_html = format_comments(get_comments($_SERVER['SCRIPT_NAME']));

$template = <<<TEMPLATE
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>{{TITLE}} » crschmidt.net</title>
	<link rel="stylesheet" href="/stylesheet.css" />

    {{HEAD}}
	$headaddl
</head>
<body{{MOREBODY}}>
<div id="navigation">
	<div><a href="/" style="text-decoration:none; color:#fff"><span style="font-size:1.1em; font-family: Times, serif; margin-right: 30px; ">crschmidt.net</span></a></div>
</div>
<ul id="navlinks">
    <li><a href="/blog/">Blog</a>    </li>
    <li><a href="http://flickr.com/photos/crschmidt/">Photos</a>    </li>
    <li><a href="http://youtube.com/user/crschmidt/">Videos</a>    </li>
    <li></li>
    <li><a href="#">Older:</a></li>
    <li><a href="/mapping/">Mapping</a>    </li>
    <li><a href="/semweb/">Semweb</a>    </li>
    <li><a href="/foaf/">FOAF</a></li>
    <li><a href="/services/">Services</a></li>
    <li><a href="/symbian/">Symbian</a>    </li>
    <li><a href="/python/">Python</a>    </li>
    <li><a href="/povray/">Povray</a>    </li>
    </ul>
    <br style="clear:both" />
<div class="content">
<h1>{{TITLE}}</h1>
{{BODY}}
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-2577731-1");
pageTracker._trackPageview();
} catch(err) {}</script>
<p class="credit"><cite>Copyright 2003-2014, Christopher Schmidt</cite></p>
</body>
</html>

TEMPLATE;

//<div id="comment" style="display:none;">
//<form action="/comments/" method="post">
//<h3>Comments on {{TITLE}}</h3>
//$comments_html
//<input type="hidden" name="url" value="$_SERVER[SCRIPT_NAME]" />
//Name: <input type="text" name="name" style="width:50%" /><br />
//<textarea style="width:100%" rows="5"  name="comment" cols="60"></textarea>
//<br />
//<input type="submit" value="Submit Comment" />
//</form>
//</div>

//<script type="text/javascript"><!--
//google_ad_client = "pub-0317335839654252";
//google_ad_width = 728;
//google_ad_height = 90;
//google_ad_format = "728x90_as";
//google_ad_channel ="";
//google_color_border = "FFFFFF";
//google_color_bg = "FFFFFF";
//google_color_link = "000000";
//google_color_url = "666666";
//google_color_text = "333333";
////--></script>
//<script type="text/javascript"
//  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
//  </script>

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// [E] P A G E  T E M P L A T E
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// Substitute content into template page

function template($buffer){
	global $template, $printfriendly;
	
	preg_match("/<title(.*?)>(.*?)<\/title>/si", $buffer, $t);
	$title = $t[2];
	
	// Extract Body Content
	preg_match("/<body(.*?)>(.*?)<\/body>/si", $buffer, $b);
	$body = "$b[2]";
        $bodyextra = "$b[1]";	
	header("Expires: ".date("r", time()+(6*3600)));
    // Extract Addl HEAD content
	preg_match("/<headaddl(.*?)>(.*?)<\/headaddl>/si", $buffer, $h);
	$head = "$h[2]";
	
	if (!$body) { $body = $buffer; }
	// Search/replace arrays
	$search = array("{{TITLE}}","{{BODY}}","{{HEAD}}", "{{MOREBODY}}");
	$replace = array($title,$body,$head, $bodyextra);
	
	// Replace Content in Template
    $results = str_replace($search,$replace,$template);
	
	// Drop outer template, use HTML if printfriendly
	if($printfriendly){
		$results = $buffer;
		}
    	
	return $results;
	}

?>
