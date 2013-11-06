#!/bin/sh

HOST="crschmidt.net"
DIR="/var/www/crschmidt.net/htdocs/library/"
echo "<container>" > files.xml
for i in ~/Library/Application\ Support/Delicious\ Library/Images/Medium\ Covers/*; do 
  export j=`echo $i | sed -e 's!.*/!!'`
  echo "<image size='medium' name='$j' />" >> files.xml
done
echo "</container>" >> files.xml
xsltproc xml2rdf.xsl library.xml > books.rdf
python convert.py books.rdf > books.rdf
cwm.py --rdf books.rdf > books.rdf
xsltproc rdf2html.xsl books.rdf > books.html
