<?php
//
// View Import Tuples
//
?>
 <div>
 Import standard documents

 </div>
<?php
     $solr = new Apache_Solr_Service(); //or explicitly new Apache_Solr_Service('localhost', 8180, '/solr')

    if ($solr->ping())
    {
        ?> <div> Ping </div> <?php
        $document = new Apache_Solr_Document();
        $document->id = uniqid(); //or something else suitably unique
        $document->title = 'Some Title';
        $document->content = 'Some content for this wonderful document. Blah blah blah.';
        $solr->addDocument($document); 	//if you're going to be adding documents in bulk using addDocuments
                                        //with an array of documents is faster
        $solr->commit(); //commit to see the deletes and the document
        $solr->optimize(); //merges multiple segments into one
    }
            ?> <div> end </div> <?php
?>
