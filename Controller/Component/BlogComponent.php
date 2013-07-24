<?php 
/**
 * Blog component Chipotle Software (c) 2006-2012
 * @version 0.4
 * @license GPLv3
 */

App::import('Model','User');
App::import('Model','Style');

class BlogComponent extends Component {

/**
 * Load User Model
 * @access public
 * @var    string
 */
 private $_User    = Null;

/**
 * Load User Model
 * @access public
 * @var    string
 */
 private $_Style    = Null;

/**
 * User Id
 * @acces public
 * @ var integer
*/ 
public $userId = null;


/**
 * Component Constructor
 * @access public
 * @return void
 */ 
 public function __construct(ComponentCollection $collection, $settings = array()) 
 {
    $this->Controller = $collection->getController();
    parent::__construct($collection, $settings);
 }

/**
 * This method takes a reference to the controller which is loading it.
 * Perform controller initialization here.
 * @access public
 * @return void
 */
  public function initialize(Controller $controller) 
  {
     $this->_User = new User;
  }

 
 public function setUserId($username)
 {
  $this->userId = (int) $this->_User->field('User.id', array('User.username'=>$username)); 
  $this->setStyle();
  $this->bloggerStuff();
 }
 
 public function getUserId()
 {
   return $this->userId; 
 }
 
 public function setStyle() 
 {
   $this->_Style = new Style;
        
   $style = $this->_Style->field('style', array('user_id' => $this->userId));
        
   if ($style == Null):
       $style = $this->_Style->field('style', array('id' => 1));
   endif;
        
   $this->Controller->set('style', $style); 
 }

/**
 *  Tag cloud in every blog
 *
 * @access public
 * @void array 
 */
 public function tagCloud() 
 {
   return $this->requestAction('/entries/tags/'.$this->userId);
 }

 # The user layout
 public function bloggerStuff() 
 {
 
 # Unbind on fly
 #$this->User->contain();

 # Temporal bind
 $this->_User->bindModel(
                 array('hasMany' =>array(
                      'Podcast' =>
                          array('className'     => 'Podcast',
                                'conditions'    => array('Podcast.status' => 1, 'Podcast.user_id' => $this->userId),
                                'order'         => 'Podcast.created DESC',
                                'limit'         => 10,
                                'foreignKey'    => 'user_id',
                                'dependent'     => True,
                                'exclusive'     => False
                               ),
                        'Bookmark' =>
                           array('className'     => 'Bookmark',
                                 'conditions'    => array('Bookmark.user_id' => $this->userId),
                                 'order'         => 'Bookmark.name DESC',
                                 'limit'         => 10,
                                 'foreignKey'    => 'user_id',
                                 'dependent'     => True,
                                 'exclusive'     => False
                                 ),
                         'Wayding' =>
                           array('className'     => 'Wayding',
                                 'conditions'    => array('Wayding.user_id' => $this->userId),
                                 'order'         => 'Wayding.created DESC',
                                 'limit'         => 10,
                                 'foreignKey'    => 'user_id',
                                 'dependent'     => True,
                                 'exclusive'     => False
                                 ),
                         'Livechat' =>
                           array('className'     => 'Livechat',
                                 'conditions'    => array('Livechat.user_id' => $this->userId),
                                 'order'         => 'Livechat.created DESC',
                                 'limit'         => 10,
                                 'foreignKey'    => 'user_id',
                                 'dependent'     => True,
                                 'exclusive'     => False
                                 ),
                        'Catforum' =>
                           array('className'     => 'Catforum',
                                 'conditions'    => array('Catforum.user_id' => $this->userId),
                                 'order'         => 'Catforum.created DESC',
                                 'limit'         => 10,
                                 'foreignKey'    => 'user_id',
                                 'dependent'     => True,
                                 'exclusive'     => False
                                 ),
                         'Quote' =>
                           array('className'     => 'Quote',
                                 'conditions'    => array('Quote.user_id' => $this->userId),
                                 'order'         => 'RANDOM()',
                                 'limit'         => 1,
                                 'foreignKey'    => 'user_id',
                                 'dependent'     => True,
                                 'exclusive'     => False
                                 )
                            )
                       )
                       ); 
  
 $params = array(
   'conditions' => array('User.id'=>$this->userId),
   'fields'     => array('User.id', 'User.created', 'User.name_blog', 'User.quote', 'User.cv', 'User.avatar', 'User.username',
                         'User.license_id', 'User.tags'),
   'contain'   =>array('Quote', 'Livechat', 'Podcast', 'Bookmark', 'Catforum', 'Wayding')
);

  $this->Controller->set('blogger', $this->_User->find('first', $params));
 }

}
# ? > EOF
