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

  #current-weather {
    padding: 80px 40px;
    background: #f8f9fa;
  }

  #mainTemperature {
    font-size: 5.5em;
    line-height: 0.7;
  }

  #tempDescription {
    margin-top: 10px;
    text-align: center;
  }


  .day-weather-box p {
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

  .modal-body p {
    color: #333;
  }

  .entry-content>div {
    /* background: #ff9900; */
    width: 100%;
    max-width: 1240px!important;
}

p#forecast-day-1-name {
    font-size: 12px;
    text-align: center;
}

spam#forecast-day-1-ht {
  font-weight: bold;
    text-align: center;
    width: 100%;
    display: block;
    margin-top: 10px;
    font-size: 13px;
}
</style>



<?php

	


$json = json_decode(stripslashes($datas));
$datas = ($json->list);

$img = json_decode(stripslashes($config['images']));

//echo count($datas);
echo "<pre>";
var_dump($datas[0]->dt_txt);
var_dump($img[0]->imgurl);
echo "</pre>";

echo $img[0]->imgurl;

// $date = explode(" ", $data->dt_txt);
// echo $dateNew = DateTime::createFromFormat('Y-m-d', $date[0])->format('d/m/Y')."<br/>";
?>

<div class="container" id="wrapper">
  <div class="container-fluid" id="current-weather">
    <div class="row">

      <!-- Right panel -->
      <div class="col-md-4 col-sm-5">
        <h5>
          <spam id="cityName"><?= $config['shortcode']; ?></spam>
        </h5>
        <h6 id="localDate">

          <?php
          

          echo wp_date( 'l d F Y' );


          ?>


        </h6>
        <h5 id="localTime">
          <?php
          setlocale(LC_TIME, 'fr_FR');
          date_default_timezone_set('Europe/Paris');
          echo utf8_encode(strftime('%H:%M'));


          ?>
        </h5>

      </div>

      <?php
      function changeWeatherImg($icon, $img)
      {
        // echo $icon;
        // var_dump( $img[0]->imgurl);
        // die();
        switch ($icon) {
          case (($icon == "01d" &&  !empty($img[0]->imgurl)) || ($icon == "01n" &&  !empty($img[0]->imgurl))):
            echo '<img src="'.$img[0]->imgurl.'" alt="" width="150" title=""/>';
            break;
            case (($icon == "02d" &&  !empty($img[1]->imgurl)) || ($icon == "02n" &&  !empty($img[1]->imgurl))):
            echo '<img src="'.$img[1]->imgurl.'" alt="" width="150" title=""/>';
            break;
            case (($icon == "03d" &&  !empty($img[2]->imgurl)) || ($icon == "03n" &&  !empty($img[2]->imgurl))):
            echo '<img src="'.$img[2]->imgurl.'" alt="" width="150" title=""/>';
            break;
          case (($icon == "04d" &&  !empty($img[3]->imgurl)) || ($icon == "04n" &&  !empty($img[3]->imgurl))):
            echo '<img src="'.$img[3]->imgurl.'" alt="" width="150" title=""/>';
            break;
            case (($icon == "09d" &&  !empty($img[4]->imgurl)) || ($icon == "09n" &&  !empty($img[4]->imgurl))):
            echo '<img src="'.$img[4]->imgurl.'" alt="" width="150" title=""/>';
            break;
            case (($icon == "10d" &&  !empty($img[5]->imgurl)) || ($icon == "10n" &&  !empty($img[5]->imgurl))):
            echo '<img src="'.$img[5]->imgurl.'" alt="" width="150" title=""/>';
            break;
            case (($icon == "11d" &&  !empty($img[6]->imgurl)) || ($icon == "11n" &&  !empty($img[6]->imgurl))):
            echo '<img src="'.$img[6]->imgurl.'" alt="" width="150" title=""/>';
            break;
            
          case (($icon == "13d" &&  !empty($img[7]->imgurl)) || ($icon == "13n" &&  !empty($img[7]->imgurl))):
            echo '<img src="'.$img[7]->imgurl.'" alt="" width="150" title=""/>';
            break;
            case (($icon == "50d" &&  !empty($img[8]->imgurl)) || ($icon == "50n" &&  !empty($img[8]->imgurl))):

            echo '<img src="'.$img[8]->imgurl.'" alt="" width="150" title=""/>';
            break;

            default:
            echo '<img src="https://openweathermap.org/img/wn/' . $icon . '.png" alt="" title=""/>';
            break;
        }
      }



      ?>
      <!-- Center panel -->
      <div class="col-md-5 col-sm-7" style="margin: 10px auto;padding:0;">
        <div class="row">
          <i class="wi col-12 col-md-6" id="main-icon" style="font-size: 85px;">

            <?php changeWeatherImg($datas[0]->weather[0]->icon, $img); ?>

          </i>
          <div class="col-12 col-md-6">
            <spam id="mainTemperature"><?= round($datas[0]->main->temp); ?>°C</spam>

            <?php if ($config['ressenti'] == "YES") : ?>
              <p id="tempRessenti"><span>Ressenti</span><?= round($datas[0]->main->feels_like); ?>°C</p>
            <?php endif; ?>

            <p id="tempDescription"><?= $datas[0]->weather[0]->description; ?></p>

          </div>

        </div>
      </div>

      <!-- Left panel -->
      <div class="col-xs-12 col-sm-12 col-md-3 row" style="text-align: right;">

        <?php if ($config['humidite'] == "YES") : ?>

          <div class="col-md-12 col-sm-3 col-xs-3 side-weather-info">
            <h6>Humidity: <spam id="humidity"><?= $datas[0]->main->humidity; ?></spam>%</h6>
          </div>
        <?php endif; ?>

        <?php if ($config['vitessevent'] == "YES") : ?>
          <div class="col-md-12 col-sm-3 col-xs-3 side-weather-info">
            <h6>Wind: <spam id="wind"><?= $datas[0]->wind->speed; ?></spam> m/s</h6>
          </div>
        <?php endif; ?>

        <?php if ($config['tempmax'] == "YES") : ?>
          <div class="col-md-12 col-sm-3 col-xs-3 side-weather-info">
            <h6>High: <spam id="mainTempHot"><?= round($datas[0]->main->temp_max); ?></spam>°</h6>
          </div>
        <?php endif; ?>
        <?php if ($config['tempmin'] == "YES") : ?>
          <div class="col-md-12 col-sm-3 col-xs-3 side-weather-info">
            <h6>Low: <spam id="mainTempLow"><?= round($datas[0]->main->temp_min); ?></spam>°</h6>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>



  <!-- 4 days forecast -->
  <div class="container-fluid">
    <div class="row" style="padding: 2px;">


      <?php for ($d = 1; $d < count($datas); $d++) { ?>


        <!-- Day 1 -->
        <div class="col-md-2 col-sm-2 day-weather-box">
          <div class="col-sm-12 day-weather-inner-box">
            <div class="col-sm-8 forecast-main">
              <p id="forecast-day-1-name"><?= $datas[$d]->dt_txt; ?></p>
              <div class="row">
                <h5 id="forecast-day-1-main"></h5>

                <?php changeWeatherImg($datas[$d]->weather[0]->icon, $img); ?>

      </i>
                <p>
                  <spam class="high-temperature" id="forecast-day-1-ht"><?= round($datas[$d]->main->temp); ?>°C</spam>
                </p>
              </div>
            </div>

          </div>
        </div>

      <?php } ?>



    </div>
  </div>
</div>












<?php
$html =  ob_get_clean();
?>