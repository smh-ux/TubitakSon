<?php
// Veritabanı bağlantısını sağlayan fonksiyon.
function pdo_connect_mysql() {
    // Veritabanı giriş bilgileri.
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'folluk_takibi_new';
    $DATABASE_CHARSET = 'utf8';

    // Veritabanı bağlantı kontrolü.
    try{
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=' . $DATABASE_CHARSET, $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        exit('Failed to connect to database!');
    }
}

// Ana menü HTML şablon fonksiyonu.
function template_index() {
  // Giriş yapıldı mı yapılmadı mı diye kontrol yapılması.
  if(isset($_SESSION['loggedinAdmin']) || isset($_SESSION['loggedinMember'])) {
    echo <<< EOT
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <title>Ana Sayfa</title>
    </head>
    <body>
        <div class="headerContainer">
            <div class="tubitakLogo">
                <a href="https://www.tubitak.gov.tr">
                    <img id="tubitakLogo" src="logo.png" alt="tübitak logo"> 
                </a>
            </div>

            <div class="tubitakSubject">
                <p id="tubitakSubject"> 
                    TÜBİTAK-BİDEB 2209-A
                </p>
                <p id="type">Web Tabanlı Görüntü İşlemeye Dayalı Folluk Takip Sistemi</p>
            </div>

            <div class="logo">
                <div id="logo">
                    <a id="logoa" href="index.php?page=logout">
                        <i class="fa fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>
        </div>

        <img class="imageContainer" src="serkan_hoca_kümes.jpg"/>

        <div class="employersTable">
            <div class="employersTableTitle">
                <p>Proje Bilgileri</p>
            </div>
            <div class="texts">
                <div class="titles">
                    <p>Proje No</p>
                    <p>Proje Dönemi</p>
                    <p>Proje Adı</p>
                    <p>Proje Ekibi</p>
                </div>
                <div class="semiColumns">
                    <p>:</p>
                    <p>:</p>
                    <p>:</p>
                    <p>:</p>
                </div>
                <div class="values"> 
                    <p>1919B012304347
                    <p>2023 - I</p>
                    <p>Web Tabanlı Görüntü İşlemeye Dayalı Folluk Takip Sistemi</p>
                    <div class="employers">
                        <div class="left">
                            <p>Zübeyir Dönmez</p>
                            <p>Semih Okumuş</p>
                            <p>Enes Ünver</p>
                            <p>Dr. Ögr. Üyesi Serkan Dişlitaş</p>
                        </div>
                        <div class="mid">
                            <p>-</p>
                            <p>-</p>
                            <p>-</p>
                            <p>-</p>
                        </div>
                        <div class="right">
                            <p>Yürütücü</p>
                            <p>Proje Ortağı</p>
                            <p>Proje Ortağı</p>
                            <p>Akademik Danışman</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="summary">
                <div class="title">
                    <p>Proje Özeti</p>
                </div>
                <div class="semiColumn">
                    <p>:</p>
                </div>
                <div class="value">
                    <p>Gelişen teknoloji ile birlikte özellikle ticari, askeri, tıbbi ve eğitim olmak üzere üretim, yönetim, Ar-Ge vb. amaçlarla internet tabanlı uzaktan izleme ve kontrol uygulamaları hızla yaygınlaşmaktadır. Uzaktan izleme ve kontrol işlemlerinde bilgisayarların yanı sıra programlanabilir lojik kontrolör (PLC), mikroişlemci ve mikrodenetleyici tabanlı gömülü sistemlerin kullanıldığı web ve mobil tabanlı çözümlere ilgi büyüktür. Hayvancılık sektöründe kümes, çiftlik, ağıl vb. besi alanlarında gerekli olan sıcaklık, nem, ses seviyesi vb. ortam koşullarının sağlanması, yeterli düzeyde beslemenin yapılması, güvenliğin sağlanması, sağlık kontrolü ve ayrıca anomali durum kontrolü üretim kalitesi ve verimlilik açısından büyük önem taşımaktadır. Bu açıdan hayvancılık sektöründe de uzaktan izleme ve kontrol işlemlerine yönelik yoğun bir ilgiyle çeşitli araştırmalar yapılmıştır. Bu çalışmada kanatlı kümes hayvanlarına yönelik yumurtlama veriminin ortam değişkenlerine bağlı olarak uzaktan takip edilmesi amacıyla görüntü işlemeye dayalı web tabanlı gömülü sistem tasarımı yapılacaktır. Geliştirilen web arayüzüne sahip gömülü sistemin gerçek kümes ortamına entegrasyonu sağlanarak çalışması incelenecektir. Geliştirilen sistemde gerçek zamanlı olarak elde edilen sıcaklık, nem, gürültü seviyesi, yumurta sayısı gibi folluk bilgileri veritabanında tutulacaktır. Bu sayede planlama ve yönetim açısından büyük önem taşıyan zamana ve ortam değişkenlerine bağlı olarak istatistikler ve verimlilik durumu elde edilerek sayısal ve grafik tabanlı analizler yapılacaktır.</p>
                </div>
            </div>
        </div>
        <!-- <div class="footerContainer">
            <div class="footerText">
                <p class="date">Logo 2023-2024</p>
            </div>
            <div class="footerImg">
                <img class="img" src="logouni.png" alt="uni">
            </div>
        </div> -->

        <div class="footerContainer">
            <div class="footerImg">
                <a href="https://www.hitit.edu.tr">
                    <img id="fotouni" src="logouni.png" alt="">
                </a>
            </div>
            <div class="footer">
                <p id="footer">2023-2024 Hitit Üniversitesi <a id="footera" href="https://mf.hitit.edu.tr/tr/bilgisayar">Bilgisayar</a> Mühendisliği</p>
            </div>
        </div>
    </body>
    </html>
    EOT;
  }
  // Giriş yapılmamışsa.
  else {
  echo <<< EOT
  <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <title>Ana Sayfa</title>
    </head>
    <body>
        <div class="headerContainer">
            <div class="tubitakLogo">
                <a href="https://www.tubitak.gov.tr">
                    <img id="tubitakLogo" src="logo.png" alt="tübitak logo"> 
                </a>
            </div>

            <div class="tubitakSubject">
                <p id="tubitakSubject"> 
                    TÜBİTAK-BİDEB 2209-A
                </p>
                <p id="type">Web Tabanlı Görüntü İşlemeye Dayalı Folluk Takip Sistemi</p>
            </div>

            <div class="logo">
                <div id="logo">
                    <a id="logoa" href="index.php?page=login">
                        <i class="fas fa-user"></i>
                        Giriş
                    </a>
                </div>
            </div>
        </div>

        <img class="imageContainer" src="serkan_hoca_kümes.jpg"/>

        <div class="employersTable">
            <div class="employersTableTitle">
                <p>Proje Bilgileri</p>
            </div>
            <div class="texts">
                <div class="titles">
                    <p>Proje No</p>
                    <p>Proje Dönemi</p>
                    <p>Proje Adı</p>
                    <p>Proje Ekibi</p>
                </div>
                <div class="semiColumns">
                    <p>:</p>
                    <p>:</p>
                    <p>:</p>
                    <p>:</p>
                </div>
                <div class="values"> 
                    <p>1919B012304347
                    <p>2023 - I</p>
                    <p>Web Tabanlı Görüntü İşlemeye Dayalı Folluk Takip Sistemi</p>
                    <div class="employers">
                        <div class="left">
                            <p>Zübeyir Dönmez</p>
                            <p>Semih Okumuş</p>
                            <p>Enes Ünver</p>
                            <p>Dr. Ögr. Üyesi Serkan Dişlitaş</p>
                        </div>
                        <div class="mid">
                            <p>-</p>
                            <p>-</p>
                            <p>-</p>
                            <p>-</p>
                        </div>
                        <div class="right">
                            <p>Yürütücü</p>
                            <p>Proje Ortağı</p>
                            <p>Proje Ortağı</p>
                            <p>Akademik Danışman</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="summary">
                <div class="title">
                    <p>Proje Özeti</p>
                </div>
                <div class="semiColumn">
                    <p>:</p>
                </div>
                <div class="value">
                    <p>Gelişen teknoloji ile birlikte özellikle ticari, askeri, tıbbi ve eğitim olmak üzere üretim, yönetim, Ar-Ge vb. amaçlarla internet tabanlı uzaktan izleme ve kontrol uygulamaları hızla yaygınlaşmaktadır. Uzaktan izleme ve kontrol işlemlerinde bilgisayarların yanı sıra programlanabilir lojik kontrolör (PLC), mikroişlemci ve mikrodenetleyici tabanlı gömülü sistemlerin kullanıldığı web ve mobil tabanlı çözümlere ilgi büyüktür. Hayvancılık sektöründe kümes, çiftlik, ağıl vb. besi alanlarında gerekli olan sıcaklık, nem, ses seviyesi vb. ortam koşullarının sağlanması, yeterli düzeyde beslemenin yapılması, güvenliğin sağlanması, sağlık kontrolü ve ayrıca anomali durum kontrolü üretim kalitesi ve verimlilik açısından büyük önem taşımaktadır. Bu açıdan hayvancılık sektöründe de uzaktan izleme ve kontrol işlemlerine yönelik yoğun bir ilgiyle çeşitli araştırmalar yapılmıştır. Bu çalışmada kanatlı kümes hayvanlarına yönelik yumurtlama veriminin ortam değişkenlerine bağlı olarak uzaktan takip edilmesi amacıyla görüntü işlemeye dayalı web tabanlı gömülü sistem tasarımı yapılacaktır. Geliştirilen web arayüzüne sahip gömülü sistemin gerçek kümes ortamına entegrasyonu sağlanarak çalışması incelenecektir. Geliştirilen sistemde gerçek zamanlı olarak elde edilen sıcaklık, nem, gürültü seviyesi, yumurta sayısı gibi folluk bilgileri veritabanında tutulacaktır. Bu sayede planlama ve yönetim açısından büyük önem taşıyan zamana ve ortam değişkenlerine bağlı olarak istatistikler ve verimlilik durumu elde edilerek sayısal ve grafik tabanlı analizler yapılacaktır.</p>
                </div>
            </div>
        </div>
        <!-- <div class="footerContainer">
            <div class="footerText">
                <p class="date">Logo 2023-2024</p>
            </div>
            <div class="footerImg">
                <img class="img" src="logouni.png" alt="uni">
            </div>
        </div> -->

        <div class="footerContainer">
            <div class="footerImg">
                <a href="https://www.hitit.edu.tr">
                    <img id="fotouni" src="logouni.png" alt="">
                </a>
            </div>
            <div class="footer">
                <p id="footer">2023-2024 Hitit Üniversitesi <a id="footera" href="https://mf.hitit.edu.tr/tr/bilgisayar">Bilgisayar</a> Mühendisliği</p>
            </div>
        </div>
    </body>
    </html>
  EOT;
  }
}

