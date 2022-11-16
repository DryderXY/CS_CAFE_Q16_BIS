<?php

namespace App\Modele;
use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;
class Modele_Niveau_Autorisation
{
    static function Niveau_Autorisation_Select()
    {
        $connexionPDO = Singleton_ConnexionPDO::getInstance();
        $requetePreparee = $connexionPDO->prepare('
        select * 
        from `niveau_autorisation` 
        ');
        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête

        $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
        return $tableauReponse;
    }
}