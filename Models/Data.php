<?php

class Data extends Database
{
        
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

                
     
}