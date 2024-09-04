<?php

if(!$_SESSION['loggedinMember']) {
     header("Location: index.php?page=login");
     exit;
}

if (isset($_GET['userid'])) {
  $userid = $_GET['userid'];

  $stmt = $pdo->prepare("SELECT kullanicilar.Ad, kumesler.kumesID, kumesler.Konum FROM kullanicilar JOIN kumesler ON kullanicilar.KumesID = kumesler.kumesID WHERE kullanicilar.KullaniciID = ?");
  $stmt->execute([$userid]);
  $coops = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//header("Location: index.php?page=coop_choose&coopid=1&page=nesting_box_choose");

// SELECT kullanicilar.Ad, kumesler.Konum FROM kullanicilar JOIN kumesler ON kullanicilar.KumesID = kumesler.kumesID;
// SELECT kumesler.Konum, veriler.Adet FROM kumesler JOIN veriler ON kumesler.FollukID = veriler.FollukID;
// SELECT veriler.Adet, yumurtalar.Renk FROM veriler JOIN yumurtalar ON veriler.YumurtaID = yumurtalar.YumurtaID;

?>


<?=template_coop_choose()?>

<h1>Kümes Seçiniz</h1>
<div class="panel">
    <div class="buttons">
        <?php foreach($coops as $coop): ?>
            <a href="index.php?page=coop_choose&userid=<?=$userid?>&page=nesting_box_choose&coopid=<?=$coop['kumesID']?>">
                <button>Kümes: <?=$coop['kumesID']?></button>
            </a>
        <?php endforeach;?>
        <div class="empty"></div>
    </div>
</div>

<?=template_footer_coop_choose()?>
