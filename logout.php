<?php

include("config.php");
session_start();

//destroy created session and redirect to login page

$_SESSION['login_user']=NULL;
header("Location: /index.html");

?>
<script>
if(top != window) {
  top.location = window.location
}

</script>
