<?php
// Kullanıcı admin olarak giriş yapmış mı? kontrolü.
if(!$_SESSION['loggedinAdmin']) {
    header("Location: index.php?page=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin3.css">
    <title>Ekle</title>
</head>
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
            <form action="index.php?page=add" method="POST">
                <div class="botbot">
                    <div class="botbotleft">
                        <label id="usernameText" for="username">Kullanıcı Adı</label>
                        <label id="passwordText" for="password">Parola</label>
                        <label id="usernameText" for="firstName">Ad</label>
                        <label id="passwordText" for="lastName">Soyad</label>
                        <label id="usernameText" for="roleId">Rol(1 ad, 2 kul)</label>
                        <label id="passwordText" for=""></label>
                    </div>
                    <div class="botbotright">
                        <input type="text" name="username" id="username" required>
                        <input type="password" name="password" id="password" required>
                        <input type="text" name="username" id="firstname" required>
                        <input type="text" name="password" id="lastname" required>
                        <input type="number" name="username" id="roleid" min=1 max=2 step=1 required>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" id="button" value="Ekle">
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