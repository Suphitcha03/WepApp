<?php
require_once "layout/session.php";

?>

<?php
session_destroy();
header("LOcation:loginForm.php");

?>