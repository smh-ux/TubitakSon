<?php

if (isset($_GET['id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_password = $_POST["new_password"];
        $new_password_again = $_POST["new_password_again"];

        // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        if ($new_password == $new_password_again) {
            $stmt = $pdo->prepare("SELECT * FROM kullanicilar WHERE KullaniciID = ?");
            $stmt->execute([$_GET['id']]);
            $member_info = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($member_info) {
                $sql = "UPDATE kullanicilar SET Sifre = ? WHERE KullaniciID = ?";
                $stmt = $pdo->prepare($sql);
                // $stmt->execute([$hashed_password, $_GET['id']]);
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