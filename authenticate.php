<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password1 = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM kullanicilar WHERE yetki = 'admin' AND Ad = ?");
    $stmt->execute([$username]);
    $row = $stmt->fetch();

    $stmt1 = $pdo->prepare("SELECT * FROM kullanicilar WHERE yetki = 'kullanıcı' AND Ad = ?");
    $stmt1->execute([$username]);
    $row1 = $stmt1->fetch();

    $hash = password_hash($password, PASSWORD_DEFAULT);

    if($row && password_verify($row["Sifre"], $hash)) {
        session_regenerate_id();
        $_SESSION['loggedinAdmin'] = TRUE;
        unset($_SESSION['loggedinMember']);
        header("Location: index.php?page=admin");
        exit;
    } else {
        if($row1 && password_verify($row1["Sifre"], $hash)) {
            session_regenerate_id();
            $_SESSION['loggedinMember'] = TRUE;
            unset($_SESSION['loggedinAdmin']);
            header("Location: index.php?page=coop_choose&userid=" . $row1['KullaniciID']);
            exit;
        } else {
            echo "Hatalı şifre veya kullanıcı adı...";
        }
    }
}

?>
