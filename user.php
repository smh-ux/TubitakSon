<?php

if(!isset($_SESSION['loggedinMember'])) {
    header("Location: index.php?page=login");
}

if(isset($_GET['userid']) && isset($_GET['coopid']) && isset($_GET['nestingid'])) {
    $userid    = $_GET['userid'];
    $coopid    = $_GET['coopid'];
    $nestingid = $_GET['nestingid'];

    $stmt = $pdo->prepare("SELECT kumesler.Konum, veriler.Zaman, veriler.kumesID, veriler.YumurtaID, veriler.Sicaklik, veriler.Nem, veriler.Desibel, veriler.ReferansYumurta, veriler.Adet, veriler.FollukID FROM kumesler JOIN veriler ON kumesler.FollukID = veriler.FollukID WHERE kumesler.FollukID = ?");
    $stmt->execute([$nestingid]);
    $datas = $stmt->fetch(PDO::FETCH_ASSOC);

    // // Kahverengi
    // $stmt2 = $pdo->prepare("SELECT COUNT(*) AS total FROM yumurtalar JOIN veriler ON yumurtalar.YumurtaID = veriler.YumurtaID WHERE veriler.FollukID = ? AND Renk = 'Kahverengi'");
    // $stmt2->execute([$nestingid]);
    // $brown = $stmt2->fetch(PDO::FETCH_ASSOC);
    // $totalBrown = $brown['total'];
    //
    // // Beyaz
    // $stmt3 = $pdo->prepare("SELECT COUNT(*) AS total FROM yumurtalar JOIN veriler ON yumurtalar.YumurtaID = veriler.YumurtaID WHERE veriler.FollukID = ? AND Renk = 'Beyaz'");
    // $stmt3->execute([$nestingid]);
    // $white = $stm3->fetchAll(PDO::FETCH_ASSOC);
    // $totalWhite = $white['total'];
    //
    // // Mavi
    // $stmt4 = $pdo->prepare("SELECT COUNT(*) AS total FROM yumurtalar JOIN veriler ON yumurtalar.YumurtaID = veriler.YumurtaID WHERE veriler.FollukID = ? AND Renk = 'Mavi'");
    // $stmt4->execute([$nestingid]);
    // $blue = $stmt4->fetchAll(PDO::FETCH_ASSOC);
    // $totalBlue = $blue['total'];

    // $stmt5 = $pdo->prepare("SELECT MONTH(veriler.Zaman) AS ay, yumurtalar.Renk AS renk, COUNT(*) AS total FROM veriler JOIN yumurtalar ON veriler.YumurtaID = yumurtalar.YumurtaID WHERE veriler.FollukID = ? GROUP BY ay, renk ORDER BY ay");
    // $stmt5->execute([$nestingid]);
    // $lastdata = $stmt5->fetchAll(PDO::FETCH_ASSOC);
    //
    // $months = [];
    // $colors = [];
    // $colorData = [];
    //
    // foreach ($lastdata as $row) {
    //     $month = $row['ay'];
    //     $color = $row['renk'];
    //     $count = $row['total'];
    //
    //     // Ayları ve renkleri gruplama
    //     if (!in_array($month, $months)) {
    //         $months[] = $month;
    //     }
    //
    //     if (!isset($colors[$color])) {
    //         $colors[$color] = array_fill(0, 12, 0);
    //     }
    //
    //     $colors[$color][$month - 1] = $count;
    // }
    //
    // $monthNames = [
    //     1 => 'Ocak',
    //     2 => 'Şubat',
    //     3 => 'Mart',
    //     4 => 'Nisan',
    //     5 => 'Mayıs',
    //     6 => 'Haziran',
    //     7 => 'Temmuz',
    //     8 => 'Ağustos',
    //     9 => 'Eylül',
    //     10 => 'Ekim',
    //     11 => 'Kasım',
    //     12 => 'Aralık'
    // ];
    //
    // $months = array_map(function($m) use ($monthNames) {
    //     return $monthNames[$m];
    // }, $months);
    //
    // $dataFromPHP = [
    //     'months' => $months,
    //     'colors' => $colors
    // ];
}

