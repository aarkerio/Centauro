<?php
/** GPLv3 Manuel Montoya 2002-2007 */
class AppController extends Controller {
    
    // necessary, we need to have the othauth component so it can do it's business logic 
    //public $components  = array('othAuth'); // http://www.devmoz.com/blog/
    
    // html is always needed, othauth helper is not a must, but you can do some cool things with it (see later on)
    //public $helpers = array('Html', 'othAuth', 'Gags');
    
    // tags authorized to inputfilter
    //public $tags = array("font", "em", "strong", "div", "img", "ul", "li", "ol", "p", "br", "hr", "a", "i", "b", "object", "param", "embed", "span", "sup", "sub", "h1", "h2", "h3", "h4", "table", "tr", "td"); 
    
    // attributes authorized to inputfilter
    //public $attr = array("color", "face", "width", "src", "height", "alt", "title", "href", "value", "type", "name", "align", "?", "=", "class", "style"); 
    
    // these are the global restrictions, they are very important. 
    //all the permissions defined above are weighted against these restrictions to calculate the total allow or deny for a specific request.
    //public $othAuthRestrictions = array('admin_add','admin_edit','admin_delete', 'admin_listing', 'admin_start');
    
/*    public function beforeFilter() 
    {
       
       $auth_conf = array(
                    'mode'  => 'oth',
                    'login_page'  => '/users/login',
                    'logout_page' => '/users/logout',
                    'access_page' => '/news/view',
                    'hashkey'     => 'mYpERsOn78787ALhaSHkeY',
                    'noaccess_page' => '/users/noaccess',
                    'strict_gid_check' => true);
        
        $this->othAuth->controller = &$this; // controlleret
        $this->othAuth->init($auth_conf);
        $this->othAuth->check();
        
    }
*/    
    public function msgFlash($msg, $to)
    {
        $this->Session->setFlash($msg); // http://manual.cakephp.org/chapter/session
        
        $this->redirect($to);
        
        exit;
    }
}
?>
