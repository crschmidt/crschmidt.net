#!/usr/bin/python
 
import urllib
import xml.dom.minidom as minidom

u = urllib.urlopen("http://www.livejournal.com/users/crschmidt/data/rss")
xmldata = u.read()
u.close()

xmldoc = minidom.parseString(xmldata)

metadata = {}

for i in xmldoc.getElementsByTagName("item"):
   link = ""; musictext = ""; moodtext = ""; date = ""
   link = i.getElementsByTagName("link")[0].firstChild.nodeValue
   date = i.getElementsByTagName("pubDate")[0].firstChild.nodeValue
   music = i.getElementsByTagName("lj:music")
   mood = i.getElementsByTagName("lj:mood")
   if len(music):
       musictext = music[0].firstChild.nodeValue
   if len(mood):
       moodtext = mood[0].firstChild.nodeValue
   metadata[link] = { 'music': musictext, 'mood': moodtext, 'date': date }

print metadata