?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <title>User Page</title>
      <link href="user.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="./weather.js"></script>
    </head>

    <body>
        <div class="weather">
            <a href="index.php?page=logout">
                <div class="exit">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
            </a>
            <div class="parameters">
                <div class="empty"></div>

                <div class="title-container">
                    <p class="title">Folluk Adı: <?=$datas['Konum']?></p>
                </div>

                <div class="top-full-container">
                    <div class="full-container">
                        <div class="subtitle-container">
                            <p class="subtitle">Yumurta Sayısı </p>
                        </div>
                        <div class="value-container">
                            <p class="value"><?=$datas['Adet']?> adet</p>
                        </div>
                    </div>

                    <div class="full-container">
                        <div class="subtitle-container">
                            <p class="subtitle">Hava Sıcaklığı </p>
                        </div>
                        <div class="value-container">
                            <p class="value" id="degree_value">Sıcaklık Değerini Çekerken Beklenmedik Bir Hata Oluştu</p>
                        </div>
                    </div>

                    <div class="full-container">
                        <div class="subtitle-container">
                            <p class="subtitle">Nem </p>
                        </div>
                        <div class="value-container">
                            <p class="value" id="humidity_value">Nem Değerini Çekerken Beklenmedik Bir Hata Oluştu</p>
                        </div>
                    </div>
                </div>

                <div class="bot-full-continer">
                    <div class="full-container">
                        <div class="subtitle-container">
                            <p class="subtitle">Desibel </p>
                        </div>
                        <div class="value-container">
                            <p class="value"><?=$datas['Desibel']?> db</p>
                        </div>
                    </div>

                    <div class="full-container">
                        <div class="subtitle-container">
                            <p class="subtitle">UV </p>
                        </div>
                        <div class="value-container">
                            <p class="value" id="uv_value">UV Değerini Çekerken Beklenmedik Bir Hata Oluştu</p>
                        </div>
                    </div>

                    <div class="full-container">
                        <div class="subtitle-container">
                            <p class="subtitle">Rüzgar Hızı </p>
                        </div>
                        <div class="value-container">
                            <p class="value" id="wind_speed">Rüzgar Hızı Değerini Çekerken Beklenmedik Bir Hata Oluştu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="image-title">
            <h1 class="img-text">Folluğunuzun En Son Kaydedilmiş Resmi</h1>
        </div>

        <div class="top">
            <img src="0009-Nesting-Box-Herb-Rosemary.jpg" alt="nesting box">
        </div>

        <div class="graph">
            <canvas id="myCanvas" width="1920" height="1080"></canvas>
        </div>

        <script>

            var canvas = document.getElementById("myCanvas");
            var ctx = canvas.getContext("2d");
            var data = [12, 19, 3, 17, 6, 3, 7, 12, 19, 3, 17, 6];
            var labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
                    datasets: [
                        {
                            label: 'Mavi',
                            data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                            backgroundColor: 'rgba(0, 0, 255, 1)',
                            borderColor: 'rgba(0, 0, 255, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Beyaz',
                            data: [20, 30, 40, 50, 20, 30, 40, 50, 20, 30, 40, 50],
                            backgroundColor: 'rgba(255, 255, 255, 1)',
                            borderColor: 'rgba(255, 255, 255, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Kahverengi',
                            data: [10, 20, 30, 40, 10, 20, 30, 40, 10, 20, 30, 40],
                            backgroundColor: 'rgba(97, 49, 4, 1)',
                            borderColor: 'rgba(97, 49, 4, 1)',
                            borderWidth: 1
                        },
                    ]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Renklerine Göre Yumurta Sayısı',
                            font: {
                                size: 24
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Aylar'
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

            // var ctx = document.getElementById('myCanvas').getContext('2d');
            // var dataFromPHP = <?= json_encode($dataFromPHP) ?>;
            //
            // var myChart = new Chart(ctx, {
            //     type: 'bar',
            //     data: {
            //         labels: dataFromPHP.months,
            //         datasets: Object.keys(dataFromPHP.colors).map(function(color) {
            //             return {
            //                 label: color,
            //                 data: dataFromPHP.colors[color],
            //                 backgroundColor: getColor(color),
            //                 borderColor: getColor(color),
            //                 borderWidth: 1
            //             };
            //         })
            //     },
            //     options: {
            //         plugins: {
            //             title: {
            //                 display: true,
            //                 text: 'Renklerine Göre Yumurta Sayısı',
            //                 font: {
            //                     size: 24
            //                 }
            //             }
            //         },
            //         scales: {
            //             x: {
            //                 beginAtZero: true,
            //                 title: {
            //                     display: true,
            //                     text: 'Aylar'
            //                 }
            //             },
            //             y: {
            //                 beginAtZero: true,
            //                 title: {
            //                     display: true,
            //                     text: 'Yumurta Sayısı'
            //                 }
            //             }
            //         }
            //     }
            // });
            //
            // function getColor(color) {
            //     switch(color) {
            //         case 'Kahverengi': return 'rgba(97, 49, 4, 1)';
            //         case 'Beyaz': return 'rgba(255, 255, 255, 1)';
            //         case 'Mavi': return 'rgba(0, 0, 255, 1)';
            //         default: return 'rgba(0, 0, 0, 1)';
            //     }
            // }


            // let rangeMin = 100;
            // const range = document.querySelector(".range-selected");
            // const rangeInput = document.querySelectorAll(".range-input input");
            // const rangePrice = document.querySelectorAll(".range-price input");

            // rangeInput.forEach((input) => {
            //     input.addEventListener("input", (e) => {
            //         let minRange = parseInt(rangeInput[0].value);
            //         let maxRange = parseInt(rangeInput[1].value);
            //         if (maxRange - minRange < rangeMin) {
            //             if (e.target.className === "min") {
            //                 rangeInput[0].value = maxRange - rangeMin;
            //             } else {
            //                 rangeInput[1].value = minRange + rangeMin;
            //             }
            //         } else {
            //             rangePrice[0].value = minRange;
            //             rangePrice[1].value = maxRange;
            //             range.style.left = (minRange / rangeInput[0].max) * 100 + "%";
            //             range.style.right = 100 - (maxRange / rangeInput[1].max) * 100 + "%";
            //         }
            //     });
            // });

            // rangePrice.forEach((input) => {
            //     input.addEventListener("input", (e) => {
            //     let minPrice = rangePrice[0].value;
            //     let maxPrice = rangePrice[1].value;
            //     if (maxPrice - minPrice >= rangeMin && maxPrice <= rangeInput[1].max) {
            //         if (e.target.className === "min") {
            //             rangeInput[0].value = minPrice;
            //             range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
            //         } else {
            //             rangeInput[1].value = maxPrice;
            //             range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            //         }
            //     }
            //     });
            // });



            // let rangeMin1 = 100;
            // const range1 = document.querySelector(".range-selected1");
            // const rangeInput1 = document.querySelectorAll(".range-input1 input");
            // const rangePrice1 = document.querySelectorAll(".range-price1 input");

            // rangeInput1.forEach((input) => {
            //     input.addEventListener("input", (e) => {
            //         let minRange = parseInt(rangeInput1[0].value);
            //         let maxRange = parseInt(rangeInput1[1].value);
            //         if (maxRange - minRange < rangeMin1) {
            //             if (e.target.className === "min1") {
            //                 rangeInput1[0].value = maxRange - rangeMin1;
            //             } else {
            //                 rangeInput1[1].value = minRange + rangeMin1;
            //             }
            //         } else {
            //             rangePrice1[0].value = minRange;
            //             rangePrice1[1].value = maxRange;
            //             range1.style.left = (minRange / rangeInput1[0].max) * 100 + "%";
            //             range1.style.right = 100 - (maxRange / rangeInput1[1].max) * 100 + "%";
            //         }
            //     });
            // });

            // rangePrice1.forEach((input) => {
            //     input.addEventListener("input", (e) => {
            //     let minPrice = rangePrice1[0].value;
            //     let maxPrice = rangePrice1[1].value;
            //     if (maxPrice - minPrice >= rangeMin1 && maxPrice <= rangeInput1[1].max) {
            //         if (e.target.className === "min1") {
            //             rangeInput1[0].value = minPrice;
            //             range1.style.left = (minPrice / rangeInput1[0].max) * 100 + "%";
            //         } else {
            //             rangeInput1[1].value = maxPrice;
            //             range1.style.right = 100 - (maxPrice / rangeInput1[1].max) * 100 + "%";
            //         }
            //     }
            //     });
            // });

        </script>
    </body>
</html>
