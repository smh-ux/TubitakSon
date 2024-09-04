<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $password = $_POST["password"];
    $kumesID = $_POST["kumesID"];
    $follukID = $_POST["follukID"];

    $sql = "INSERT INTO kullanicilar (
        Ad,
        Soyad,
        Sifre,
        KumesID,
        FollukID,
        Yetki
        )
        VALUES (
            '{$name}',
            '{$surname}',
            '{$password}',
            '{$kumesID}',
            '{$follukID}',
            'kullanıcı'
        )";

    $pdo->exec($sql);

    header('Location: index.php?page=info');

} else {
    header('Location: index.php?page=admin');
}

?>
