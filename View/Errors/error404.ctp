<html>
<style type="text/css">

.error404{
    background:#D5DDF3 none repeat scroll 00;
    color:#000000;
    padding:5px 1px 4px;
    margin:5px 0px 5px;
    border-top:1px solid #3366CC;
}
#sd{
    font-weight:bold;
} 

</style>
<h2>404</h2>
<div class="error404">
<span id="sd">Wooops! That does not exist </span>
</div>
<p>
<?php 
if ( isset($message)):
    echo $message; 
endif;
?>
</p>
</html>
