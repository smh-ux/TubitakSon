<?php
// Gelen istek POST mu? diye kontrol et.
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Her bir input değerini değişkenlere ata.
    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $roleid = $_POST["roleid"];

    // Değişkenleri kullanarak veritabanına kullanıcı eklemek için bir sorgu oluştur.
    $sql = "INSERT INTO users (
        username,
        first_name,
        last_name,
        password,
        role_id,
        ) VALUES (
            '{$username}',
            '{$firstname}',
            '{$lastname}',
            '{$password}',
            '{$roleid}'
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
