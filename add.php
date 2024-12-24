<?php
// Gelen istek POST mu? diye kontrol et.
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Her bir input değerini değişkenlere ata.
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $password = $_POST["password"];
    $kumesID = $_POST["kumesID"];
    $follukID = $_POST["follukID"];

    // Değişkenleri kullanarak veritabanına kullanıcı eklemek için bir sorgu oluştur.
    $sql = "INSERT INTO users (
        first_name,
        last_name,
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
    // Sorguyu uygula.
    $pdo->exec($sql);

    // Kullanıcının eklendiğine dair bir yazının gösterileceği sayfaya yönlendirme yap.
    header('Location: index.php?page=info');

} else {
    // Eğer gelen istek POST değilse ilk baştaki admin sayfasına yönlendirme yap.
    header('Location: index.php?page=admin');
}
?>
