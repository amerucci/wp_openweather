<?php

class Data extends Database
{

        public function insertCommune()
        {
                $supprimer = $this->connect()->prepare('Delete from communes');
                $supprimer->execute();
                $curl = curl_init("https://geo.api.gouv.fr/communes");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $regions = curl_exec($curl);
                $regions = json_decode($regions, true);
                foreach ($regions as $region) {
                        $ajouter = $this->connect()->prepare('INSERT INTO communes (nom) VALUES (:nom)');
                        $ajouter->bindParam(':nom', $region['nom']);
                        $ajouter->execute();
                        $ajouter->debugDumpParams();
                }
                curl_close($curl);
        }
}