<?php
// Kullanıcı olarak giriş yapılmış mı? diye kontrol et.
if(!$_SESSION['loggedinMember']) {
    header("Location: index.php?page=login");
    exit;
}

// coopid ve userid aktarılmış mı? diye kontrol et.
if (isset($_GET['coopid']) && isset($_GET['userid'])) {
  // cooopid ve userid değerlerini değişkenlere atıyoruz.
  $coopid = $_GET['coopid'];
  $userid = $_GET['userid'];

  // aktarılan coopid'ye sahip olan follukları getirtmek için kullanılan SQL sorgusu.
  $stmt = $pdo->prepare("SELECT * FROM nests WHERE coop_id = ?");
  $stmt->execute([$coopid]);
  $nestings = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php // Daha önce oluşturulmuş template'i kullanmak için çağırıyoruz. ?>
<?=template_nesting_box_choose()?>

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
            <?php foreach($nestings as $nesting): ?>
                <a href="index.php?page=coop_choose&userid=<?=$userid?>&page=nesting_box_choose&coopid=<?=$coopid?>&page=user&nestingid=<?=$nesting['id']?>">
                    <button>Folluk: <?=$nesting['id']?></button>
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

<?php // Daha önce oluşturulmuş template'i kullanmak için çağırıyoruz. ?>
<?=template_footer_nesting_box_choose()?>