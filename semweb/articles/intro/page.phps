<? include "../../../template.php" ?>
<title>Introduction to Working with Redland and Python</title>
<body>
<? 
$_GET['page'] = ($_GET['page'] ? $_GET['page'] : substr($_SERVER['PATH_INFO'],1));
if (!$_GET['page']) { $_GET['page'] = 1; }
$pages = array("Creating your first RDF Store",
               "Adding More Data");
print "<ul>";
foreach ($pages as $k=>$v) {
    if ($_GET['page'] == ($k+1)) {
        print "<li>$v</li>";
    } else {
        print "<li><a href='/semweb/articles/intro/page/".($k+1)."'>$v</a></li>";
    }
}
print "</ul>";
if ($_GET['page'] == 1) {
?>
    <p>
      Many of the complaints about the current status of RDF relate to its level
      of development tools. Although there are a number of tools out there, due 
      to the lower level of general deployment compared to XML, examples of working 
      with RDF are less generally available. 
    </p>
    <p>
      RDF provides a data model which can be used to rapidly deploy application
      services without the deployment of a full RDBMS and related data tables. 
      Due to RDF's natural ability to represent data without the need for a
      pre-defined schema, changes can propogate more quickly. Additionally, 
      the use of RDF as the primary data model allows for a level of extensibility,
      using external data sources to populate internal data with relative ease.
    </p>
    <p>
      Given the ability to use RDF in this manner - rapidly deployed application 
      services either as a prototype or as a permanant solution, encouraging 
      extensibility and flexibility in the data model - RDF can be an ideal fit
      for a number of applications. 
    </p>
    <p>
      This article hopes to serve as a demonstration of how to create an 
      application based on RDF, using Redland and its Python bindings to create
      the full application from start to finish.
    </p>
    
    <div class="beforeyoustart">
    <h3>Before You Start</h3>
    <p>Before beginning this tutorial, you should have:</p>
        <ul>
          <li>Working knowledge of Python</li>
          <li>Installed Redland according to the <a href="http://librdf.org/INSTALL.html">Installation Instructions</a></li>
          <li>Installed the <a href="http://librdf.org/bindings/">Redland Language Bindings</a> for Python</li>
        </ul>
    </div>
    <h3>Section One: Creating your first RDF Model</h3>
    <p>
      In Redland, a Model is your main dataset. You can have multiple models - 
      stored seperately in the database, loaded from a file, or created locally for
      a specific purpose. Typically, you will only have one main model for your
      application, although this may be different given varying use cases. In this
      first step, we will show how to create a Model, add data to it, and 
      manipulate that data.
    </p>
    <p>
      Our example dataset in this section will be the creation of a database about 
      books in a house. I have a book named <u>Speaker for the Dead</u>, by Orson 
      Scott Card. This book has a number of properties, such as the author, number
      of pages, a description, title, etc. This can all be stored in an RDF Model.
    </p>
    <p>
      First, we create an identifier for our book. In the case of any item which 
      has an <acronym title="International Standard Book Number">ISBN</acronym>,
      our task is already complete for us: <a href="http://www.ietf.org/rfc/rfc3187.txt">RFC 3187</a> defines a URI scheme for describing ISBNs. By this token, 
      <u>Speaker for the Dead</u> has an identifier of <tt>isbn:0-81255075-7</tt>.
      We will use this identifier as a URI in the subject of all our statements 
      about the book. 
    </p>
    <p>
      Once we have an identifier for the book, we can create a triple, or a single
      piece of information, about that identifier. The first statement we will make 
      will be to declare the title of the book. All statements in RDF consist of 
      three parts: an identifier (subject), what kind of statement it is 
      (predicate), and the value of that statement, either in another identifier or
      as a literal value (object). Predicates are always URIs: that is, they are 
      some, typically dereferencable, URI to describe the type of relationship the 
      object has to the subject. There are a large number of these already available
      for many common properties: in the case of title, we will be using the DCMI
      Metadata Terms. For the title, we have the 
      <a href="http://dublincore.org/documents/dcmi-terms/#title">title element</a> 
      - "A name given to the resource. ... Typically, a Title will be a name by 
      which the resource is formally known." The URI for this term is 
      <tt>http://purl.org/dc/elements/1.1/title</tt>. Lastly, since we know the 
      title of the book, we use this as the object for the statement/fact/triple.
      In the end, we have three parts to our fact:
      </p>
      <ul>
        <li>Subject, Identifier: <tt>isbn:0-81255075-7</tt></li>
        <li>Predicate, Type of fact: <tt>http://purl.org/dc/elements/1.1/title</tt></li>
        <li>Object: "Speaker for the Dead"</li>
      </ul>
    <p>
      Now that we know the general idea behind what we're doing, we can write some 
      code. The first step to working with Redland in Python is to import the 
      Redland Python module, RDF. Attached to this module are a large number of 
      features - you can see these via the pydoc of RDF, or via the 
      <a href="http://librdf.org/docs/pydoc/RDF.html">Official RDF Module Documentation</a> 
      online. Reading this, we see the <a href="http://librdf.org/docs/pydoc/RDF.html#Model">Model</a> class, with which we can build our data set.
      First, we create a model:
    </p>
    <pre class="codesample">import RDF
model = RDF.Model()</pre>
      <p>Then, we create a statement, and add it to the model.</p>
    <pre class="codesample">subject = RDF.Uri("isbn:0-81255075-7")
predicate = RDF.Uri("http://purl.org/dc/elements/1.1/title")
object = RDF.Node("Speaker for the Dead")
statement = RDF.Statement(subject, predicate, object)
model.append(statement)</pre>
    <p>
      You can add as many statements to the model as you wish: there is no "bounds 
      checking" at the model level in RDF (other than the preventing of stating the
      same fact twice, enforced by Redland). To add a new statement, simply follow 
      the above example. Note that there is no need to create the subject, 
      predicate, and object seperately: they can be created in the RDF.Statement 
      call as well with no ill effects.
    </p>
    <p>
      Once we have this data, however, what do we do with it? In order to use this 
      data in an application, we need to learn how to retrieve the data from a 
      graph based data store. The best way to do this in Redland's RDF module is
      via the find_statements method of the Model class. This allows us to specify
      a statement, with any part of the triple pattern missing, and will return all
      statements which match. We have a unique identifier &mdash; the isbn: URI 
      &mdash; which we can use to search the model.
    </p>
    <pre class="codesample">statement = RDF.Statement(subject, None, None)
