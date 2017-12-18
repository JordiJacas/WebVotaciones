<?php   
session_start();
session_destroy();
header("Location: http://jjacas.tk/~app/WebVotaciones/");
exit();
?>