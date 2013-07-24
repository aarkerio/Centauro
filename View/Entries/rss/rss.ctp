<?php
# You should import Sanitize
App::import('Sanitize');

#################NEW version
$this->set('documentData', array('xmlns:dc' => 'http://purl.org/dc/elements/1.1/'));

$this->set('channelData', array('title'       => __('User Recent News'),
                                'link'        => $this->Html->url('/', True),
                                'description' => __('Most recent posts.'),
                                'language'    => 'en-us'));

#die(debug($entries));
foreach ($entries as $n):
    $nTime = strtotime($n['Entry']['created']);
    $nLink = "/entries/view/".$username.'/'. $n['Entry']['id'];
  
    # This is the part where we clean the body text for output as the description 
    # of the rss item, this needs to have only text to make sure the feed validates
    $bodyText = preg_replace('=\(.*?\)=is', '', $n['Entry']['body']);
    $bodyText = $this->Text->stripLinks($bodyText);
    $bodyText = Sanitize::stripAll($bodyText);
    $bodyText = $this->Text->truncate($bodyText, 400, array(
                                                        'ending' => '...',
                                                        'exact'  => True,
                                                        'html'   => True,
                                                        ));
    echo $this->Rss->item(array(), array(
                                      'title'       => $n['Entry']['title'],
                                      'link'        => $nLink,
                                      'guid'        => array('url' => $nLink, 'isPermaLink' => 'true'),
                                      'description' =>  $bodyText,
                                      'dc:creator'  => $n['Entry']['user_id'],
                                      'pubDate'     => $n['Entry']['created']
                                    )
                          );
endforeach;



/* function rss_transform($item)
{
 return array('title' => $item['Entry']['title'],
             'link' => array('controller'=>'entries', 'action' => 'view', $item['User']['username'], $item['Entry']['id']),
	         'guid' => array('controller'=> 'entries','action' => 'view', $item['User']['username'], $item['Entry']['id']),
	         'description' => strip_tags($item['Entry']['tags']),
	         'pubDate' => $item['Entry']['created']
	      );
}

$this->set('items', $rss->items($entries, 'rss_transform')); */

# ? > EOF