// Giriş sayfası için HTML şablon fonksiyonu.
function template_login() { 
    echo <<< EOT
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="login.css">
        <title>Giriş</title>
    </head>
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
                <form action="index.php?page=authenticate" method="POST">
                    <div class="botbot">
                        <div class="botbotleft">
                            <label id="usernameText" for="username">Kullanıcı Adı </label>
                            <label id="passwordText" for="password">Parola</label> 
                        </div>
                        <div class="botbotright">
                            <input type="text" name="username" id="username" required>
                            <input type="password" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" id="button" value="Giriş Yap">
                    </div>
                </form>
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
    EOT;
}

// Admin tarafının ilk sayfası.
function template_admin() {
  echo <<< EOT
  <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width"> 
        <title>User Page</title>
        <link href="admin1.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    
    <body>
  EOT;
}

// Admin kısmının ikinci sayfasının(kullanıcı ayarları) header kısmı.
function template_admin1() {
  echo <<< EOT
  <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width"> 
        <title>User Page</title>
        <link href="admin1.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    
    <body>
  EOT;
}

// Admin sayfasının üçüncü kısmının(kullanıcı bilgileri ve ayarları) header kısmı.
function template_admin2() {
  echo <<< EOT
  <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width"> 
        <title>User Page</title>
        <link href="admin1.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    
    <body>
  EOT;
}

// Admin sayfasının dördüncü kısmının(kullanıcı ekleme) header kısmı.
function template_admin3() {
    echo <<< EOT
    <!DOCTYPE html>
    <html>
      <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width">
          <title>Admin Page</title>
          <link href="admin3.css" rel="stylesheet" type="text/css" />
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
      </head>
  
      <body>
    EOT;
}

// Kümes seçim sayfasının header kısmı.
function template_coop_choose() {
    echo <<< EOT
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width"> 
        <title>User Page</title>
        <link href="admin1.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    
    <body>
    EOT;
}

// Folluk seçim sayfasının header kısmı.
function template_nesting_box_choose() {
    echo <<< EOT
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width"> 
        <title>User Page</title>
        <link href="admin1.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    
    <body>
    EOT;
}