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
    <title>Flying, Photography, and other Geek Pursuits - Christopher Schmidt</title>
</head>
<body>
	    <div id="sidebar">
        <h3>Contact</h3>
        <ul style="margin-left:0px;padding-left:20px">
            <li>Email: <a href="mailto:crschmidt@crschmidt.net">crschmidt@crschmidt.net</a></li>
            <li><a href="https://www.facebook.com/crschmidt">Facebook</a>, <a href="http://twitter.com/crschmidt">Twitter</a>, <a href="https://plus.google.com/+ChristopherSchmidtcrs/posts">Google+</a></li>
            
<!--            <li><a href="/formal/resume.txt">Resume</a></li> -->
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
<ul id="mainlist">
  <li>
    I fly <a href="http://www.flickr.com/photos/nprnncbl/13317084063/">a quadcopter</a>.
  </li>
  <li>
    I <a href="https://www.flickr.com/photos/crschmidt/sets/">take photos</a>. 
  </li>
  <li>
    I <a href="https://www.youtube.com/playlist?list=PLjj2uycFdhzBsNJt0mGqivf960lE9R673">3d print things</a>.
  </li>
  <li>
    I have a <a href="http://crschmidt.net/blog/">blog</a>.
  </li>
  <li>
    I live in Cambridge, Massachusetts.
  </li>
  <li>
    I work for <a href="https://www.youtube.com">YouTube</a>.
  </li>
</ul>

<h2 style="margin-bottom: 0px;" >Recent Creations</h2>
<div class="homepageblock">
<h3>Blog Post: Response to FAA Policy Document</h3>
<a href="http://crschmidt.net/blog/archives/696/response-to-new-faa-policy-document/">Response to FAA policy document</a>, a blog post detailing my response to their stated new policies around UAV prosecution.
<blockquote>This entire policy is based on a mistaken notion that the “the FAA has considered model aircraft to be aircraft that fall within the statutory and regulatory definitions of an aircraft”; the definition that the FAA uses ...  is so broad as to describe everything from a commercial jetliner to a paper airplane</blockquote>
<small>June 25th, 2014</small>
</div>

<div class="homepageblock">
<h3>Quechee Gorge</h3>
<iframe width="350" height="240" src="//www.youtube.com/embed/WSKBm5m5css?list=UUfoS_RSsblA7N0szMu3btaw" frameborder="0" allowfullscreen></iframe><br />
Quadcopter flight over Quechee Gorge, include the river and the dam.
<small>June 23rd, 2014</small>
</div>


<div class="homepageblock">
<h3>Memorial Day Barbecue</h3>
<iframe src="https://www.flickr.com/photos/crschmidt/14096095787/in/set-72157644459782639/player/" width="320" height="213" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe><br />
Gathering with friends and food over Memorial Day.
<small>May 26th, 2014</small>
</div>

<div class="homepageblock">
<h3>One Minute Onboard</h3>
<iframe width="350" height="240" src="//www.youtube.com/embed/4zepIltKyE8?list=PLjj2uycFdhzC08S-cUKoOQpfpirFNc6LM" frameborder="0" allowfullscreen></iframe>
One minute clips of flying the quadcopter (mostly) around Cambridge, MA including flying over the MIT dome, along the Charles River, and at the Arnold Arboretum. Unedited shots, showing the raw footage you get from the quadcopter. 
<small>May 15th-22nd, 2014</small>
</div>

<div class="homepageblock">
<h3>On Technology</h3>
<blockquote class="twitter-tweet" lang="en"><p>A friend today asked &quot;Have you ever in your entire life *casually* adopted a technology?&quot; My answer? &quot;I don&#39;t understand the question.&quot;</p>&mdash; Christopher Schmidt (@crschmidt) <a href="https://twitter.com/crschmidt/statuses/466043504222011393">May 13, 2014</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>

<div class="homepageblock">
<h3>Blog Post: Is that a Drone?</h3>
<blockquote>... Of course, with any new technology, there are a set of FAQs that you should expect. The Quad is no exception.</blockquote>
<a href="http://crschmidt.net/blog/archives/667/is-that-a-drone-adventures-with-a-quadcopter/">Information about my quadcopter, including an FAQ.</a> Includes answers to the most common questions I get; these later got turned into a business card I printed for myself to bring with when I go flying.
<small>Apr 24th, 2014</small>
</div>


<br clear="both" />

<h2>Older</h2>

<div class="homepageblock">
<h3>Initial Forays into 3D Printing</h3>
<iframe src="https://www.flickr.com/photos/crschmidt/12013178695/player/" width="320" height="213" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>

<br /><a href="http://crschmidt.net/blog/archives/645/initial-forays-into-3d-printing/">My first steps in 3d printing</a>.
<small>Jan 19th, 2014</small>
</div>

<div class="homepageblock">
<h3>3D Printer Assembly</h3>
<iframe width="350" height="240" src="//www.youtube.com/embed/C7XUY3wFb74" frameborder="0" allowfullscreen></iframe>
Time lapse of assembley of Printrbot 3D printer.
<small>Jan 11, 2014</small>
</div>
<div class="homepageblock">
<h3>African Safari</h3>
<iframe src="https://www.flickr.com/photos/crschmidt/2936441550/in/set-72157607880167906/player/" width="320" height="213" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
Photos from Kruger National Park visit.
<small>October, 2008</small>
</div>

<div class="homepageblock">
<h3>OpenLayers Tutorial</h3>
<iframe width="350" height="240" src="//www.youtube.com/embed/WJt0rAyD2xU" frameborder="0" allowfullscreen></iframe>
My <a href="http://crschmidt.net/blog/archives/661/openlayers-still-popular-on-youtube-years-later/">most popular YouTube video</a>.
<small>Fall, 2007</small>
</div>

<br clear="both" />
</body>
</html>
