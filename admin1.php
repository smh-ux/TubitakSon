<?php

if(!$_SESSION['loggedinAdmin']) {
     header("Location: index.php?page=login");
     exit;
}

$current_page = isset($_GET['member']) && is_numeric($_GET['member']) ? $_GET['member'] :

$stmt = $pdo->prepare("SELECT * FROM kullanicilar WHERE yetki = 'kullanıcı'");
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?=template_admin1()?>

<div class="panel">
    <div class="buttons">
        <a href="index.php?page=admin3">
            <button>Kullanıcı Ekle</button>
        </a>

        <?php foreach($members as $member): ?>
            <a href="index.php?page=admin2&id=<?=$member['KullaniciID']?>">
                <button><?=$member['Ad']?></button>
            </a>
        <?php endforeach;?>
        <div class="empty"></div>
    </div>
</div>

<?=template_footer_admin1()?>
