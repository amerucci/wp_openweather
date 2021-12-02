<?php ob_start(); ?>



<?php

//var_dump($datas);

$img = $datas['weather'][0]['icon'];
$imgdesc = $datas['weather'][0]['description'];


echo '<img src="https://openweathermap.org/img/wn/' . $img . '.png" alt="' . $imgdesc . '" title="' . $imgdesc . '"/>';
echo round($datas['main']['temp']) . "°C";

?>  





    <?php
    $html =  ob_get_clean();
    ?>