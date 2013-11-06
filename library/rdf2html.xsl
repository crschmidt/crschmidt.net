<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
  xmlns:dct="http://purl.org/dc/terms/"
  xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:book="http://www.hackcraft.net/bookrdf/vocab/0_1/"
  xmlns:del="http://crschmidt.net/ns/delicious#"
  xmlns:foaf="http://xmlns.com/foaf/0.1/"
  xmlns="http://www.w3.org/1999/xhtml"
>
<xsl:output method="html" indent="yes"/>


 <xsl:template match="/rdf:RDF">
  <html>
  <head>
  <style type="text/css">
  p { margin:0px; }
  </style>
  </head>
  <body>
  <xsl:apply-templates select="book:Book"/>
  </body>
  </html>
 </xsl:template>



 <xsl:template match="book:Book">
  <div id="{@rdf:ID}" style="clear:both" >
    <xsl:variable name="depiction" select="foaf:depiction/@rdf:resource" />
    <xsl:if test="$depiction != ''"><img src="{foaf:depiction/@rdf:resource}" style="float:right; margin:10px;" /></xsl:if>
    <h2><xsl:value-of select="dc:title" /></h2>
    <p class="author"><strong>Author:</strong> 
    <xsl:value-of select="book:authoredBy" /></p>
    <p class="uuid"><strong>UUID:</strong> 
     <xsl:value-of select="del:uuid" /></p>
          
    <p class="publisher"><strong>Publisher:</strong>  
      <xsl:value-of select="del:publishedBy/foaf:name" /></p>
    <p class="upc"><strong>UPC:</strong>  
      <xsl:value-of select="del:upc" /></p>
    <p class="description"><strong>Description:</strong> 
    <xsl:value-of select="dc:description" /></p>
  </div>
 </xsl:template>


</xsl:stylesheet>
