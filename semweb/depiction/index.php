<? include "../../template.php" ?>
<title>Image Depiction Stuff</title>
<body>
<p>Lately, my image depiction work has been in dealing with flickr. To that end, here is a copy of a script that I wrote last night, which uses flickr's API and masahide's flickr and exif tools to create a single RDF file describing the photo, given a flickr ID: <a href="flickr2rdf.py">flickr2rdf</a>.</p>
<p id="package">Using this, I was able to put together <a href="flickr2rdf.tar.gz">a package</a>: change a couple params (specifically, the user_id in users.getPublicPhotos in getPhotos.py) then run "getPhotos.py" to get all the RDF for all of your public flickr images (currently limited to 500 cause I'm lazy).</p>
<p>I wrote some old tools to do this. They are below. I never tested them fully, or finished them.</p>
<p><a href="sample.cwm.xml">Output</a>, passed through cwm</p>
<p><a href="input.example.txt">input</a>, the way that I got to the data I did.</p>
<p><a href="depiction.py.txt">code</a>, the mesh between them.</p>
</body>
