<?php
// Kullanıcı admin olarak giriş yapmış mı? kontrolü.
if(!$_SESSION['loggedinAdmin']) {
    header("Location: index.php?page=login");
    exit;
}

// Kullanıcının id'si iletildi mi? iletildiyse veritabanından iletilen id'ye sahip kullanıcıyı getir.
if(isset($_GET['id'])) { 
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $member_info = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<?php // Daha önce oluşturulmuş template'i kullanmak için çağırıyoruz. ?>
<?=template_admin2()?>

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
                <div class="informations">
                    <p>
                        ID: <?=$member_info['id']?><br />
                        İsim: <?=$member_info['first_name']?>
                    </p>
                </div>

                <div class="buttons">
                    <a href="index.php?page=admin4&id=<?=$member_info['id']?>"><button>Şifre Resetleme</button></a>
                    <a href="index.php?page=delete&id=<?=$member_info['id']?>"><button>Kullanıcıyı Sil</button></a>
                </div>
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

<?php // Daha önce oluşturulmuş template'i kullanmak için çağırıyoruz. ?>
<?=template_footer_admin2()?>
