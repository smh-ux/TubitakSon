<?php

if(!$_SESSION['loggedinAdmin']) {
    header("Location: index.php?page=login");
    exit;
}

if(isset($_GET['id'])) { 
    $stmt = $pdo->prepare("SELECT * FROM kullanicilar WHERE KullaniciID = ?");
    $stmt->execute([$_GET['id']]);
    $member_info = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<?=template_admin2()?>

<header>
    <h1><?=$member_info['Ad']?></h1>
</header>

<div class="panel">
    <div class="informations">
        <p>
            ID: <?=$member_info['KullaniciID']?><br />
            İsim: <?=$member_info['Ad']?>
        </p>
    </div>

    <div class="buttons">
        <a href="index.php?page=admin4&id=<?=$member_info['KullaniciID']?>"><button>Şifre Resetleme</button></a>
        <a href="index.php?page=user1&id=<?=$member_info['KullaniciID']?>"><button>Kullanıcı Web Sayfası</button></a>
        <a href="index.php?page=delete&id=<?=$member_info['KullaniciID']?>"><button>Kullanıcıyı Sil</button></a>
    </div>
</div>

<?=template_footer_admin2()?>
