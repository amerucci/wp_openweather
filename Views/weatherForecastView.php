


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

<?php ob_start(); ?>
<style>
  
#wrapper {

  margin: 100px auto;
  max-width: 100%;
  padding: 0px;
  color: #000;  
}

#current-weather{
  padding: 15px;
}

#mainTemperature{
  font-size: 5.5em; 
  line-height: 0.7;
}

#tempDescription {
  margin-top: 10px;
  text-align: center;
}

.day-weather-box {
  border: 1px solid #28688C;
  background-color: #2E7FA1;
  border-radius: 5px;
  height: 5em;
}

.day-weather-box p{
  margin-bottom: 0;
}

.side-weather-info {
  padding: 0px 10px;
}

.day-weather-inner-box {
  display: inline-flex;
  margin: 14px auto;
  padding: 0px 5px;
}

.forecast-main {
  padding: 0px 0px 0px 30px;
}

.forecast-icon {
  font-size: 25px;
  margin-left: 5px;
}

.modal-body p{
  color: #333;
}
</style>



<?php 
$json = json_decode(stripslashes($datas));
$datas = ($json->list);
echo "<pre>";
//var_dump($datas[0]->wind);
var_dump($config);
echo "</pre>";


// $date = explode(" ", $data->dt_txt);
// echo $dateNew = DateTime::createFromFormat('Y-m-d', $date[0])->format('d/m/Y')."<br/>";
?>

<div class="container" id="wrapper">
  <div class="container-fluid" id="current-weather">
    <div class="row">
      
      <!-- Right panel -->
      <div class="col-md-4 col-sm-5">
        <h5><spam id="cityName"><?= $config['shortcode']; ?></spam></h5>
        <h6 id="localDate">La date</h6>
        <h5 id="localTime"></h5>
        
      </div>
      
      <!-- Center panel -->
      <div class="col-md-5 col-sm-7" style="margin: 10px auto;padding:0;">
        <div class="row">
          <i class="wi" id ="main-icon" style="font-size: 85px;">
          <?= '<img src="https://openweathermap.org/img/wn/' . $datas[0]->weather[0]->icon . '.png" alt="" title=""/>'?></i>
          <div>
            <spam id="mainTemperature"><?=round($datas[0]->main->temp);?>°C</spam>
            <p id="tempDescription"><?= $datas[0]->weather[0]->description; ?></p>
          </div>
          <p style="font-size: 1.5rem;"><?=round($datas[0]->main->temp);?>°C</p>
        </div>
      </div>
      
      <!-- Left panel -->
      <div class="col-xs-12 col-sm-12 col-md-3 row" style="text-align: right;">

    <?php if($config['humidite']=="YES"): ?>

        <div class="col-md-12 col-sm-3 col-xs-3 side-weather-info">
          <h6>Humidity: <spam id="humidity"><?=$datas[0]->main->humidity;?></spam>%</h6>
        </div>
    <?php endif; ?>
        <div class="col-md-12 col-sm-3 col-xs-3 side-weather-info">
          <h6>Wind: <spam id="wind"><?=$datas[0]->wind->speed;?></spam> m/s</h6>
        </div>
        <div class="col-md-12 col-sm-3 col-xs-3 side-weather-info">
          <h6>High: <spam id="mainTempHot"><?=round($datas[0]->main->temp_max);?></spam>°</h6>
        </div>
        <div class="col-md-12 col-sm-3 col-xs-3 side-weather-info">
          <h6>Low: <spam id="mainTempLow"><?=round($datas[0]->main->temp_min);?></spam>°</h6>
        </div>
      </div>
      
    </div>
  </div>
  

  
  <!-- 4 days forecast -->
  <div class="container-fluid">
    <div class="row" style="padding: 2px;">
      
      <!-- Day 1 -->
      <div class="col-md-3 col-sm-6 day-weather-box">
        <div class="col-sm-12 day-weather-inner-box">
          <div class="col-sm-8 forecast-main">
            <p id="forecast-day-1-name"></p>
            <div class="row">
              <h5 id="forecast-day-1-main">°</h5>
              <i class="wi forecast-icon" id="forecast-day-1-icon"></i>
            </div>
          </div>
          <div class="col-sm-4 forecast-min-low">
            <p><spam class="high-temperature" id="forecast-day-1-ht"></spam></p>
            <p><spam class="low-temperature" id="forecast-day-1-lt"></spam></p>
          </div>
        </div>
      </div>
      
      <!-- Day 2 -->
      <div class="col-md-3 col-sm-6 day-weather-box">
        <div class="col-sm-12 day-weather-inner-box">
          <div class="col-sm-8 forecast-main">
            <p id="forecast-day-2-name"></p>
            <div class="row">
              <h5 id="forecast-day-2-main">°</h5>
              <i class="wi forecast-icon" id="forecast-day-2-icon"></i>
            </div>
          </div>
          <div class="col-sm-4 forecast-min-low">
            <p><spam class="high-temperature" id="forecast-day-2-ht"></spam></p>
            <p><spam class="low-temperature" id="forecast-day-2-lt"></spam></p>
          </div>
        </div>
      </div>
      
      <!-- Day 3 -->
      <div class="col-md-3 col-sm-6 day-weather-box">
        <div class="col-sm-12 day-weather-inner-box">
          <div class="col-sm-8 forecast-main">
            <p id="forecast-day-3-name"></p>
            <div class="row">
              <h5 id="forecast-day-3-main">°</h5>
              <i class="wi forecast-icon" id="forecast-day-3-icon"></i>
            </div>
          </div>
          <div class="col-sm-4 forecast-min-low">
            <p><spam class="high-temperature" id="forecast-day-3-ht"></spam></p>
            <p><spam class="low-temperature" id="forecast-day-3-lt"></spam></p>
          </div>
        </div>
      </div>
      
      <!-- Day 4 -->
      <div class="col-md-3 col-sm-6 day-weather-box">
        <div class="col-sm-12 day-weather-inner-box">
          <div class="col-sm-8 forecast-main">
            <p id="forecast-day-4-name"></p>
            <div class="row">
              <h5 id="forecast-day-4-main">°</h5>
              <i class="wi forecast-icon" id="forecast-day-4-icon"></i>
            </div>
          </div>
          <div class="col-sm-4 forecast-min-low">
            <p><spam class="high-temperature" id="forecast-day-4-ht"></spam></p>
            <p><spam class="low-temperature" id="forecast-day-4-lt"></spam></p>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>







  




    <?php
    $html =  ob_get_clean();
    ?>