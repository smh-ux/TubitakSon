<?php
// id aktarılmış mı? diye kontrol et.
if (isset($_GET['id'])) {
    // Gelen istek POST mu? diye kontrol et.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // POST ile gelen değerleri değişkenlere ata.
        $new_password = $_POST["new_password"];
        $new_password_again = $_POST["new_password_again"];

        // Şifrenin değiştirilebilmesi için girilen şifre ve doğrulamasının eşleşmesini kontrol et.
        if ($new_password == $new_password_again) {
            // id'si aktarılan kullanıcı blgilerini veritabanından getiren SQL sorgusu.
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $member_info = $stmt->fetch(PDO::FETCH_ASSOC);

            // Kullanıcı mevcut mu diye kontrol et.
            if ($member_info) {
                // Girilen bilgileri kullanarak kullanıcının şifresini güncellemek için SQL sorgusu.
                $sql = "UPDATE users SET password = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$new_password, $_GET['id']]);

                header('Location: index.php?page=info1');
                exit();
            } else {
                echo "Kullanıcı bulunamadı!";
            }
        } else {
            echo "Şifreler birbiriyle uyuşmuyor";
        }
    } else {
        header('Location: index.php?page=admin');
        exit();
    }
} else {
    header('Location: index.php?page=admin');
    exit();
}
?>