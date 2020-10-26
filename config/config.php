<?php

// Warning: If you use the Open Semantic Search Apps web admin config user interface for configuration
// some settings of this config file will be overwritten by the later included autogenerated config config.webadmin.php !

//
// Show debug infos
//

$cfg['debug'] = false;

//$cfg['debug'] = true;

// Show preview tab and facet with ETL status like used plugins / ETL error messages
$cfg['etl_status'] = true;

// Show import status, if still open file import / text extraction tasks
$cfg['etl_status_warning'] = true;


//
// Default operator (can be switched by users in UI by search options)
//

$cfg['operator'] = 'AND';
// $cfg['operator'] = 'OR';


//
// Language
//


//
// User interface
//


// English
$cfg['language'] = 'en';

// German / Deutsch
// $cfg['language'] = 'de';

// Portuguese / Português (Brasil)
// $cfg['language'] = 'pt';

// Italian
// $cfg['language'] = 'it';

// Arabic
// $cfg['language'] = 'ar';


// indexed languages to search in by language specific text analysis
// if not set/limited here, all languages that are supported in index are enabled
//$cfg['languages'] = array('en','de','es','fr','hu','nl','ro','ru','cz','it','ar','fa','pt');


//
// Solr Host, Port and path / core
//

// default: localhost:8983/solr/

// $cfg['solr']['host'] = 'localhost';
// $cfg['solr']['port'] = 8983;
// $cfg['solr']['path'] = '/solr';

$cfg['solr']['core'] = $_SESSION['SolrCurrentCore'];
//
// Additional facets (f.e. fields imported by some connector which should be shown in the sidebar)
//
// $cfg['facets']['yourfacet_s'] = array ('label'=>'Additional own facet');
// $cfg['facets']['anotherfacet_s'] = array ('label'=>'Another additonal facet');


//
// show admin link?
//
// default solr admin uri
$cfg['solr']['admin']['uri'] = 'http://' . $cfg['solr']['host'] . ':' . $cfg['solr']['port'] . $cfg['solr']['path'];

// if your solr admin uri is not the same like the uri of your solr server, change here
// $cfg['solr']['admin']['uri'] = 'https://sslproxy.localdomain/solr/';

// no link to admin interface
// $cfg['solr']['admin']['uri'] = false;


//
// Annotation Tool
//

// URI to the metadata wiki
//$cfg['metadata']['server'] = 'http://localhost/metawiki/index.php/Special:FormEdit/Meta/';

// URI to open semantic search tagger
$cfg['metadata']['server'] = '/search-apps/annotate/edit?uri=';

// URI to Hypothesis annotator for visual annotations
//$cfg['hypothesis']['server'] = 'https://via.hypothes.is/';

//
// Name variants recommender tool
//

// URI to aliases recommender app
$cfg['morphology'] = '/search-apps/morphology/?list=';


//
// If no query, show newest documents
//

// if set to false only search form will be shown before search query input
$cfg['newest_on_empty_query'] = true;

//
// Preview
//
// Set to false, if you have not the copyrhight to show the complete content in preview
$cfg['preview_allowed'] = true;


//
// If a public website, you should disable the following analytics views, since they need many system resources on the Solr server
//

//
// Disable view network/graph
//

// $cfg['disable_view_graph'] = true;

//
// Disable view words / word cloud
//

// $cfg['disable_view_words'] = true;

?>