bookdata = model.find_statements(statement)
for fact in bookdata:
    print fact</pre>
    <p>
      This code snippet will print out all the RDF statements we have added to our 
      model which match subject, None, None. This will be all the facts associated
      with our identifier - all the facts about the book.
    </p>
    <p>
      You now know how to create a model, add a statement, and search the model
      for statements based on an identifier. However, there are many times when
      this will not be enough: you will need to search through for a specific 
      part of information, or store more complex data. These tasks will be
      covered in the next section of this tutorial.
    </p>
    
    <h3>References</h3>
    <ul>
      <li><a href="http://librdf.org/">Redland RDF Application Framework</a></li>
      <li><a href="http://librdf.org/bindings/">Redland RDF Language Bindings</a></li>
      <li><a href="http://dublincore.org/documents/dcmi-terms/">Dublin Core Element Terms</a></li>
      <li><a href="section1.py">Section 1 Code Example</a></li>
    </ul>
<? } else if ($_GET['page'] == 2) {?>
    <h3>Section Two: Adding More Data</h3>
    <p>
      In the first section of this article, we discussed how to initialize our data
      store, and add our first fact, then pull the data out. We also mentioned that
      we can retrieve the data based on the identifier for our data set. What might
      not be obvious is that we can describe not only our own objects, but any 
      concept or item, real world or electronic. In our previous example, we added
      a "title" property to the book. However, there is nothing in our data model 
      that we have used to describe this property. We could add additional data 
      that our application would need - perhaps information on how to display the
      property.
    </p>
    <p>
      In this case, the identifier for our data is the URI of our predicate: 
      <tt>http://purl.org/dc/elements/1.1/title</tt>. One piece of data that we 
      might want to use is an application-specific property to describe the 
      text for displaying this title. Our predicate will fall into an application
      specific namespace: For the rest of this tutorial, any time we wish to add
      application specific identifiers, we will use the namespace 
      <tt>http://example.org/bookapp/appdata#</tt> to do so. By thhis token, we 
      can coin a "displayedName" term: 
      <tt>http://example.org/bookap/appdata#displayedName</tt>. For this property,
      our displayed name will be "Book Title". Describing this data as a triple
      again, we have:
    </p>
    <ul>
      <li>Subject: <tt>http://purl.org/dc/elements/1.1/title</tt></li>
      <li>Predicate: <tt>http://example.org/bookap/appdata#displayedName</tt></li>
      <li>Object: "Book Title"</li>
    </ul>
    <p>
      We add this data to our model in the same was as before. (These code 
      examples assume you have already followed the steps in example 1, and
      build upon that.)
    </p>
    <pre class="codesample">subject = RDF.Uri("http://purl.org/dc/elements/1.1/title")
predicate = RDF.Uri("http://example.org/bookap/appdata#displayedName")
object = RDF.Node("Book Title")
statement = RDF.Statement(subject, predicate, object)
model.append(statement)</pre>
    <p>
      Here, we begin to see how the extensible nature of the RDF data model 
      provides us more flexibility than a typical RDBMS solution would. We've added
      a new property to our data structure - something that in a database system
      might be the creation of an entirely new table - at possibly significant 
      deployment cost. Now consider the fact that every single identifier can have
      any data added about it, and you start to realize the power of having a data
      graph to store your application information in. You can extend each 
      identifier with an infinite number of properties with no cost at the model 
      level.
    </p>
    <p>
      Of course, there may also be times when you don't have a unique identifier 
      readily available. For example, if we were to store the publisher data, we
      might want to not store just a name, but also additional information about
      the publisher. However, there is no single unique identifier for a publisher
      as there is for books, via the ISBN number. So, instead, we create what is 
      known as a "blank" node - an identifier which is only unique in the given
      context. In this case, our RDF store is the context.
    </p>
    <p>
      Once we have this blank identifier, we can search based on properties of it
      to find it - the same way you would if you had a name for someone, but no
      address. For this example, we'll add a title using the Dublin Core
      Elements, just as we did for the book.
    </p>
    <pre class="codesample">subject = RDF.Node()
predicate = RDF.Uri("http://purl.org/dc/elements/1.1/title")
object = RDF.Node("Tor Books")
statement = RDF.Statement(subject, predicate, object)
model.append(statement)</pre>
    <p>
      What's important to note here, however, is that if we wish to add additional 
      statements about this publisher, it is best to keep the subjectnode around,
      since finding it again is slightly more difficult than simply constructing
      an identifier: blank nodes are unique in the model, so every time you call
      RDF.Node(), you will receive a new blank node. In this case, we may also wish 
      to specify what type of node this is -- a book, a publisher, a person, or 
      anything else that we might want to describe. RDF provides a mechanism for
      describing the type of object something is -- this can be used in more 
      complex mechanisms that are beyond the scope of this article. Within the
      context of this article, however, we will use these types to create display
      templates for the nodes. In RDF, one should always try to give a type to
      your nodes if one makes sense, as this gives some idea of the type of content
      being described to other people who may use your data.
    </p>
    <p>
      To add a type to a node, the predicate used should be 
      <tt>http://www.w3.org/1999/02/22-rdf-syntax-ns#type</tt>. We already have a
      blank node to use as an identifier. There is no commonly used term for a 
      Publisher, so we will coin one -- 
      <tt>http://example.com/bookdata/appdata#Publisher</tt>. This gives us the 
      three parts of our statement. Once we add the type to this node, we can attach the 
      node to the Book we created in the first section. To do this, we will use the ISBN
      identifier node as the subject, the Dublin Core term publisher 
      <tt>http://purl.org/dc/elements/1.1/publisher</tt> as the predicate of the
      statement, and use the blank node as the object.
    </p>
    <pre class="codesample">predicate = RDF.Uri("http://www.w3.org/1999/02/22-rdf-syntax-ns#type")
object = RDF.Uri("http://example.org/bookap/appdata#Publisher")
statement = RDF.Statement(subject, predicate, object)
model.append(statement)

book = RDF.Uri("isbn:0-81255075-7")
predicate = RDF.Uri("http://purl.org/dc/elements/1.1/publisher")
statement = RDF.Statement(book, predicate, subject)
model.append(statement)</pre>
   <div class='callout' style='margin: 0px 0px 10px 10px;float:right;'><img src="/semweb/articles/intro/section2.jpg" /></div>
   <p>
     Once we have done this, we have a slightly more complex model of the book than
     we did previously. However, we can still use the exact same code as we did
     before, with the <tt>find_statements</tt> call, to collect the information
     about the book. If we run the code we developed before again, we will see a 
     different output, however:
  </p>
  <pre  style="clear:both" class="output">{[isbn:0-81255075-7], [http://purl.org/dc/elements/1.1/title], "Speaker for the Dead"}
{[isbn:0-81255075-7], [http://purl.org/dc/elements/1.1/publisher], (r1123969748r1)}</pre>
  <p>
    As you can see, we have different syntax in the output for URIs, which are contained
    in [], literals, which are enclosed in quotes, and blank nodes, which are enclosed
    in (). This is simply the default serialization, designed to give some visual cues
    as to the data you're looking at: this can of course be reformatted. This syntax
    is specific to Redland, rather than to RDF or anything else.
  </p>
  <p>
    If we wish to show all the data related to the publisher, and we have lost the 
    blank node we generated, we can first find it again, using a find_statements call
    to find the node from the publisher title, then using the subject node we find to
    discover other data:
  </p>
  <pre class="codesample">statement = RDF.Statement(None, 
                          RDF.Uri("http://purl.org/dc/elements/1.1/title"), 
                          RDF.Node("Tor Books"))
pubdata = model.find_statements(statement)
pubnode = None
for fact in pubdata:
    pubnode = fact.subject
    break

statement = RDF.Statement(pubnode, None, None)
pubdata = model.find_statements(statement)
for fact in pubdata:
    print fact</pre>
   <p>This gives us the result we would expect:</p>
   <pre class="output">{(r1123970463r1), [http://purl.org/dc/elements/1.1/title], "Tor Books"}
{(r1123970463r1), [http://www.w3.org/1999/02/22-rdf-syntax-ns#type], 
                  [http://example.org/bookap/appdata#Publisher]}</pre>

   <p>
     We now know the various types of nodes in RDF, how to use them to create data, 
     and how to find that data, including existing blank nodes with no unique identifier.
     The next step will be to learn how to modify or delete data.
   </p>
   
<? } ?>
</body>
