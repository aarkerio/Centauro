<?php
function rss_transform($item)
{
 return array('title'       => $item['Bookmark']['name'],
              'link'        => $item['Bookmark']['url'],
	          'url'         => $item['Bookmark']['url'],
	          'description' => strip_tags($item['Bookmark']['name']),
	          'pubDate'     => $item['Bookmark']['created']
	      );
}

$this->set('items', $this->Rss->items($bookmarks, 'rss_transform'));

#  ? > EOF
