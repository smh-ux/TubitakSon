<?php

if(!$_SESSION['loggedinAdmin']) {
    header("Location: index.php?page=login");
    exit;
}

?>

<?=template_admin()?> 