<?php
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
   Router::connect('/', array('controller' => 'news', 'action' => 'display'));

   Router::connect('/blog/*', array('controller' => 'entries', 'action' => 'display'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
  #  Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));


  # RSS stuff
  Router::parseExtensions('rss', 'xml');

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
  #CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
  require CAKE . 'Config' . DS . 'routes.php';

# ? > EOF
