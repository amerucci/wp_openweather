<?php

require_once 'Database.php';


class Data extends Database
{
                
        /**
         * Enregistrer la clé API dans la base de données
         *
         * @return void
         */
        public function setApiKey($key){
                global $wpdb;
                $apik = $this->connect()->prepare(
                        'INSERT INTO '.$wpdb->prefix.'options (option_name, option_value, autoload) VALUES ("apikey", :option_value, "yes")'
                );
                $apik->bindParam (':option_value', $key); 
                $apik->execute();
                $apik->debugDumpParams();
                die;
           
        }
        
        /**
         * Récupérer la clé API de la base de données
         *
         * @return void
         */
        public function getApiKey(){
                
        }


        /**
         * Récupération de toutes les communes enregistrées dans la base de données lors de l'activation du plug in
         * @return array
         */
        public function getAllCommunes()
        {
                $datas = $this->connect()->prepare(
                        "SELECT nom FROM communes"
                );
                $datas->execute();
                $allDatas = $datas->fetchAll();
                //var_dump($allDatas);
                return $allDatas;
        }

        
        /**
         * Get des informations d'une ville selectionnée
         *
         * @param  mixed $what
         * @return void
         */
        public function getWeatherOf($what){
            
            $curl = curl_init("https://api.openweathermap.org/data/2.5/weather?q=".$what."&appid=22de69d47c753d7302c408802108fe0f&lang=fr&units=metric");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $meteo = curl_exec($curl);
            $meteo = json_decode($meteo, true);
            return $meteo;
        }
            
        
        //https://api.openweathermap.org/data/2.5/forecast?callback=response&q=Paris&appid=a939b3a2c089cdc4dcefee3b74142319&units=metric&lang=fr
     
}