<?php
function rss_transform($item)
{
 return array(
      'title'          => $item['Podcast']['title'],
      'guid'           => '/files/podcasts/'. $item['Podcast']['filename'],
      'enclosure'      => array('url'=>'/files/podcasts/'. $item['Podcast']['filename'], 'length'=> $item['Podcast']['length']),
      'description'    => Sanitize::stripAll($item['Podcast']['description']),
      'pubDate'        => $item['Podcast']['created'],
      'itunes:author'  => 'Karamelo',
      'itunes:summary' => strip_tags($item['Podcast']['description'])   
     );
} 
$this->Rss->addNs('dc');
$this->set('items', $this->Rss->items($podcasts, 'rss_transform'));
# ? > EOF