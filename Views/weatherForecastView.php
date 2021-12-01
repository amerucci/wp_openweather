<?php 






$json = json_decode(stripslashes($datas));
//$array = json_decode($json, true);
$datas = ($json->list);
//var_dump($datas);

echo count($datas);

foreach($datas as $data){

//var_dump($data->weather['0']->description);

  echo "<li>";



  echo '<img src="https://openweathermap.org/img/wn/' . $data->weather['0']->icon . '.png" alt="' . $data->weather['0']->description . '" title="' . $data->weather['0']->description . '"/>';
  echo $data->weather['0']->description."<br/>";

  $date = explode(" ", $data->dt_txt);
  echo $dateNew = DateTime::createFromFormat('Y-m-d', $date[0])->format('d/m/Y')."<br/>";
  echo "Vent : ".$data->wind->speed."km/h</li>";
}



?>

<?php ob_start(); ?>


  <?php


// echo $config['shortcode'];

// if($config["ressenti"]=="true"){
//   echo '';
// }

//echo $datas['']
//$imgvalue = $imgurl[O]->imgurl;






// var_dump($config);


  ?>

  




    <?php
    $html =  ob_get_clean();
    ?>