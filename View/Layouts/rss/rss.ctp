<?php
# Chipotle Software (c) 2006-2010 
# http://book.cakephp.org/view/1461/Creating-an-RSS-feed-with-the-RssHelper
if ( !isset($perro) ):
    die('Perro is not set');
endif;

echo $this->Rss->header();

if ( !isset($documentData) ):
    $documentData = array();
endif;

if ( !isset($channelData) ):
    $channelData = array();
    die('dsfdsfdsf');
endif;

if (!isset($channelData['title'])):
    $channelData['title'] = $title_for_layout;
endif;

$channel = $this->Rss->channel(array(), $channelData, $content_for_layout);

echo $this->Rss->document($documentData,$channel);

# ? > EOF