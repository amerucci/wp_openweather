<?php

require_once 'Database.php';


class Data extends Database
{

        public function redir($url){
                echo '<script language="JavaScript">
                setTimeout("window.location=\''.$url.'\'"); 
                </script>';
               //../acs-weather/includes/plugin_page.php
        }


        /**
         * Enregistrement des informations concernant les données à afficher sur la page météo
         *
         * @param  mixed $string, retourne le shortcode de la ville choisie
         * @param  mixed $args[], array contenant tous les choix d'affichage
         * @return void
         */
        public function setMeteoArgs($string, $args, $jsonimg)
        {
                $arguments = implode(",", $args);
                $bind = join(',', array_fill(0, count($args), '"YES"'));
                $apik = $this->connect()->prepare(
                        'INSERT INTO weather (shortcode, ' . $arguments . ', images) VALUES (:string, ' . $bind . ', :images)'
                );
                $apik->bindParam(':string', $string);
                $apik->bindParam(':images', $jsonimg);
                $apik->debugDumpParams();

                $apik->execute();
                $this->redir('./admin.php?page=acs-weather%2Fincludes%2Fplugin_page.php');
        }

        public function updateMeteoArgs($string, $args, $images)
        {

             
                $allargs = ["ressenti", "tempmin", "tempmax", "humidite", "nebulosite", "vitessevent", "visibilite", "pecipitation"];
                $argsnotselected = array_diff($allargs, $args);
                $argsnotselected = array_values($argsnotselected);
                $queryString = "";
                for ($i = 0; $i < count($args); $i++) {
                        if(count($args)==8){
                                $separator = ($i < count($args) - 1) ? $separator = ', ' : ' ';   
                        }
                        else {
                                $separator = ", ";
                        }
                        $queryString .= $args[$i] . " = 'YES'" . $separator;
                }
                $queryStringnotselected = "";
                for ($j = 0; $j < count($argsnotselected); $j++) {
                        $separator = ($j < count($argsnotselected) - 1) ? $separator = ', ' : ' ';
                        $queryStringnotselected .= $argsnotselected[$j] . " = 'NO'" . $separator;
                       
                }
                $apik = $this->connect()->prepare('UPDATE weather SET shortcode = :string, ' . $queryString . ' ' . $queryStringnotselected . ', images = :images');
                $apik->bindParam(':string', $string);
                $apik->bindParam(':images', $images);
                
           
                $apik->execute();
                //$apik->debugDumpParams();
                $this->redir('./admin.php?page=acs-weather%2Fincludes%2Fplugin_page.php');
        }



        /**
         * Récupération des arguments pour la page météo
         *
         * @return array
         */
        public function getMeteoArgs()
        {
                $apik = $this->connect()->prepare(
                        'SELECT * FROM weather'
                );
                $apik->execute();
                //$apik->debugDumpParams();
                $apikey = $apik->fetch();
                return $apikey;
        }

        /**
         * Enregistrer la clé API dans la base de données
         *
         * @return void
         */
        public function setApiKey($key)
        {
                global $wpdb;
                $apik = $this->connect()->prepare(
                        'INSERT INTO ' . $wpdb->prefix . 'options (option_name, option_value, autoload) VALUES ("apikey", :option_value, "yes")'
                );
                $apik->bindParam(':option_value', $key);
                $apik->execute();
                //$apik->debugDumpParams();
                $this->redir('./admin.php?page=acs-weather%2Fincludes%2Fplugin_page.php');
        }


        /**
         * Mettre à jour la clé API
         *
         * @param  mixed $value
         * @param  mixed $key
         * @return void
         */
        public function updateApiKey($id, $valeur)
        {
                global $wpdb;
                $apik = $this->connect()->prepare('UPDATE ' . $wpdb->prefix . 'options SET option_value = :option_value WHERE option_id = :id');
                $apik->bindParam(':id', $id);
                $apik->bindParam(':option_value', $valeur);
                $apik->execute();
                //$apik->debugDumpParams();
                $this->redir('./admin.php?page=acs-weather%2Fincludes%2Fplugin_page.php');
        }

        /**
         * Récupérer la clé API de la base de données
         *
         * @return void
         */
        public function getApiKey()
        {
                global $wpdb;
                $apik = $this->connect()->prepare(
                        'SELECT * FROM ' . $wpdb->prefix . 'options WHERE option_name="apikey"'
                );
                $apik->execute();
                //$apik->debugDumpParams();
                $apikey = $apik->fetch();
                return $apikey;
        }


        /**
         * Récupération de toutes les communes enregistrées dans la base de données lors de l'activation du plug in
         * @return array
         */
        public function getAllCommunes($cp)
        {
                $datas = $this->connect()->prepare(
                        "SELECT nom FROM communes WHERE code LIKE '$cp%'"
                );
                $datas->execute();
                $allDatas = $datas->fetchAll();
                $allDatasJSON = json_encode($allDatas);
                echo $allDatasJSON;
        }


        /**
         * Get des informations d'une ville selectionnée
         *
         * @param  mixed $what Ville selectionnée
         * @return void
         */
        public function getWeatherOf($what)
        {
                $key = $this->getApiKey();
                $curl = curl_init("https://api.openweathermap.org/data/2.5/weather?q=" . $what . "&appid=" . $key['option_value'] . "&lang=fr&units=metric");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $meteo = curl_exec($curl);
                $meteo = json_decode($meteo, true);
                return $meteo;
        }
        
        /**
         * Get des informations d'une ville selectionnée pour la page Météo
         *
         * @param  mixed $what Ville selectionnée
         * @return void
         */
        public function getWeatherPageOf($what)
        {
                $key = $this->getApiKey();
                $request = "https://api.openweathermap.org/data/2.5/forecast?callback=response&q=" . $what . "&appid=" . $key['option_value'] . "&lang=fr&units=metric";
                $curl = curl_init($request);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $meteo = curl_exec($curl);
                return $meteo;
        }
}
