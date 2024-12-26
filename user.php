<?php
// Kullanıcı giriş yapmış mı diye kontrol et.
if(!isset($_SESSION['loggedinMember'])) {
    header("Location: index.php?page=login");
}

if(isset($_GET['userid']) && isset($_GET['coopid']) && isset($_GET['nestingid'])) {
    // Önceki sayfalarda gelen kullanıcı, kümes, folluk id biligilerini alıyoruz.
    $userid    = $_GET['userid'];
    $coopid    = $_GET['coopid'];
    $nestingid = $_GET['nestingid'];

    // Anlık sensör verilerini almak için.
    $stmt = $pdo->prepare("SELECT * FROM sensors WHERE coop_id = ? ORDER BY id DESC LIMIT 1");
    $stmt->execute([$coopid]);
    $sensors = $stmt->fetch(PDO::FETCH_ASSOC);

    // Anlık yumurta verilerini çekmek için.
    $stmt1 = $pdo->prepare("SELECT * FROM eggs WHERE nest_id = ? ORDER BY id DESC LIMIT 1");
    $stmt1->execute([$nestingid]);
    $eggs = $stmt1->fetch(PDO::FETCH_ASSOC);

    // Anlık resim verisini almak için.
    $stmt2 = $pdo->prepare("SELECT * FROM nests WHERE coop_id = ? ORDER BY id DESC LIMIT 1");
    $stmt2->execute([$coopid]);
    $images = $stmt2->fetch(PDO::FETCH_ASSOC);

    // Toplam yumurta sayısını tutmak için.
    $total = $eggs['white_eggs'] + $eggs['brown_eggs'] + $eggs['blue_eggs'];

    // Tüm yumurta verilerini almak için.
    $stmt12 = $pdo->prepare("SELECT * FROM eggs WHERE nest_id = ? ORDER BY created_at ASC");
    $stmt12->execute([$nestingid]);
    $eggsHistory = $stmt12->fetchAll(PDO::FETCH_ASSOC);

    // 01.01.2001 gibi değerleri pazartesi gibi string değere çevirmek için.
    $days = [];
    foreach ($eggsHistory as $row) {
        $date = new DateTime($row['created_at']);
        $days[] = $date->format('l'); // Pazartesi, Salı gibi günler
    }

    $daysJSON = json_encode($days); //Verilerin eklendiği tarihi JavaScripte aktarmak için.
    $sensorJSON = json_encode($sensors); //Sensör verilerini Javascripte aktarmak için.
    $eggJSON = json_encode($eggsHistory); //Yumurta verilerini Javascripte aktarmak için
}

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Kullanıcı Veri Sayfası</title>
</head>
<body>
    <div class="header">
        <div class="top">
            <div class="logo">
                <a href="https://www.tubitak.gov.tr">
                    <img id="logo" src="logo.png" alt="logo"/>
                </a>
            </div>
            <div class="bideb">
                <p id="bideb">TÜBİTAK-BİDEB 2209-A</p>
                <p id="text">Web Tabanlı Görüntü İşlemeye Dayalı Folluk Takip Sistemi</p>
            </div>
            <div class="logout">
                <a href="index.php?page=logout" class="logouta">
                    <i id="logout" class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
        </div>
        <div class="text">
            
        </div>
    </div>
    
    <div class="currentDatasContainer">
        <div class="currentDatasText">
            <p id="currentDatasText">Anlık Veriler</p>
        </div>

        <div class="currentDatas">
            <div class="vector"> 
                <div class="refresh">
                    <button id="refresh">Yenile</button>
                </div>
                
                <div id="output"></div>
            </div>
            
            <div class="containerDatas">
                <div class="left">
                    <div class="heat">
                        <p id="heat">Sıcaklık</p>
                    </div>
                    <div class="heatValue">
                        <p id="heatValue"><?=$sensors['temperature']?>°C</p>
                    </div>
                    <div class="humidity">
                        <p id="humidity">Nem</p>
                    </div>
                    <div class="humidityValue">
                        <p id="humidityValue">%<?=$sensors['humidity']?></p>
                    </div>
                    <div class="sound">
                        <p id="sound">Ses Seviyesi</p>
                    </div>
                    <div class="soundValue">
                        <p id="soundValue"><?=$sensors['sound_level']?> dB</p>
                    </div>
                </div>
                <div class="mid">
                    <img id="photo" src="foto.jpg" alt="">
                </div>
                <div class="right">
                    <div class="topEgg">
                        <div class="white">
                            <img id="white" src="./white_new.png" alt="white">
                            <p id="whiteText"><?=$eggs['white_eggs']?></p>
                        </div>
                        <div class="brown">
                            <img id="brown" src="./brown_new.png" alt="brown">
                            <p id="brownText"><?=$eggs['brown_eggs']?></p>
                        </div>
                    </div>
                    <div class="botEgg">
                        <div class="blue">
                            <img id="blue" src="./blue_new.png" alt="blue">
                            <p id="blueText"><?=$eggs['blue_eggs']?></p>
                        </div>
                        <div class="total">
                            <img id="total" src="./total_new.png" alt="all">
                            <p id="totalText"><?=$total?></p>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <div class="coopHistoryContainer">
        <div class="coopHistoryText">
            <p id="coopHistoryText">Folluk Geçmişi</p>
        </div>
        <div class="coopHistory">
            <div class="graph">
                <canvas id="myCanvas" width="1728" height="400"></canvas>
            </div>
        </div>
    </div>

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

    <script>
        // Yenileme tuşuna basıldığında işlemi gerçekleştirmek için.
        document.getElementById("refresh").addEventListener("click", function() {
            location.href = "index.php?page=managementupdate";
        })

        //PHP'den gelen verileri almak için.
        const sensorData = <?php echo $sensorJSON; ?>;
        const eggData = <?php echo $eggJSON; ?>;
        const dayLabels = <?php echo $daysJSON; ?>;

        // Yumurta türlerini grafik için ayrıştır.
        let brownEggs = [];
        let blueEggs = [];
        let whiteEggs = [];

        // Yumurta sayılarını 
        for (let i = 0; i < eggData.length; i++) {
            brownEggs.push(parseInt(eggData[i].brown_eggs));
            blueEggs.push(parseInt(eggData[i].blue_eggs));
            whiteEggs.push(parseInt(eggData[i].white_eggs));
        }

        // Chart.js ile grafik oluşturma ve grafiğe değer girme.
        const ctx = document.getElementById("myCanvas").getContext("2d");
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dayLabels, // Günler
                datasets: [ // Verilerin grafikte gösterim stilleri ayarlanıyor.
                    {
                        label: 'Kahverengi Yumurta',
                        data: brownEggs,
                        borderColor: 'brown',
                        backgroundColor: 'rgba(165, 42, 42, 0.2)',
                        fill: true
                    },
                    {
                        label: 'Mavi Yumurta',
                        data: blueEggs,
                        borderColor: 'blue',
                        backgroundColor: 'rgba(0, 0, 255, 0.2)',
                        fill: true
                    },
                    {
                        label: 'Beyaz Yumurta',
                        data: whiteEggs,
                        borderColor: 'gray',
                        backgroundColor: 'rgba(192, 192, 192, 0.2)',
                        fill: true
                    }
                ]
            },
            options: {
                // Grafiğin başlık ve yazı boyutu gibi özellikleri ayarlanıyor.
                plugins: {
                    title: {
                        display: true,
                        text: 'Yumurta Türleri ve Günlere Göre Veriler',
                        font: {
                            size: 24
                        }
                    }
                },
                // X ve Y koordinatlarının özellikleri ayarlanıyor.
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Günler'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Yumurta Sayısı'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
