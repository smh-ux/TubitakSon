<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'folluk_takibi';
    $DATABASE_CHARSET = 'utf8';

    try{
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=' . $DATABASE_CHARSET, $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        exit('Failed to connect to database!');
    }
}

function template_index() {
  if(isset($_SESSION['loggedinAdmin']) || isset($_SESSION['loggedinMember'])) {
    echo <<< EOT
    <!DOCTYPE html>
    <html>
      <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width">
          <title>Folluk Takibi</title>
          <link href="index.css" rel="stylesheet" type="text/css" />
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
      </head>
  
      <body>
          <div class="top_header"> 
              <div class="projectLogo">
                  <img src="https://www.tubitak.gov.tr/sites/default/files/tubitak_logo.png" alt="tübitak logo"> 
              </div>
  
              <div class="people_div">
                  <a href="index.php?page=people" id="people">Geliştiriciler</a>
              </div>
              
              <div class="üni_logo">
                  <img src="HititLogoYeni.svg" alt="University Logo"/>
              </div>
  
              <a href="index.php?page=logout"> 
                  <div class="logo">
                      <i class="fas fa-sign-out-alt"></i>
                      Çıkış
                  </div>
              </a>
          </div>
  
          <header>
              <div class="text">
                  <p id="small">Web Tabanlı Görüntü İşlemeye Dayalı</p><br/>
                  <p id="big">Folluk Takip Sistemi</p>
              </div>
              
              
          </header>
          
          <div class="description">
              <div class="description_text">
                  <p>
                      Önerilen araştırma projesinin amacı, kanatlı kümes hayvanlarına yönelik yumurtlama veriminin sıcaklık, nem, gürültü gibi ortam değişkenlerine bağlı olarak uzaktan takip edilmesidir. Bu amaçla web tabanlı bir gömülü sistem tasarımı yapılacak ve geliştirilecek yazılım sayesinde hem görüntü işlemeye dayalı olarak folluktaki yumurtaların sayımı yapılacak hem de sensörler yardımıyla ortam değişkenleri elde edilerek sistem veritabanına kaydedilecektir. Bu sayede ortam değişkenlerine bağlı olarak istenen zaman aralığında folluk verimlilik analizinin uzaktan yapılması hedeflenmektedir.
                  </p>
              </div>
          </div>
  
          <div class="images">
              <div class="image_container">
                  <img src="serkan_hoca_kümes.jpg" alt="kümes foto" width="1200px" height="600px">  
              </div>
              
               
          </div>
          
          <footer>
              <div class="foot-text-div">
                  <p class="foot-text">©2023-2024</p>
              </div>
          </footer>
      </body>
    </html>
    EOT;
  }
  else {
  echo <<< EOT
  <!DOCTYPE html>
  <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Folluk Takibi</title>
        <link href="index.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>

    <body>
        <div class="top_header">
            <div class="projectLogo">
                <img src="https://www.tubitak.gov.tr/sites/default/files/tubitak_logo.png" alt="tübitak logo"> 
            </div>

            <div class="people_div">
                <a href="index.php?page=people" id="people">Geliştiriciler</a>
            </div>
            
            <div class="üni_logo">
                <img src="HititLogoYeni.svg" alt="University Logo"/>
            </div>

            <a href="index.php?page=login"> 
                <div class="logo">
                    <i class="fas fa-user"></i>
                    Giriş
                </div>
            </a>
        </div>

        <header>
            <div class="text">
                <p id="small">Web Tabanlı Görüntü İşlemeye Dayalı</p><br/>
                <p id="big">Folluk Takip Sistemi</p>
            </div>
            
            
        </header>
        
        <div class="description">
            <div class="description_text">
                <p>
                    Önerilen araştırma projesinin amacı, kanatlı kümes hayvanlarına yönelik yumurtlama veriminin sıcaklık, nem, gürültü gibi ortam değişkenlerine bağlı olarak uzaktan takip edilmesidir. Bu amaçla web tabanlı bir gömülü sistem tasarımı yapılacak ve geliştirilecek yazılım sayesinde hem görüntü işlemeye dayalı olarak folluktaki yumurtaların sayımı yapılacak hem de sensörler yardımıyla ortam değişkenleri elde edilerek sistem veritabanına kaydedilecektir. Bu sayede ortam değişkenlerine bağlı olarak istenen zaman aralığında folluk verimlilik analizinin uzaktan yapılması hedeflenmektedir.
                </p>
            </div>
        </div>

        <div class="images">
            <div class="image_container">
                <img src="serkan_hoca_kümes.jpg" alt="kümes foto" width="1200px" height="600px">  
            </div>
            
             
        </div>
        
        <footer>
            <div class="foot-text-div">
                <p class="foot-text">©2023-2024</p>
            </div>
        </footer>
    </body>
  </html>
  EOT;
  }
}

function template_login() { 
    echo <<< EOT
    <!DOCTYPE html>
    <html>
    
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width"> 
      <title>Login Page</title>
      <link href="login.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
      <div class="login">
        <h1>
            Giriş Sayfası
        </h1>
        <form action="index.php?page=authenticate" method="POST">
          <div class="input">
            <label for="username">Username</label><br />
            <input name="username" type="text" required/><br />
            <label for="password">Password</label><br />
            <input name="password" type="password" required/><br />
          </div>
          <input type="submit" value="Giriş Yap">
        </form>
      </div> 
    </body>
    
    </html>
    EOT;
}

