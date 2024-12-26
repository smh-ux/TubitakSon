<?php
// anlik_foto_istegi tablosundaki istek değerini 1 olarak güncelleyerek raspberry pi a yeni veriler göndermesi gerektiğini bildirir.
$sql = $pdo->prepare("UPDATE anlik_foto_istegi SET istek = 1");
$sql->execute();
header("Location: index.php?page");

// header'dan id leri al ki geri dönebilesin.

?>