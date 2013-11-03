<? include "template.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<headaddl>
 <link rel="openid.server" href="http://www.livejournal.com/openid/server.bml" />
<link rel="openid.delegate" href="http://www.livejournal.com/users/crschmidt/" />
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
    <link rel="meta" title='FOAF' type='application/rdf+xml' href='http://crschmidt.net/foaf.rdf' />
</headaddl>
    <title>Christopher Schmidt: GIS and Web Hacker</title>
</head>
<body>
	    <div id="sidebar">
        <h3>Contact</h3>
        <ul style="margin-left:0px;padding-left:20px">
            <li>Email: <a href="mailto:crschmidt@crschmidt.net">crschmidt@crschmidt.net</a></li>
            <li>AIM: cr5chmidt</li>
            <li>Skype: cr5chmidt</li>
        </ul>
<?php

define('MAGPIE_DIR', 'includes/magpie/');
require_once(MAGPIE_DIR.'rss_fetch.inc');


$url = "http://crschmidt.net/blog/feed/rdf";

if ( $url ) {
	$rss = @fetch_rss( $url );
	if ($rss) {
        $item1 = $rss->items[0];
        $rss = array_slice($rss->items, 1, 4);	
        echo "<h3>Latest Weblog Posts</h3>";
	    	$href = $item1['link'];
	    	$title = $item1['title'];
	    	$date = date("D M j G:i:s T Y", parse_w3cdtf($item1['dc']['date']));
	    	echo "<p><a href='$href'>$title</a><br />$date</p>".$item1['description']." <a href='$href'>[more]</a>";
	    	echo "<ul style='margin-left:0px;padding-left:20px;'>";
	    foreach($rss as $item) {
	    	$date = date("D M j Y", parse_w3cdtf($item['dc']['date']));
	    	$href = $item['link'];
	    	$title = $item['title'];	
	    	echo "<li><a href='$href'>$title</a> - $date</li>";
	    }
	    echo "</ul>";
    }
}
?>
	<p>If I'm not the Christopher Schmidt you're looking for, you might check the <a href="/disam">disambiguation page</a> to see if you can find the one you really meant.</p>
     
<?php
include "links_include.php"
?>    </div>
<p>
  I am a professional web application developer, and have spent the past several
  years developing server and client side tools for the creation of web 
  applications, especially applications which relate to mapping.
  Some of my most visible work over the past year is in the 
  OpenLayers/TileCache/FeatureServer stack, a collection of open source 
  tools designed to help users build mapping applications.
</p> 
<h2>Projects</h2>
<ul style="margin-bottom:10px;">
<li><a href="http://code.google.com/p/webprocessingserver/">WPServer</a> - RESTful Geodata Processing Server</li>
<li><a href="http://featureserver.org/">FeatureServer</a> - Online Vector feature storage. Sponsored by <a href="http://www.metacarta.com/">MetaCarta</a>.</li>
<li><a href="http://tilecache.org/">TileCache</a> - Map tile caching tool. Sponsored by <a href="http://www.metacarta.com/">MetaCarta</a>.</li>
<li><a href="http://www.openlayers.org/">OpenLayers</a> - Open Soure AJAX Mapping interface. Sponsored by <a href="http://www.metacarta.com/">MetaCarta</a>.</li>
<li><a href="http://gsmloc.org/">GSMLoc</a> - Cell stumbling web service, Featured on Wired.com</li>
<li><a href="http://boston.openguides.org/">Open Guide to Boston</a> - part of the <a href="http://openguides.org/">OpenGuides Network</a>.</li> 
</ul>
<p>
  I have experience in a variety of technologies, developed over many years: I
  have worked on projects ranging from mobile location services to the semantic
  web, from Python examples to PHP applications on the Ning platform. These
  days, I work largely with Python on the server, Javascript on the client, and
  GIS as the application area.
</p>  


<h3>Photography</h3>
<p>
  You may have stumbled into me because of seeing some of my photography. I'm
  an amateur photographer, and most of my photos can be found online via my <a
  href="http://flickr.com/photos/crschmidt/">Flickr Account</a>. Note that any
  public photos are released under a CC-By-SA license. This means that you can
  use them in any way you wish, so long as you allow others to do the same, and
  give credit to me.
</p>
<p>
  I do ask that if you use my photography, you drop me a note to let me know 
  when and where you're using it - I do love to see people getting use 
  out of my work.
</p>

<h3>Life</h3>
 <p>
   I'm a married stepfather of two, living in Cambridge, MA. In general, my
   more personal observations on life take place in my <a
   href="http://crschmidt.livejournal.com/">LiveJournal</a>. (LiveJournal is an
   online journalling site -- specifically for me, it's the online journalling
   site where I met my wife.) 
 </p>
 <p>
   My <a href="http://flickr.com/photos/crschmidt/">Flickr photos</a> show
   snapshots of life.
 </p>  

<h3>Older Projects</h3>

<ul>
  <li>
     <a href="/symbian/">Symbian Hacking</a> - Hacking via Python for my mobile phone.
  </li>
  <li>
     <a href="/semweb/">Semantic Web Hacking</a> - Various code and projects I've worked on under the guise of the Semantic Web
  </li>
  <li>
     <a href="http://sdlroads.sourceforge.net/">SDLRoads</a> - Project written in combination with roommate and a friend, an SDL+OpenGL clone of the DOS game, Skyroads.
  </li>
  <li>
     <a href="http://crschmidt.net/dashboard/">Dashboard</a> - Integration of data sources from running applications and outputting useful information taken from clues. Project backend and engine in C#, frontends in whatever language the application supports.
  </li>
  <li>
     <a href="http://crschmidt.net/foaf/">FOAF</a> - Friend of a Friend information, patches, etc. Friend of a Friend is an RDF based machine readable format of information about who you are. <a href="http://www.foaf-project.org">FOAF-Project</a> for more.
  </li>
  <li>
     <a href="http://crschmidt.net/povray/">Povray</a> - Ray Tracing program, with links to other competitions plus my own creations.
  </li>
</ul>
<br clear="both" />
</body>
</html>