function template_admin() {
  echo <<< EOT
  <!DOCTYPE html>
  <html>
      <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width">
          <title>Admin Page</title>
          <link href="admin.css" rel="stylesheet" type="text/css" />
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
      </head>
  
      <body>
          <header>
              <h1>Merhaba Admin</h1>
          </header>
  
          <div class="panel">
              <div class="buttons">
                  <a href="index.php?page=admin1"><button>Kullanıcı Ayarları</button></a>
                  <a href="index.php?page=logout"><button>Çıkış</button></a>
              </div>
          </div>
      </body>
  </html>
  EOT;
}

function template_admin1() {
  echo <<< EOT
  <!DOCTYPE html>
  <html>
      <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width">
          <title>Admin Page</title>
          <link href="admin1.css" rel="stylesheet" type="text/css" />
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
      </head>
  
      <body>
          <header>
              <h1>Kullanıcılar</h1>
          </header>
  EOT;
}

function template_footer_admin1() {
    echo <<< EOT
        </body>
    </html>
    EOT;
}

function template_admin2() {
  echo <<< EOT
  <!DOCTYPE html>
  <html>
      <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width">
          <title>Admin Page</title>
          <link href="admin2.css" rel="stylesheet" type="text/css" />
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
      </head>
  
      <body>
  EOT;
}

function template_footer_admin2() {
    echo <<< EOT
        </body>
    </html>
    EOT;
}

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

function template_footer_admin3() {
    echo <<< EOT
      </body>
    </html>
    EOT;
}

function template_admin4() {
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

function template_footer_admin4() {
    echo <<< EOT
      </body>
    </html>
    EOT;
}

function template_user() {
  echo <<< EOT
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
                    <p class="title">Folluk Adı: Çorum</p>
                </div>

                <div class="top-full-container">
                    <div class="full-container">
                        <div class="subtitle-container">
                            <p class="subtitle">Yumurta Sayısı </p>
                        </div>
                        <div class="value-container">
                            <p class="value">15 adet</p>
                        </div>
                    </div>

                    <div class="full-container">
                        <div class="subtitle-container">
                            <p class="subtitle">Hava Sıcaklığı </p>
                        </div>
                        <div class="value-container">
                            <p class="value" id="degree_value"></p>
                        </div>
                    </div>

                    <div class="full-container">
                        <div class="subtitle-container">
                            <p class="subtitle">Nem </p>
                        </div>
                        <div class="value-container">
                            <p class="value" id="humidity_value"></p>
                        </div>
                    </div>
                </div>

                <div class="bot-full-continer">
                    <div class="full-container">
                        <div class="subtitle-container">
                            <p class="subtitle">Desibel </p>
                        </div>
                        <div class="value-container">
                            <p class="value">15 db</p>
                        </div>
                    </div>

                    <div class="full-container">
                        <div class="subtitle-container">
                            <p class="subtitle">UV </p>
                        </div>
                        <div class="value-container">
                            <p class="value" id="uv_value">1</p>
                        </div>
                    </div>

                    <div class="full-container">
                        <div class="subtitle-container">
                            <p class="subtitle">Rüzgar Hızı </p>
                        </div>
                        <div class="value-container">
                            <p class="value" id="wind_speed">1</p>
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
                type: 'bar', // Grafik türü
                data: {
                    labels: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'], // X ekseni etiketleri
                    datasets: [
                        {
                            label: 'Folluk 1',
                            data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Folluk 2',
                            data: [20, 30, 40, 50, 20, 30, 40, 50, 20, 30, 40, 50],
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Folluk Başına Aylık Yumurta Sayısı',
                            font: {
                                size: 24 // Başlık yazı tipi boyutu
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
  EOT;
}

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

function template_footer_coop_choose() {
    echo <<< EOT
        </body>
    </html>
    EOT;
}

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

function template_footer_nesting_box_choose() {
    echo <<< EOT
        </body>
    </html>
    EOT;
}

function template_people() {
  echo <<< EOT
  <!DOCTYPE html>
  <html>
      <head>
          <title>Projede Yer Alanlar</title>
          <link rel="stylesheet" href="people.css">
      </head>
  
      <body>
          <table style="width:70%">
              <tr>
                  <th style="width:10%">Sıra</th>
                  <th style="width:25%">Proje Sahipleri</th>
                  <th style="width:35%">Danışman</th>
              </tr>
              <tr>
                  <td>1</td>
                  <td>Zübeyir Dönmez<br/>(Proje Yöneticisi)</td>
                  <td rowspan="3">Dr. Öğr. Üyesi Serkan Dişlitaş</td>
              </tr>
              <tr>
                  <td>2</td>
                  <td>Semih Okumuş</td>
              </tr>
              <tr>
                  <td>3</td>
                  <td>Enes Ünver</td>
              </tr>
          </table>
      </body>
  </html>
  EOT;
}

?>