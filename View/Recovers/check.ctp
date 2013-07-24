<?php
if ( isset($error_message) ):
        echo '<span style="color:red;padding:7px;">' . $error_message . '</span>';
endif;

if ( isset($message) ):
    echo '<span style="color:blue;padding:7px;">' . $message . '</span>';
endif;
?>