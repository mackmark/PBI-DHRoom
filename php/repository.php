<?php
include "../includes/db.php";
include "../includes/functions.php";

date_default_timezone_set("Asia/Manila");
$dateInit = date('Y-m-d');//date uploaded
$dateNav = date('M d, Y');
$time =  date("H:i:s");
$time2 = date("h:i:s a");
$day = date("l");
$Month = date("F");
$dayNo = date("d");
$year = date("Y"); //year
$timestamp = $dateInit.' '.$time;

if(isset($_POST['action'])){
    if($_POST['action']=='GetWeatherData'){
        $output = '';
        $celcius = 0;
        $fahrenheit = 0;
        $status = "";
        $icon = 0;
        $isDay = false;
        $isDayBit = 0;

        if(isset($_POST['temp'])){
            $celcius = $_POST['temp'];
        }
        if(isset($_POST['temp2'])){
            $fahrenheit = $_POST['temp2'];
        }
        if(isset($_POST['status'])){
            $status = $_POST['status'];
        }
        if(isset($_POST['icon'])){
            $icon = $_POST['icon'];
        }
        if(isset($_POST['Isday'])){
            $IsDay = $_POST['Isday'];
        }

        if($IsDay==true){
            $isDayBit = 1;
        }

        $sql_insert = " INSERT INTO weather_tbl (CelsiusValue, Fahrenheit, WeatherStatus, WeatherIcon, IsDay) " ;
        $sql_insert.="Values('".$celcius."', '".$fahrenheit."', '".$status."', '".$icon."', '".$isDayBit."') ";

        $result = odbc_exec($connServer, $sql_insert);
        // confirmQuery($result);

        if($result){
            $output.='<p class="text-secondary ml-3 " style="font-size:18px;">'.$status.'</p>
            <div class="d-flex justify-content-around">
                <div class="container text-center">
                    <p class="text-secondary"><span style="font-size:40px;">'.$celcius.'</span> <span class="position-relative" style="top:-18px;">°C</span></p>
                </div>

                <div class="container text-center p-0 mt-3">
                    <p class="text-secondary" style="font-size:13px;line-height:5px;white-space:nowrap;">'.$day.', '.$dayNo.' '.$Month.'</p>
                    <p class="text-secondary" style="font-size:13px;line-height:5px;"><i class="fa fa-map-marker-alt p-0"></i> Santa Maria</p>
                </div>

                <div class="container text-right">
                    <img src="https://developer.accuweather.com/sites/default/files/'.sprintf("%02d", $icon).'-s.png" width="160" class="img-fluid position-relative p-0" style="top:-20px"   alt="CloudyIcons">
                </div>
            </div>';
        }
        else{
            $output.='<div class="container text-center">
            <img src="weatherIcons/error.gif" class="img-fluid" alt="">
            </div>

            <div class="container text-center mt-3">
                <p class="text-secondary">Error fetching the data.</p>
            </div>';
        }

        echo json_encode($output);
        
    }
    else if($_POST['action']=='deviceConnection'){
        $output = '';
        $output_temp = '';
        $output_RH = '';
        $sql = "select * from deviceStatus_tbl ";

        $result = odbc_exec($connServer, $sql);

        // confirmQuery($result);

        $count_result = odbc_num_rows($result);

        if($count_result !=0){
            while($row = odbc_fetch_array($result)){
                $DeviceStatus    = $row['DeviceStatus'];
                $DeviceBit       = $row['DeviceBit'];

                if($DeviceBit > 0){
                    $output.='<div class="d-flex justify-content-around">
                                <div class="text-left">
                                    <p class="text-secondary mt-4" style="font-size:15px;line-height:5px;white-space:nowrap;">COMET P1185 SENSOR</p>
                                </div>

                                <div></div>

                                <div class="text-center">
                                <img src="weatherIcons/connected.png" class="img-fluid" alt="" width="20">
                                <p class="text-secondary mt-3" style="font-size:10px;line-height:0px;white-space:nowrap;">Connected</p>
                                </div>

                            </div>';
                    
                            $sql_val = "select * from weather_tbl where WeatherID = (select max(WeatherID) from weather_tbl) ";

                            $result_val = odbc_exec($connServer, $sql_val);

                            // confirmQuery($result);

                            $count_result_val = odbc_num_rows($result_val);

                            if($count_result_val !=0){
                                while($row_val = odbc_fetch_array($result_val)){
                                    $CelsiusVal = $row_val['CelsiusValue'];
                                    $RHVal = $row_val['RelativeHumidityValue'];

                                    $output_temp.= '<div class="container text-center">
                                                        <p class="text-secondary mt-2" style="font-size:12px;font-weight:bold;line-height:0px;white-space:nowrap;">Temperature</p>
                                                        <hr class="bg-light">

                                                        <div class="d-flex justify-content-around">
                                                            <div class="text-left">
                                                                <p class="text-secondary mt-5" style="font-size:45px;line-height:5px;white-space:nowrap;">'.$CelsiusVal.'</p>
                                                            </div>


                                                            <div class="text-center">
                                                                <i class="fa fa-temperature-high fa-2x text-danger"></i>
                                                                <hr class="bg-light">
                                                                <span class="d-block text-secondary mr-3 mb-2" style="font-size:25px;">°C</span>
                                                            </div>

                                                        </div>

                                                    </div>';

                                    $output_RH.= '<div class="container text-center">
                                                        <p class="text-secondary mt-2" style="font-size:12px;font-weight:bold;line-height:0px;white-space:nowrap;">Relative Humidity</p>
                                                        <hr class="bg-light">

                                                        <div class="d-flex justify-content-around">
                                                            <div class="text-left">
                                                                <p class="text-secondary mt-5" style="font-size:45px;line-height:5px;white-space:nowrap;">'.$RHVal.'</p>
                                                            </div>


                                                            <div class="text-center">
                                                                <i class="fa fa-tint fa-2x text-primary"></i>
                                                                <hr class="bg-light">
                                                                <span class="d-block text-secondary mr-3 mb-2" style="font-size:25px;">%</span>
                                                            </div>

                                                        </div>
                                                    </div>';
                                }
                            }
                            else{
                                $output_temp.= '<div class="container text-center">
                                                        <p class="text-secondary mt-2" style="font-size:12px;font-weight:bold;line-height:0px;white-space:nowrap;">Temperature</p>
                                                        <hr class="bg-light">

                                                        <div class="d-flex justify-content-around">
                                                            <div class="text-left">
                                                                <p class="text-secondary mt-5" style="font-size:45px;line-height:5px;white-space:nowrap;">---</p>
                                                            </div>


                                                            <div class="text-center">
                                                                <i class="fa fa-temperature-high fa-2x text-danger"></i>
                                                                <hr class="bg-light">
                                                                <span class="d-block text-secondary mr-3 mb-2" style="font-size:25px;">°C</span>
                                                            </div>

                                                        </div>

                                                    </div>';

                                    $output_RH.= '<div class="container text-center">
                                                        <p class="text-secondary mt-2" style="font-size:12px;font-weight:bold;line-height:0px;white-space:nowrap;">Relative Humidity</p>
                                                        <hr class="bg-light">

                                                        <div class="d-flex justify-content-around">
                                                            <div class="text-left">
                                                                <p class="text-secondary mt-5" style="font-size:45px;line-height:5px;white-space:nowrap;">---</p>
                                                            </div>


                                                            <div class="text-center">
                                                                <i class="fa fa-tint fa-2x text-primary"></i>
                                                                <hr class="bg-light">
                                                                <span class="d-block text-secondary mr-3 mb-2" style="font-size:25px;">%</span>
                                                            </div>

                                                        </div>
                                                    </div>';
                            }
                }
                else{
                    $output.='<div class="d-flex justify-content-around">
                                <div class="text-left">
                                    <p class="text-secondary mt-4" style="font-size:15px;line-height:5px;white-space:nowrap;">COMET P1185 SENSOR</p>
                                </div>

                                <div></div>

                                <div class="text-center">
                                <img src="weatherIcons/disconnected.png" class="img-fluid" alt="" width="20">
                                <p class="text-secondary mt-3" style="font-size:10px;line-height:0px;white-space:nowrap;">Disconnected</p>
                                </div>

                            </div>';

                    $output_temp.= '<div class="container text-center">
                                        <p class="text-secondary mt-2" style="font-size:12px;font-weight:bold;line-height:0px;white-space:nowrap;">Temperature</p>
                                        <hr class="bg-light">

                                        <div class="d-flex justify-content-around">
                                            <div class="text-left">
                                                <p class="text-secondary mt-5" style="font-size:45px;line-height:5px;white-space:nowrap;">---</p>
                                            </div>


                                            <div class="text-center">
                                                <i class="fa fa-temperature-high fa-2x text-danger"></i>
                                                <hr class="bg-light">
                                                <span class="d-block text-secondary mr-3 mb-2" style="font-size:25px;">°C</span>
                                            </div>

                                        </div>

                                    </div>';

                    $output_RH.= '<div class="container text-center">
                                        <p class="text-secondary mt-2" style="font-size:12px;font-weight:bold;line-height:0px;white-space:nowrap;">Relative Humidity</p>
                                        <hr class="bg-light">

                                        <div class="d-flex justify-content-around">
                                            <div class="text-left">
                                                <p class="text-secondary mt-5" style="font-size:45px;line-height:5px;white-space:nowrap;">---</p>
                                            </div>


                                            <div class="text-center">
                                                <i class="fa fa-tint fa-2x text-primary"></i>
                                                <hr class="bg-light">
                                                <span class="d-block text-secondary mr-3 mb-2" style="font-size:25px;">%</span>
                                            </div>

                                        </div>
                                    </div>';
                }
                
            }

        }

        $arr = array(
            'data1'=>$output,
            'data2'=>$output_temp,
            'data3'=>$output_RH
        );

        echo json_encode($arr);
    }
}



?>