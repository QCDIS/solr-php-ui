<?php
//
// View Import Tuples
//
?>
 <div>
 Import standard documents

 </div>
<?php



function addNewDocumentToSolr(
$BaseURL,
$LatestPageTitle,
$PageTitle,
$ParentPageTitle,
$SiteTitle,
$SpaceKey,
$SpaceKeyName,
$TitleTxt,
$Wikilink,
$FileExtension,
$path0,
$path1,
$path2,
$Path_basename,
$MainText,
$Email,
$EmailDomain,
$Phone

) {

    $solr = new Apache_Solr_Service($cfg['solr']['host'], $cfg['solr']['port'], $cfg['solr']['path'].'/'.$cfg['solr']['core']);

    if ($solr->ping()){
        ?> <div> Ping </div> <?php
        $document = new Apache_Solr_Document();

        $document->file_modified_dt="2020-08-23T23:10:37Z";
        $document->etl_error_plugins_ss=["export_neo4j"];
        $document->etl_error_txt=["Connection refused"];
        $document->etl_filter_blacklist_time_millis_i=0;
        $document->etl_filter_blacklist_b=true;
        $document->etl_enhance_extract_text_tika_server_ocr_enabled_b=true;
        $document->Content-Encoding_ss=["UTF-8"];
        $document->Content-Language_ss=["en-GB"];
        $document->content_type_ss=["text/html; charset=UTF-8"];
        $document->X-Parsed-By_ss=["org.apache.tika.parser.DefaultParser";
        $document->X-UA-Compatible_ss=["IE=EDGE,chrome=IE7"];
        $document->ajs-access-mode_ss=["READ_WRITE"];
        $document->ajs-atl-token_ss=["acfee9c855261506b77e853c42c5b479029b605b"];
        $document->ajs-base-url_ss=$BaseURL;
        $document->ajs-browse-page-tree-mode_ss=["view"];
        $document->ajs-build-number_ss=["8501"];
        $document->ajs-can-remove-page_ss=["false"];
        $document->ajs-can-remove-page-hierarchy_ss=["false"];
        $document->ajs-confluence-flavour_ss=["VANILLA"];
        $document->ajs-connection-timeout_ss=["10000"];
        $document->ajs-content-type_ss=["page"];
        $document->ajs-context-path_ss=[""];
        $document->ajs-create-issue-metadata-show-discovery_ss=["false"];
        $document->ajs-current-user-avatar-uri-reference_ss=["/images/icons/profilepics/anonymous.svg"];
        $document->ajs-current-user-avatar-url_ss=[""];
        $document->ajs-current-user-fullname_ss=[""];
        $document->ajs-date.format_ss=["yyyy MMM dd"];
        $document->ajs-discovered-plugin-features_ss=["$discoveredList"];
        $document->ajs-enabled-dark-features_ss=["site-wide.shared-drafts,site-wide.synchrony,clc.quick.create,confluence.view.edit.transition,cql.search.screen,confluence-inline-comments-resolved,frontend.editor.v4,http.session.registrar,nps.survey.inline.dialog,confluence.efi.onboarding.new.templates,frontend.editor.v4.compatibility,atlassian.cdn.static.assets,pdf-preview,previews.sharing,previews.versions,file-annotations,confluence.efi.onboarding.rich.space.content,collaborative-audit-log,previews.conversion-service,editor.ajax.save,read.only.mode,graphql,previews.trigger-all-file-types,attachment.extracted.text.extractor,lucene.caching.filter,confluence.table.resizable,notification.batch,previews.sharing.pushstate,confluence-inline-comments-rich-editor,site-wide.synchrony.opt-in,file-annotations.likes,gatekeeper-ui-v2,v2.content.name.searcher,mobile.supported.version,pulp,confluence-inline-comments,confluence-inline-comments-dangling-comment,quick-reload-inline-comments-flags"];
        $document->ajs-from-page-title_ss=[""];
        $document->ajs-global-settings-attachment-max-size_ss=["104857600"];
        $document->ajs-global-settings-quick-search-enabled_ss=["true"];
        $document->ajs-is-confluence-admin_ss=["false"];
        $document->ajs-jira-metadata-count_ss=["0"];
        $document->ajs-keyboardshortcut-hash_ss=["fd8be8ca3737604dd15b20afeef6c267"];
        $document->ajs-latest-page-id_ss=["23234478"];
        $document->ajs-latest-published-page-title_ss=$LatestPageTitle;
        $document->ajs-macro-placeholder-timeout_ss=["5000"];
        $document->ajs-max-number-editors_ss=["12"];
        $document->ajs-page-id_ss=["23234478"];
        $document->ajs-page-title_ss=$PageTitle;
        $document->ajs-page-version_ss=["7"];
        $document->ajs-parent-page-id_ss=["42303641"];
        $document->ajs-parent-page-title_ss=$ParentPageTitle;
        $document->ajs-remote-user_ss=[""];
        $document->ajs-remote-user-has-browse-users-permission_ss=["false"];
        $document->ajs-remote-user-has-licensed-access_ss=["false"];
        $document->ajs-remote-user-key_ss=[""];
        $document->ajs-render-mode_ss=["READ_WRITE"];
        $document->ajs-shared-drafts_ss=["true"];
        $document->ajs-site-title_ss=$SiteTitle;
        $document->ajs-space-key_ss=$SpaceKey;
        $document->ajs-space-name_ss=$SpaceKeyName;
        $document->ajs-static-resource-url-prefix_ss=["/s/-sjzpff/8501/824f149d70ae2ad1d29a82a2fd43b16cca383892/_"];
        $document->ajs-use-keyboard-shortcuts_ss=["true"];
        $document->ajs-user-date-pattern_ss=["dd MMM yyyy"];
        $document->ajs-user-locale_ss=["en_GB"];
        $document->ajs-version-number_ss=["7.6.2"];
        $document->atlassian-token_ss=["acfee9c855261506b77e853c42c5b479029b605b"];
        $document->page-version_ss=["7"];
        $document->resourceName_ss=["b'tmpnxqi717y'"];
        $document->title_txt=$TitleTxt;
        $document->wikilink_ss=$Wikilink;
        $document->etl_count_images_yet_no_ocr_i=0;
        $document->etl_enhance_ocr_descew_b=true;
        $document->etl_enhance_pdf_ocr_b=true;
        $document->etl_enhance_extract_text_tika_server_time_millis_i=13;
        $document->etl_enhance_extract_text_tika_server_b=true;
        $document->language_s="en";
        $document->etl_enhance_detect_language_tika_server_time_millis_i=5;
        $document->etl_enhance_detect_language_tika_server_b=true;
        $document->content_type_group_ss=["Text document"];
        $document->etl_enhance_contenttype_group_time_millis_i=0;
        $document->etl_enhance_contenttype_group_b=true;
        $document->etl_enhance_pst_time_millis_i=0;
        $document->etl_enhance_pst_b=true;
        $document->etl_enhance_csv_time_millis_i=0;
        $document->etl_enhance_csv_b=true;
        $document->filename_extension_s=$FileExtension;
        $document->path0_s=$path0;
        $document->path1_s=$path1;
        $document->path2_s=$path2;
        $document->path_basename_s=$Path_basename;
        $document->etl_enhance_path_time_millis_i=0;
        $document->etl_enhance_path_b=true;
        $document->etl_enhance_zip_time_millis_i=0;
        $document->etl_enhance_zip_b=true;
        $document->etl_enhance_warc_time_millis_i=0;
        $document->etl_enhance_warc_b=true;
        $document->etl_enhance_extract_hashtags_time_millis_i=1;
        $document->etl_enhance_extract_hashtags_b=true;
        $document->etl_clean_title_time_millis_i=0;
        $document->etl_clean_title_b=true;
        $document->etl_enhance_rdf_annotations_by_http_request_time_millis_i=3;
        $document->etl_enhance_rdf_annotations_by_http_request_b=true;
        $document->_text_=$MainText;
        $document->text_txt_en=$MainText;
        $document->etl_enhance_multilingual_time_millis_i=2;
        $document->etl_enhance_multilingual_b=true;
        $document->etl_enhance_rdf_time_millis_i=0;
        $document->etl_enhance_rdf_b=true;
        $document->etl_enhance_regex_time_millis_i=4;
        $document->etl_enhance_regex_b=true;
        $document->email_ss=$Email;
        $document->email_domain_ss=$EmailDomain;
        $document->etl_enhance_extract_email_time_millis_i=6;
        $document->etl_enhance_extract_email_b=true;
        $document->phone_ss=$Phone;
        $document->phone_normalized_ss=$Phone;
        $document->etl_enhance_extract_phone_time_millis_i=3;
        $document->etl_enhance_extract_phone_b=true;
        $document->ontology_3_ss=["#    Annotations"];
        $document->ontology_3_ss_uri_ss=["#    Annotations"];
        $document->ontology_3_ss_preflabel_and_uri_ss=["#    Annotations <#    Annotations>"];
        $document->ontology_3_ss_matchtext_ss=["#    Annotations\tannotations"];
        $document->etl_enhance_entity_linking_time_millis_i=31;
        $document->etl_enhance_entity_linking_b=true;
        $document->person_ss=["Tiziana Ferrari";
        $document->organization_ss=["Executive Board";
        $document->work_of_art_ss=["EGI Confluence\n\t\n            \n        \n        \n\n            Spaces"];
        $document->date_ss=["today";
        $document->law_ss=["EOSC";
        $document->product_ss=["EOSC";
        $document->location_ss=["JAM3.2";
        $document->etl_enhance_ner_spacy_time_millis_i=185;
        $document->etl_enhance_ner_spacy_b=true;
        $document->etl_enhance_extract_law_time_millis_i=6;
        $document->etl_enhance_extract_law_b=true;
        $document->etl_error_export_neo4j_txt=["Connection refused"];
        $document->etl_export_neo4j_time_millis_i=1;
        $document->etl_export_neo4j_b=true;
        $document->etl_time_millis_i=271;
        $document->id="https://confluence.egi.eu/display/EoscHubOpenAIRE/JA3+Governance+and+Strategy";
        $document->X-TIKA_content_handler_ss=["ToTextContentHandler"];
        $document->X-TIKA_embedded_depth_ss=["0"];
        $document->X-TIKA_parse_time_millis_ss=["5"];
        $document->dc_title_ss=$TitleTxt;
        $document->content_txt=$MainText;
        $document->_version_=1675859578075480064;

       $solr->addDocument($document);
        $solr->commit();
    }
}
     ?> <div> End </div> <?php
?>