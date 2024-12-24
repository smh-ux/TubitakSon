<?php
// Gelen istek POST mu? diye kontrol et.
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Her bir input değerini değişkenlere ata.
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password1 = $_POST["password"];

    // Değişkenleri kullanarak rolü admin olanları listele.
    $stmt = $pdo->prepare("SELECT * FROM users WHERE role_id = 1 AND username = ?");
    $stmt->execute([$username]);
    $row = $stmt->fetch();

    // Değişkenleri kullanarak rolü kullanıcı olanları listele. 
    $stmt1 = $pdo->prepare("SELECT * FROM users WHERE role_id = 2 AND username = ?");
    $stmt1->execute([$username]);
    $row1 = $stmt1->fetch();

    // Şifreyi şifrele.
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Eğer admin olarak giriş yapmaya çalışıyorsa doğrulamasını yap ve doğrulamayı geçerse admin olarak oturum başlat
    if($row && password_verify($row["password"], $hash)) {
        session_regenerate_id();
        $_SESSION['loggedinAdmin'] = TRUE;
        // Kullanıcı oturumunu durdur.
        unset($_SESSION['loggedinMember']);
        // İlk admin sayfasına yönlendir.
        header("Location: index.php?page=admin");
        exit;
    } else {
        // Eğer kullanıcı olarak giriş yapmaya çalışıyorsa doğrulamasını yap ve doğrulamayı geçerse kullanıcı olarak oturum başlat 
        if($row1 && password_verify($row1["password"], $hash)) {
            session_regenerate_id();
            $_SESSION['loggedinMember'] = TRUE;
            // Admin oturumunu durdur.
            unset($_SESSION['loggedinAdmin']);
            // Kümes seçilmesi için kümes seçim sayfasına yönlendir.
            header("Location: index.php?page=coop_choose&userid=" . $row1['id']);
            exit;
        } else {
            // Eğer giriş bilgileri hatalıysa bilgilendir.
            echo "Hatalı şifre veya kullanıcı adı...";
        }
    }
}

?>
