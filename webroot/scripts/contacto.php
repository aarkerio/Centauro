<?php
  /*
  CREATE TABLE contactos (
  id serial,
  nombre varchar(60),
  empresa varchar(120),
  tecnologia varchar(60),
  email varchar(30),
  phone varchar(30),
  comentario text,
  fecha date
  );
  */
  require_once 'DB.php'; 

// Path where centauro is installed
define('CENTA_PATH', substr(dirname(__FILE__),0,-3));

$db = array (); //DONT RENAME/DELETE THIS VARIABLE!!
/**
 * DB Configuration 
 *
 * In this section you configure some params of your DB connection, such as 
 * username, password, name, host and driver.
 */
/**
 * DB username
 */
$db["user"] = "postgres";

/**
 * DB Password
 */
$db["password"] = "8989chttt05";

/**
 * DB Name
 */
$db["name"] = "PROJECTS";

/**
 * DB Server host
 */
$db["host"] = "localhost";

/**
 * DB Driver.
 *
 * Currently we just support the following DB Drivers: MySQL
 */
$db["driver"] = "pgsql";

/**
 * DB Prefix
 *
 * Optional, just make sure it has an empty value
 */
$db["prefix"] = "centa_";

/**
 * Logs 
 *
 * If you want to enable logging Jaws, maybe to track the errors, or to debug a good
 * idea is to configure/enable it.
 */
/**
 * Debug: true/false
 *
 * Warning: This will turn on the Debugger and will show all the error and warning messages in your
 * website, so any user that visits your site will see information that they shouldn't see
 */
define ("DEBUG_ACTIVATED", false);

/**
 * Log Method
 *
 * How do you want to print/save the log?. Currently we just support: 
 *
 *    LogToStack: Saves the log in an array, every ttime you reload the site, its created once again (DEFAULT).
 *
 *    LogToFile: Logs the message to a specified file.
 *     Options:
 *      file: File where you want to save data, IMPORTANT. Apache needs write-access to that file
 *     Example:
 *        $GLOBALS["method"] = "LogToFile";
 *        $GLOBALS["method"]["options"] = "/tmp/jaws_log.log";
 *
 *
 *    LogToSyslog: Logs the message to the syslog, you can find the log of this blog just by looking to the tag you 
 *    define
 *      Options:
 *       indent: String ident is added to each message.
 *      Example:
 *        $GLOBALS["method"] = "LogToSyslog";
 *        $GLOBALS["method"]["options"] = "JawsLog";
 *
 *    LogToScreen: All log messages are printed to screen
 *       Example:
 *        $GLOBALS["method"] = "LogToScreen";
 *
 *    LogToApache": Prints the message to the apache error log file
 *       Example:
 *         $GLOBALS["method"] = "LogToApache";
 */
$GLOBALS["method"] = "LogToScreen";

$dsn = $db["driver"] . "://". $db["user"] . ":" . $db["password"] . "@" . $db["host"] . "/" . $db["name"];

//echo $dsn;
$conn = DB::connect($dsn, true); 

// With DB::isError you can differentiate between an error or
// a valid connection.
if (DB::isError($conn)) 
        die ($conn->getMessage());
  
  
  $nombre     = $_POST['nombre'];
  
  $empresa    = $_POST['empresa'];
  
  $email      = $_POST['email'];
  
  $phone      = $_POST['phone'];
  
  $tecnologia = $_POST['tecnologia'];
  
  $comentario = $_POST['comentario'];
  
  $sql="INSERT INTO contactos (nombre, empresa, tecnologia, email, phone, comentario, fecha) VALUES ('$nombre', '$empresa', '$tecnologia', '$email', '$phone', '$comentario',  CURRENT_DATE)";
  
  
  //echo $sql . "<br />"; exit;
  
  $conn->query($sql);
  
  mail("manuel@mononeurona.org", "Contacto Profesional", "Pedido por:  $nombre");
  
     echo "
     <SCRIPT language='JavaScript'>
     <!--
           alert('Gracias, en poco tiempo te contactaremos');
          
          document.location.href = '../index.php?idp=555';
  	-->
     </script>
   ";


// Cierro la conexión con Postgresql
$conn->disconnect();
?>
