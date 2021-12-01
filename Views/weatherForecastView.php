<?php 






$json = json_decode(stripslashes($datas));
//$array = json_decode($json, true);
$datas = ($json->list);
//var_dump($datas);

echo count($datas);

foreach($datas as $data){
  echo "<li>".$data->dt_txt."</li>";
  echo "<li>".$data->wind->speed."km/h</li>";
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