<?php
// Kullanıcı olarak giriş yapılmış mı? diye kontrol et.
if(!$_SESSION['loggedinMember']) {
     header("Location: index.php?page=login");
     exit;
}

// userid iletilmiş mi diye kontrol et.
if (isset($_GET['userid'])) {
  $userid = $_GET['userid'];

  // userid'si iletilmiş olan kullanıcının sahip olduğu kümesleri getirtmek için SQL sorgusu.
  $stmt = $pdo->prepare("SELECT * FROM coops WHERE user_id = ?");
  $stmt->execute([$userid]);
  $coops = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php // Daha önce oluşturulmuş template'i kullanmak için çağırıyoruz. ?>
<?=template_coop_choose()?>

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
                <?php foreach($coops as $coop): ?>
                    <a href="index.php?page=coop_choose&userid=<?=$userid?>&page=nesting_box_choose&coopid=<?=$coop['id']?>">
                        <button>Kümes: <?=$coop['id']?></button>
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