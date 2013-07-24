<?php
/**
 *  AGPLv3 Chipotle Software (c) 2009-2012
 *  Mailer CakePHP component
 *  This component unified all emails wich are sent in Karamelo
 * @license GNU Affero General Public License V3
 */

App::uses('CakeEmail', 'Network/Email');

class MailerComponent extends Component {

/**
 *  Email
 *  @access public
 *  @var string
 */
 public $Email = Null;

/**
 *  Email
 *  @access public
 *  @var string
 */
 public  $replyTo  = 'contact@chipotle-software.com';

/**
 *  Email
 *  @access public
 *  @var string
 */
 public  $from     = 'Chipotle-software.com';

/**
 *  Layout:   APP/View/Layout/Emails/html/default.ctp
 *  @access public
 *  @var string
 */
 public $layout = 'default';

/**
 *  Email view:   APP/View/Emails/html/welcome.ctp
 *  @access public
 *  @var string
 */
 public $view = 'default';

/**
 *  Attribute sendAs, text or html
 *  @access public
 *  @var string
 */
 public $sendAs = 'text';

/**
 * Component Constructor
 * @return void
 */ 
 public function __construct(ComponentCollection $collection, $settings = array()) 
 {
     $this->Controller = $collection->getController();
     parent::__construct($collection, $settings);
 }

/**
 *  The initialize method is called before the controller’s beforeFilter method.
 *  @access public
 *  @return boolean
 */
 public function initialize(Controller $controller) 
 {
   $this->Email = new CakeEmail();
 }


/**
 *  Set data in email template
 *  @param string $data  subject and message
 *  @access public
 *  @return void
 */
 public function set($name, $value)
 {
   $this->Email->viewVars(array($name => $value));
 }

/**
 *  Send email to several users
 *  @param array $data  subject and message
 *  @param array $users data
 *  @access public
 *  @return void
 */
 public function sendMany($data, $users)
 {
   $this->subject = $data['subject'];
   foreach( $users as $u):
       $this->send($u['UserVclassroom']['email']);
   endforeach;
 }

/**
 *  Send email
 *  @param array $data
 *  @access public
 *  @return boolean
 */
 public function send($email)
 {
   $this->Email->template($this->view, $this->layout);
   $this->Email->emailFormat($this->sendAs);  # text or html 
   $this->Email->from(array($this->replyTo => $this->from));
   $this->Email->to($email);
   $this->Email->subject($this->subject);
   if ( $this->Email->send() ):
       return True;
   else:
       return False; 
   endif;
 }
}

# ? > EOF
