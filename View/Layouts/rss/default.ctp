<?php
# Chipotle Software(c) 2006-2013
# http://book.cakephp.org/2.0/en/core-libraries/helpers/rss.html
# die(debug($content_for_layout));

if ( !isset($documentData) ):
    $documentData = array();
endif;

if ( !isset($channelData) ):
    $channelData = array();
endif;

if (!isset($channelData['title'])):
    $channelData['title'] = $title_for_layout;
endif;

$channel = $this->Rss->channel(array(), $channelData, $content_for_layout);

echo $this->Rss->document($documentData,$channel);

# ? > EOF