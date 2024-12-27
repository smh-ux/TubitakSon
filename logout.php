<?php
// Eğer admin olarak oturum açılmışsa admin oturumunu sonlandır.
if(isset($_SESSION['loggedinAdmin'])) {
    unset($_SESSION['loggedinAdmin']);
}

// Eğer kullanıcı olarak giriş yapılmışsa kullanıcı oturumunu sonlandır.
if(isset($_SESSION['loggedinMember'])) {
    unset($_SESSION['loggedinMember']);
}

// Oturumu sonlandır.
session_destroy();

// Ana sayfaya yönlendir.
header('Location: index.php');
?>