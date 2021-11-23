<?php
/*
Plugin Name: ACS OPEN WEATHER
Description: Plugin Météo développé pour l'Access Code School de Lons le Saunier
Version: 0.1
License: GPL
Author: Alain MERUCCI
Author URI: https://www.alainmerucci.fr
*/

/*
 * Ajouter d'un nouveau menu à notre panel Admin
 */

// On attache l'action monLienAdmin à admin_menu
add_action('admin_menu', 'lienAdmin');

// Add a new top level menu link to the ACP
function lienAdmin()
{
    add_menu_page(
        'ACS Weather', // Titre de ma page
        'ACS Weather', // titre du menu qui va s'afficher
        'manage_options', // On a besoin de cette fonction afin de pouvoir arriver sur la bonne page quand on clique
        plugin_dir_path(__FILE__) . 'includes/plugin_page.php' // L'adresse de là ou l'on doit arriver quand on clique sur le lien
    );
}


//Ici nous avons une fonction qui va ajouter une page si le plugin est activé
function initialisationPlugin()
{
        //Création de la table dans la BDD
        global $wpdb;
        $servername = $wpdb->dbhost;
        $username = $wpdb->dbuser;
        $password = $wpdb->dbpassword;
        $dbname = $wpdb->dbname;
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $sh = $conn->prepare( "DESCRIBE `weather`");
        if ( !$sh->execute() ) {
          $sql = "CREATE TABLE weather (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            shortcode VARCHAR(30) NOT NULL,
         )";
            $conn->exec($sql);
            $conn = null;
        
        } 

    //On crée une page qui va contenir la météo détaillé
    $weather_arr = array(
        'post_title'   => 'Météo',
        'post_content' => 'Ici nous aurons le détail de la météo',
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_author'  => get_current_user_id(),
    );

    wp_insert_post($weather_arr);


}
register_activation_hook(__FILE__, 'initialisationPlugin');

//Ici nous avons une fonction qui va supprimer une page si le plugin est désactivé
function myplugin_deactivate()
{
    //Iici on récup_re l'id de la page que l'on a créé
    $score_arr = get_page_by_title('Météo');
    wp_delete_post($score_arr->ID, true);
}


register_deactivation_hook(__FILE__, 'myplugin_deactivate');