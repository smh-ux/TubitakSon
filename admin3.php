<?php



?>

<?=template_admin3()?>

<h1>Kullanıcı Ekle</h1>
<div class="box">
    <form action="index.php?page=add" method="post"></br>
        <label for="name">Ad</label></br>
        <input type="text" name="name" id="name" required>
        
        <label for="surname">Soyad</label></br>
        <input type="text" name="surname" id="surname" required>
        
        <label for="password">Şifre</label></br>
        <input type="password" name="password" id="password" required>
        
        <label for="kumseID">KumesID</label></br>
        <input type="number" name="kumesID" id="kumesID" required>
        
        <label for="follukID">FollukID</label></br>
        <input type="number" name="follukID" id="follukID" required>
        
        <input type="submit" value="Ekle">
    </form>
</div>

<?=template_footer_admin3()?>