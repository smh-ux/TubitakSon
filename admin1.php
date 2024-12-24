<?php
// Kullanıcı admin olarak giriş yapmış mı? kontrolü.
if(!$_SESSION['loggedinAdmin']) {
     header("Location: index.php?page=login");
     exit;
}

// Veritabanından rolü kullanıcı olanları listelemesi için sorgu.
$stmt = $pdo->prepare("SELECT * FROM users WHERE role_id = 2");
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php // Daha önce oluşturulmuş template'i kullanmak için çağırıyoruz. ?>
<?=template_admin1()?>

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
                <a href="index.php?page=admin3">
                    <button>Kullanıcı Ekle</button>
                </a>

                <?php foreach($members as $member): ?>
                    <a href="index.php?page=admin2&id=<?=$member['id']?>">
                        <button><?=$member['first_name']?></button>
                    </a>
                <?php endforeach;?>
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
