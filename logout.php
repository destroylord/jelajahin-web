<?php
session_start();
session_destroy();

header("Location: http://localhost/jelajahin-web/pages-sign-in.php");
?>