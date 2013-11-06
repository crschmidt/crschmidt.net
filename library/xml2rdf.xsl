<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
  xmlns:dct="http://purl.org/dc/terms/"
  xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:book="http://www.hackcraft.net/bookrdf/vocab/0_1/"
  xmlns:del="http://crschmidt.net/ns/delicious#"
  xmlns:foaf="http://xmlns.com/foaf/0.1/"
>
<xsl:output method="xml" indent="yes" media-type="application/xml" />
<xsl:variable name="fileLookupDoc" select="document('files.xml')"/>

 <xsl:template match="/library">
  <rdf:RDF>
  <del:Library rdf:parseType="Collection">
  <xsl:apply-templates select="items/book"/>
  </del:Library>
  </rdf:RDF>
 </xsl:template>


 <xsl:template match="book">
  <xsl:variable name="asin" match="@asin" />
  <xsl:if test="$asin != ''">
  <book:Book rdf:ID="a{@asin}">
    <dc:title><xsl:value-of select="@title" /></dc:title>
    <book:authoredBy><xsl:value-of select="@author" /></book:authoredBy>
    <del:uuid><xsl:value-of select="@uuid" /></del:uuid>
    <book:isbn><xsl:value-of select="@asin" /></book:isbn>
    <del:publishedBy><book:Publishser foaf:name="{@publisher}" /></del:publishedBy>
    <del:upc><xsl:value-of select="@upc" /></del:upc>
    <dc:description><xsl:value-of select="description" /></dc:description>
    <xsl:call-template name="image"><xsl:with-param name="uuid">
      <xsl:value-of select="@uuid" />
      </xsl:with-param></xsl:call-template>
  </book:Book>
  </xsl:if>
 </xsl:template>

<xsl:template name="image">
  <xsl:for-each select="$fileLookupDoc/container/image">
    <xsl:variable name="filename" select="@name" />
    <xsl:if test="$filename = $uuid">
    <foaf:depiction rdf:resource="images/{$filename}" />
    </xsl:if>
  </xsl:for-each>
</xsl:template>
</xsl:stylesheet>
