<?php

if(!$_SESSION['loggedinMember']) {
     header("Location: index.php?page=login");
     exit;
}

if (isset($_GET['coopid']) && isset($_GET['userid'])) {
  $coopid = $_GET['coopid'];
  $userid = $_GET['userid'];

  $stmt = $pdo->prepare("SELECT kumesler.Konum, kumesler.kumesID, veriler.Adet, veriler.FollukID FROM kumesler JOIN veriler ON kumesler.FollukID = veriler.FollukID WHERE kumesler.FollukID = ?");
  $stmt->execute([$coopid]);
  $nestings = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<?=template_nesting_box_choose()?>

<h1>Folluk Seçiniz</h1>
<div class="panel">
    <div class="buttons">
        <?php foreach($nestings as $nesting): ?>
            <a href="index.php?page=coop_choose&userid=<?=$userid?>&page=nesting_box_choose&coopid=<?=$coopid?>&page=user&nestingid=<?=$nesting['FollukID']?>">
                <button>Folluk: <?=$nesting['FollukID']?></button>
            </a>
        <?php endforeach;?>
        <div class="empty"></div>
    </div>
</div>

<?=template_footer_nesting_box_choose()?>
