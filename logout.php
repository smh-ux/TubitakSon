<?php

if(isset($_SESSION['loggedinAdmin'])) {
    unset($_SESSION['loggedinAdmin']);
}

if(isset($_SESSION['loggedinMember'])) {
    unset($_SESSION['loggedinMember']);
}

session_destroy();

header('Location: index.php');

?>