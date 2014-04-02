<?php 
require("build/wp-heredoc.php");
require("../inc/um/um-css.php");
header("content-type: text/css; charset: UTF-8");
$css = '@charset "UTF-8"'."\n"; 
$css .= "/**\n * um - reset.css\n * Rev. ".date('Ymd.H')."\n *\n */\n";
$css .= css_include("build/necolas-normalize.css",1);
$css .= css_include("build/um-reset-ui.css",1);
$css .= css_include("build/wp-reset.css",1);
$css .= "/* wp-heredoc */\n";
$css .= css_compress( heredocs(),1)."\n";
file_put_contents("um-reset.css",css_compress($css,0)); 
echo $css;
exit;

?>