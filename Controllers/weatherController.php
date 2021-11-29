<?php
require_once  __DIR__ . '/../Models/Data.php';

/**
 * Récupérer la météo d'une ville ciblée
 *
 * @param  mixed $atts
 * @return array
 */
function getWeather($atts)
{
    $data = new Data;
    $datas = $data->getWeatherOf($atts);
    require(__DIR__ . "/../Views/weatherView.php");
    return $html;
}

function getWeatherPage($atts, $ressenti)
{
    $ressenti = $ressenti;
    $data = new Data;
    $datas = $data->getWeatherPageOf($atts);
    require(__DIR__ . "/../Views/weatherView.php");
    return $html;
}

