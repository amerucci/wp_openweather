<?php 

//Lignes à ajouter afin de pouvoir utiliser global $wpdb dans notre requette ajax
define( 'SHORTINIT', true );
require( '../../../../wp-load.php' );



require_once  __DIR__ . '/../Models/Data.php';
require_once  __DIR__ . '/../Models/Database.php';


if (isset($_GET['cp']) && !empty($_GET['cp'])) {
    $commune = $_GET['cp'];
    $search = new Data;
    $search = $search->getAllCommunes($commune);
} 