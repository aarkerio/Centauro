<?php
function rss_transform($item)
{
 
 return array('title' =>  html_entity_decode($item['Quick']['title']),
             'link' => html_entity_decode($item['Quick']['reference']),
	         'guid' =>  html_entity_decode($item['Quick']['reference']),
	         'description' => strip_tags($item['Quick']['title']),
	         'pubDate' => $item['Quick']['created']
	      );
}

$this->set('items', $rss->items($quicks, 'rss_transform'));
?>
