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

<?=template_admin4()?>

<h1>Şifre Resetle</h1>
<div class="box">
    <form action="index.php?page=reset&id=<?=$member_info['KullaniciID']?>" method="post"></br>        
        <label for="new_password">Password</label></br>
        <input type="new_password" name="new_password" id="new_password" required>

        <label for="new_password_again">New Password Again</label><br>
        <input type="new_password_again" name="new_password_again" id="new_password_again" required>

        <input type="submit" value="Değiştir">
    </form>
</div>

<?=template_footer_admin4()?>