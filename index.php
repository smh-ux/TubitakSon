<?php

// Oturum başlatılıyor.
session_start();

// Veritabanı bağlantısı içe aktarılıyor.
include 'functions.php';
$pdo = pdo_connect_mysql();

// home.php diğer sayfaları home.php içine yerleştirip home.php yi de index.php gibi gösterebilmek için.
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
include $page . '.php';

?>
