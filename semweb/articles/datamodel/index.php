<? include "../../../template.php" ?>
<title>RDF Data Model for Application Developers</title>
<body>
<? 
$_GET['page'] = ($_GET['page'] ? $_GET['page'] : substr($_SERVER['PATH_INFO'],1));
if (!$_GET['page']) { $_GET['page'] = 1; }
$pages = array("Introduction","Terminology");
print "<ul>";
foreach ($pages as $k=>$v) {
    if ($_GET['page'] == ($k+1)) {
        print "<li>$v</li>";
    } else {
        print "<li><a href='/semweb/articles/datamodel/page/".($k+1)."'>$v</a></li>";
    }
}
print "</ul>";
if ($_GET['page'] == 1) {
?>
    <p>
      The RDF data model is a powerful tool that application developers can
      use to deploy against a rapidly expanding data storage, expanding upon
      the work of others in the fields of machine readable languages. It can
      be used to create applications which take advantage of a large body of 
      work on data modelling, and can easily integrate with existing datastores.
    </p>
    <p>
      To develop with RDF, you must understand the model
      behind the tools. This article introduces that model.
      It is intended to serve as a short introduction to the 
      world of RDF, introducing only the concepts which are neccesary in 
      order to work with RDF from an application development standpoint.
      It is intended to be read alongside the 
      <a href="http://crschmidt.net/semweb/articles/intro/">Introduction to Application Development Using RDF</a>, serving as a primer for readers completely
      unaware of the nature of RDF.
    </p>
    <p>
      If you already know RDF, this tutorial is not for you! It is designed
      to be greatly simplified to explain only enough to allow application
      development, and not to explain the large body of work behind the RDF
      data model or the reasons for any particular choices in the syntax or 
      model itself.
    </p>
    <h3>Graph Nature of RDF</h3>
    <p>
      The basic data structure behind RDF is a directed, labelled graph. This
      means it is built up of nodes and edges. An RDF graph can encompass any
      number of statements, about any number of things. Each node in an RDF 
      graph is identified by one of:
    </p>
    <ul>
      <li>a URI (http://example.com/#auri)</li>
      <li>a graph-local unique identifier, also known as a "blank node" or "bnode"</li>
      <li>a literal object - typically a string, but can also be datatyped to better describe it.</li>
    </ul>
    <p>
      These are the nodes for the graph. The relationships between them are 
      identified using URIs. The RDF model is made extensible partly because 
      it is graph-like. The nature of the RDF model makes
      it easy for anyone to extend the descriptions offered of a specific 
      resource - whether it be a book, an identifier for a person, or anything
      else - and to merge this data in with an existing dataset.
    </p>
    <p>
      With these nodes, facts are stated in the form of "triples", each of
      which is a single fact or statement.
    </p>
    <h3>What's a Triple?</h3>
    <p>
      Data store sizes in RDF are discussed in terms of the number of "triples"
      in the data store. This is an identifier of how much information the data
      store has. (Note, however, that it is not neccesarily any indication of
      how much of that information is useful!) Each fact stored
      in an RDF representation is a statement with three parts: 
    </p>
    <ul>
      <li>a subject, either URI or blank node</li>
      <li>a predicate, a URI</li>
      <li>an object, a URI, blank node, or literal</li>
    </ul>
    <p>
      Each of these statements is known as a triple. If you prefer to think
      in the visual graph model, a triple is two nodes (subject and object),
      with the predicate as the relationship between them. Note, however,
      there there is no reason that the relationship itself can not become a 
      subject: it is perfectly reasonable to describe the relationship between
      a subject and object using the relationship as a subject. This is a core
      benefit of RDF for the semantic web, where information is used to 
      describe the meaning of relationships. 
    </p>

    <h3>Node Types</h3>
    <p>
      In working with RDF, you will experience the need to create and describe
      data which uses each of the three aforementioned 
      node types: URIs, blank nodes, and literals. Knowing which one is most appropriate is 
      important. Since much of the data creation will remain solely 
      internal to the application, however, choosing the correct node is typically
      choosing what is best for your use case, rather than for the whole 
      world. 
    </p>
    <p>
      Typically, if you have a choice of what kind of node to use,
      your choices are between a blank node, and a URI. For the most part, 
      these can be used interchangably: they are designed to suit the same 
      purpose. (One limitation of this is that predicates, the relationships 
      between nodes, can not be blank nodes - they must be URIs.) The major 
      difference between choosing a URI and using a blank node is that URIs
      are simple to recreate: if you chose a URI to identify something, you can
      reuse that URI again anywhere in the graph without any need to access
      the database to search for it. Blank nodes, on the other hand, are 
      specifically designed to be unique, and once you lose a node reference,
      typically you will need to search the existing data store to retrieve
      it based on some other identifying piece of information. URIs, on the
      other hand, serve as the RDF equivalent of the "Primary Key" in a
      relational database. Once you have the URI, you can query the datastore
      for this URI and related statements directly.
    </p>
    <p>
      Literals have several forms. Literals can simply be strings; this is the
      most common case. Alternatively, they can be datatyped, or have a 
      language attached to them. The latter is useful in cases where you wish
      to store, for example, multiple language versions of a specific chunk of
      text, possibly for use in user interface or other displays. Datatyped 
      literals may, in some APIs, offer some additional abilities based on the
      type: this is similar to setting a column type in typical RDB systems. 
      However, most APIs do not do any special changes based on a datatype, so
      avoid depending on this functionality for cross-API development.
    </p>
    
    <h3>Isn't RDF all Hype?</h3>
    <p>
      Although RDF is a technology used almost exclusively by proponents 
      of the semantic web, trusting or believing
      in the large scale Semantic Web is not a requirement for working with
      RDF: it can be seen simply as a data model with a number of well 
      developed APIs to work against this model. In this way it can be a useful
      tool to have in the toolbox: a larger and larger number of providers are
      starting to provide some of their data in RDF. Bootstrapping an 
      application against this data is a useful way to start with a base data
      set against which you can expand. 
    </p>
    <p>
      The main goal of this article, and its companion article aimed at 
      teaching the development tools available, is to show that the 
      extensible graph nature of RDF can provide
      a powerful framework to build your application against. The ability to
      load and work with existing datastores with no additional cost is a 
      benefit not easily tossed aside, if you work in an application domain
      where integration with external data is important. Given the increase of
      interaction between sites - with open APIs, protocols, and more becoming
      more common every day - tools which can seamlessly integrate data from
      remote or disparate sources can have significant benefits to your 
      application, as well as easing development.
    </p>
    
<? } else { ?>
    <h3>Terms</h3>
    <p>
      There are a number of terms in RDF which are either specific to the 
      technology, or have different meanings than when used in other situations.
    </p>
    <dl>
      <dt>Graph</dt>
      <dd>
        A data structure. An RDF graph is typically a description of a 
        particular set of triples, enclosed in a document or an application
        internal structure.
      </dd>

      <dt>Object</dt>
      <dd>
        Description of a subject. Third part of a triple.
      </dd>
      <dt>Parser</dt>
      <dd>
        A tool which reads in RDF files from the internet, and returns triples.
        This can be a parser of any number of formats: RDF has a number of 
        popular serializations. The API you choose may support different
        formats: common ones are Turtle, RDF/XML, and ntriples.
      </dd>
      
      <dt>Predicate</dt>
      <dd>
        The relationship between two nodes of a graph.
      </dd>
      
      <dt>Serializer</dt>
      <dd>
        Part of a toolkit which returns RDF triples from a model in a way that
        can be read by other RDF parsers. Similar to parsers supporting 
        different syntax, an API may support exporting triples to a file or 
        string in a number of syntaxes as well.
      </dd>
      
      <dt>Subject</dt>
      <dd>
        The node of a triple which is being described.
      </dd>
      
      <dt>Triple</dt>
      <dd>
        A single statement, built of three parts: Subject (object being described), Predicate (relationship), Object (description).
      </dd>
    </dl>
<? } ?>
</body>
