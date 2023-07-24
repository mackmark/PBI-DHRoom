$(document).ready(function () {
    WeatherData(262460, 'OZeEjDwYKeVbWrYTJCvoAUhfmZY0ZG2n')
    DeviceConnection()
    chart()
    // Execute action every 2 hours (in milliseconds)
    var interval = 2 * 60 * 60 * 1000; // 2 hours * 60 minutes * 60 seconds * 1000 milliseconds

    setInterval(function() {
        WeatherData(262460, 'OZeEjDwYKeVbWrYTJCvoAUhfmZY0ZG2n')
    }, interval);

    setInterval(function() {
        DeviceConnection()
    }, 2000);

});

function WeatherData(LocationKey, ApiKey){
    var settings = {
        "url": "http://dataservice.accuweather.com/forecasts/v1/hourly/1hour/"+LocationKey+"?apikey="+ApiKey,
        "method": "GET",
        "timeout": 0,
      };
      
      $.ajax(settings).done(function (response) {
        var temperature = response[0].Temperature.Value;
        var status = response[0].IconPhrase;
        var IconNo = response[0].WeatherIcon;
        var IsDay = response[0].IsDaylight;

        GetData(ConvertToCelcius(temperature),temperature, status, IconNo, IsDay)
      });
}

function GetData(Temperature, Temperature2, Status, IconNo, IsDayLight){
    var temp = Temperature
    var temp2 = Temperature2
    var status = Status
    var icon = IconNo
    var Isday = IsDayLight

    //console.log("Temperature: "+temp+" C | "+temp2+" F, Status: "+status+", Icon Number: "+icon+", Is Day: "+Isday)

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: "php/repository.php",
        data: {
            action:"GetWeatherData",
            temp:temp,
            temp2:temp2,
            status:status,
            icon:icon,
            Isday:Isday
        },
        success: function (data) {
            $('#weather_container').html(data)
            console.log('deviceConnect')
        }
    });

}

function DeviceConnection(){
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: "php/repository.php",
        data: {
            action:"deviceConnection",
        },
        success: function (data) {
            $('#DeviceConnection_container').html(data.data1)
            $('#Temp_container').html(data.data2)
            $('#RH_container').html(data.data3)
        }
    });
}

function ConvertToCelcius(FahrenheitValue){
    var value = FahrenheitValue
    var minus = value-32
    var multiply = minus*5
    var celcius =  multiply/9
    var roundedNumber = celcius.toFixed(2);
    return roundedNumber
}