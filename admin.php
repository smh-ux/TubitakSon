<?php

if(!$_SESSION['loggedinAdmin']) {
    header("Location: index.php?page=login");
    exit;
}

?>

<?=template_admin()?> 

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
                <div class="buttons">
                    <a href="index.php?page=admin1"><button>Kullanıcı Ayarları</button></a>
                    <a href="index.php?page=logout"><button>Çıkış</button></a>
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