<?php
// Admin olarak giriş yaptı mı? diye kontrol et.
if(!$_SESSION['loggedinAdmin']) { 
    // Giriş yapan admin değilse giriş ekranına yönlendir.
    header("Location: index.php?page=login");
    exit;
}

// id değeri aktarılmış mı diye kontrol et.
if(isset($_GET['id'])) {
    // Aktarılan id'ye sahip kullanıcı verilerini getirmek için SQL sorgusu.
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $member_info = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Şifre Resetleme</title>
<head>
<body>
    <div class="container">
        <div class="top">
            <div class="left">
                <img id="left" src="logo.png" alt="left">
            </div>
            
        </div>
        <div class="mid">
            <p id="mid">
                TÜBİTAK-BİDEB 2209-A
            </p>
        </div>
        <div class="bottom"> 
            <p id="bottom">
                Web Tabanlı Görüntü İşlemeye Dayalı
            </p>
            <span id="span">Folluk Takip Sistemi</span>
        </div>
        <div class="cont">
            <form action="index.php?page=reset&id=<?=$member_info['id']?>" method="POST">
                <div class="botbot">
                    <div class="botbotleft">
                        <label id="usernameText" for="new_password">Şifre</label>
                        <label id="passwordText" for="new_password_again">Şifre Tekrar</label> 
                    </div>
                    <div class="botbotright">
                        <input type="text" name="username" id="username" required>
                        <input type="password" name="password" id="password" required>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" id="button" value="Değiştir">
                </div>
            </form>
        </div>
        <div class="right">
            <img id="right" src="logouni.png" alt="right">
        </div>
        <div class="computer">
            <p id="computer">Bilgisayar Mühendisliği</p>
        </div>
    </div>
</body>
</html>
