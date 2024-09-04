let liste = [317621];

function main(key) {
    var xhr = new XMLHttpRequest();
    var apiKey = "Jja3H20rdBQa6jgCGRZqRpfVUJTFgk3F";
    var locationKey = key;
    var language = "tr-tr";
    var details = true;
    var url = "https://dataservice.accuweather.com/currentconditions/v1/" + locationKey + "?apikey=" + apiKey + "&language=" + language + "&details=" + details;

    var cities = {
        Kocaeli : 1293991,
        Ankara : 316938,
        Bayburt : 317230,
        İstanbul : 318251,
        Trabzon : 321281,
        Çorum : 317621
    }

    var reverseCities = {
        1293991: 'Kocaeli',
        316938:'Ankara',
        317230:"Bayburt",
        318251 :"İstanbul",
        321281:"Trabzon",
        317621:"Çorum"
    }

    // var butondegis = document.getElementById("degis");
    var sec = document.getElementById("city");

    // butondegis.onclick = function() {
    //     liste.pop();
    //     cityName = sec.value;
    //     liste.push(cities[cityName]);
    //     main(liste[0]);
    // }

    xhr.open("GET", url, true);

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Yanıt işleme kodları burada yer alır
            var response = JSON.parse(xhr.responseText);
            console.log(response);
            console.log(response[0].WeatherText);

            // // City
            // var sehir = document.getElementById("ground");;
            // sehir.innerHTML = reverseCities[liste[0]];

            function centigrade() {
                // Derece
                var derece = document.getElementById("degree_value");
                derece.innerHTML = String(response[0].Temperature.Metric.Value).substring(0,2) + "°C";
                console.log(String(response[0].Temperature.Metric.Value).substring(0,2) + "°C");

                // // Havanın nasıl olduğu
                // var weatherText = document.getElementById("weatherText");
                // weatherText.innerHTML = String(response[0].WeatherText);

                // Rüzgar hızı
                var windSpeed = document.getElementById("wind_speed");
                windSpeed.innerHTML = String(response[0].Wind.Speed.Metric.Value) + " " + String(response[0].Wind.Speed.Metric.Unit);
                console.log(String(response[0].Wind.Speed.Metric.Value));
                // // Hissedilen sıcaklık
                // var realFeelTemperature = document.getElementById("content2");
                // realFeelTemperature.innerHTML = String(response[0].RealFeelTemperature.Metric.Value) + "°C";

                // Bağıl nem
                var relativeHumidity = document.getElementById("humidity_value");
                relativeHumidity.innerHTML = "%" + String(response[0].RelativeHumidity);
                console.log(String(response[0].RelativeHumidity));

                // UV index
                var uvindex = document.getElementById("uv_value");
                uvindex.innerHTML = String(response[0].UVIndex) + " " + String(response[0].UVIndexText);
                console.log(String(response[0].UVIndex));

                // // Çiy noktası
                // var dewPoint = document.getElementById("content5");
                // dewPoint.innerHTML = String(response[0].DewPoint.Metric.Value) + "°C";

                // button.innerHTML = "°F";

                // button.onclick = changeF;

                //button.addEventListener("click", changeF);

            };

            function fahrenheit() {
                // Derece
                var derece = document.getElementById("derece");
                derece.innerHTML = String(response[0].Temperature.Imperial.Value).substring(0,3) + "°F";

                // Havanın nasıl olduğu
                var weatherText = document.getElementById("weatherText");
                weatherText.innerHTML = String(response[0].WeatherText);

                // Rüzgar hızı
                var windSpeed = document.getElementById("content1");
                windSpeed.innerHTML = String(response[0].Wind.Speed.Imperial.Value) + String(response[0].Wind.Speed.Imperial.Unit);

                // Hissedilen sıcaklık
                var realFeelTemperature = document.getElementById("content2");
                realFeelTemperature.innerHTML = String(response[0].RealFeelTemperature.Imperial.Value) + "°F";

                // Bağıl nem
                var relativeHumidity = document.getElementById("content3");
                relativeHumidity.innerHTML = "%" + String(response[0].RelativeHumidity)

                // UV index
                var uvindex = document.getElementById("content4");
                uvindex.innerHTML = String(response[0].UVIndex) + " " + String(response[0].UVIndexText);

                // Çiy noktası
                var dewPoint = document.getElementById("content5");
                dewPoint.innerHTML = String(response[0].DewPoint.Imperial.Value) + "°F";

                button.innerHTML = "°C";

                button.onclick = changeC

                //button.addEventListener("click", changeC);


            };

            function changeF() {
                button.className = "F";
                fahrenheit();
            }

            function changeC() {
                button.className = "C";
                centigrade();
            }

            centigrade();

        };
    };

    xhr.send();
}

main(liste[0]);
