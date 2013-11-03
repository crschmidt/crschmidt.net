<? include "../../template.php" ?>
<? include "../../includes/header.php"; ?>
<title>Webcam History Browser</title>
<body>
<center>
<?	// open this directory 
	$myDirectory = opendir(".");
	// get each entry
	while($entryName = readdir($myDirectory))
	{
		if (strstr($entryName, "jpg") && !strstr($entryName, "current"))
			$dirArray[] = $entryName;
	}
	// close directory
	closedir($myDirectory);
	$indexCount = count($dirArray);
	sort($dirArray);
	$dirFlipped = array_flip($dirArray);

if (!$_GET['history']) {
	if (!$_GET[target])
		$link_prev = array_pop($dirFlipped);
	else {
		$link_prev = $_GET[target]-1;
		$link_next = $_GET[target]+1;
		if ($link_next >= $indexCount) $link_next = "";
	}
	?>
	<table width="100%">
		<tr>
			<td align="center" colspan="3">
	<? if ($_GET[target]) { ?>
	<img src="<?=$dirArray[$_GET[target]]?>" />
	<? } else { ?>
	<?=drawGfxImage("img=current.jpg","maxwidth=600","maxheight=400", "path=$CFG->docroot/webcam");?>
	<? } ?>
	<br />
	<? if ($_GET[target]) { $time = date("l dS of F Y \a\\t h:i A", filemtime($dirArray[$_GET[target]])); } else { $time = date("l dS of F Y \a\\t h:i A", file_get_contents("current.time")); } print "Image taken on $time"; ?>
			</td>
		</tr>
		<tr>
			<td align="center" width="40%">
	<?
	if ($link_prev) { ?>
	<a href="browse.php?target=<?=$link_prev?>"><img src="/images/icons/previous.gif" alt="Previous" /></a> 
	<? } ?>
			</td>
			<td align="center"><a href="browse.php"><img src="/images/icons/current.gif" alt="Current Image" /></a><br /><br />
				<a href="browse.php?history=1"><img src="/images/icons/thumbs.gif" alt="Thumbnails" /></a>
			</td>
			<td align="center" width="40%">
	<?if ($link_next) {
	?> <a href="browse.php?target=<?=$link_next?>"><img src="/images/icons/next.gif" alt="Next" /></a><? 
	} else if (isset($link_next)) {?> <a href="browse.php"><img src="/images/icons/next.gif" alt="Next" /></a><? }
	?>		</td>
		</tr>
	</table> <?
} else {
	if ($_GET[skip] > 0 && ($_GET[skip] < sizeof($dirArray))) { $add = sizeof($dirArray) - (6+$_GET[skip]); $dirArray = array_slice($dirArray,(-6-$_GET[skip]),6);} else { unset($_GET[skip]); $add = sizeof($dirArray) - 6; $dirArray = array_slice($dirArray,-6,6); }
	$i = 0;
	print "<table width='100%'><tr>\n";
	foreach ($dirArray as $k=>$v) {
		if ($k + $add) {
			$link = $k + $add;
			$time = date("l F dS, h:i A", filemtime($v));
			print "<td align='center'><a href='browse.php?target=$link'>".drawGfxImage("img=$v","maxwidth=150", "path=/var/www/htdocs/povray/20050410")."</a><br />$time</td>\n";
			$i++;
		}
		if ($i%3==0)
			print "</tr><tr>\n";
	}
	print "</tr><tr><td align='center'>";
    if (($_GET[skip] + 6) < $indexCount) 
	print "<a href='browse.php?history=1&skip=".($_GET[skip]+6)."'><img src='/images/icons/previous.gif' alt='Previous' /></a>";
	print "</td><td align='center'><a href='browse.php?history=1'><img src='/images/icons/currentthumbs.gif' alt='Current Thumbnails' /></a></td><td align='center'>";
	if ($_GET[skip] > 0) 
	print "<a href='browse.php?history=1&skip=".($_GET[skip]-6)."'><img src='/images/icons/next.gif' alt='Next' /></a>";
	print "</td></tr>
	</table>";
}
?>
</center>
</body>
