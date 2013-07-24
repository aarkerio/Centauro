<?php
#die(debug($user));
# You should import Sanitize
#App::import('Sanitize');
$this->set('showLayoutContent', True);

$frida = array('fdgfdgf', '888', 'jkhjkhjk');
$this->set('perro',  array('fdgfdgf', '888', 'jkhjkhjk'));
$this->set('documentData', array(
                               'xmlns:pod' => 'http://sw.deri.org/2005/07/podcast#',
                               'xmlns:dc'  => 'http://purl.org/dc/elements/1.1/'));

$this->set('channelData', array(
                                'title'       => __('Most Recent Posts', True),
                                'link'        => $this->Html->url('/blog/'.$user['User']['username'], True),
                                'description' => __("Most recent posts.", True),
                                'language'    => 'en-us'));
foreach ($podcasts as $pod):
    $postLink = array('controller' => 'podcasts', 'action' => 'view', $user['User']['username'].'/'.$pod['Podcast']['id']);
    # This is the part where we clean the body text for output as the description 
    # of the rss item, this needs to have only text to make sure the feed validates
    $bodyText = str_replace('nbsp', ' ', $pod['Podcast']['description']);
    #$bodyText = preg_replace('=\(.*?\)=is', '', $bodyText);
    #$bodyText = $this->Text->stripLinks($bodyText);
    #$bodyText = Sanitize::stripAll($bodyText);
    #$bodyText = $this->Text->truncate($bodyText, 400, '...', True, True);
 
    echo $this->Rss->item(array(), array(
                                    'title'       => $pod['Podcast']['title'],
                                    'link'        => $postLink,
                                    'guid'        => array('url' => $postLink, 'isPermaLink' => True),
                                    'description' => $bodyText,
                                    'enclosure'   => array('url'=>'/files/podcasts/'.$pod['Podcast']['filename']),
                                    'creator'     => $user['User']['username'],
                                    'category'    => 'Audio',
                                    'pubDate'     => $pod['Podcast']['created']));
endforeach;

# ? > EOF