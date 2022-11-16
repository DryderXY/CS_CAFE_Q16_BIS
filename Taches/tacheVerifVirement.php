<?php
include("autoload.php");

//Curl Récupérer le token

$connexion = Creer_Connexion();
//On va prendre la liste des commandes pas encore payées
$listeCommandes = Liste_Commande_Etat($connexion, 2);
foreach($listeCommandes as $commande)
{
    //Déterminer la reference de commande attendue !!
    $entreprise = Entreprise_Select_ParId($connexion, $commande["idEntreprise"]);
    $ref = "Brulerie_".$entreprise["denomination"]."_".$commande["idEntreprise"]."_".$commande["id"];

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "127.0.0.1/api/virement/{$ref}");
    curl_setopt($curl, CURLOPT_PORT, "8000");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($curl);
    echo "\n$ref réponse : $output";
    if($output != "null") {
        $mouvement = json_decode($output);
        //var_dump($mouvement);
        //vérifier que le montant est le bon !
        //faudrait une procédure
        //  en cas d'écart negatif (pas assez payé :) )
        //  en cas d'écart positif (trop payé ? avoir ? )

        $listeArticles = Rechercher_Liste_Article_Commande($connexion, $commande["id"]);
        $montant = 0;
        foreach($listeArticles as $article)
        {
            $montant += $article["quantite"] * $article["prixHT"];
        }

        if($montant == floatval($mouvement->montant))
        {
            //On est content, on change l'état !
            Commande_Update_Etat($connexion, $commande["id"], 3);

            //LOG
        }
        else
        {
            echo "\nboulet !";
            // LOG + mail gestionnaire + outils gestion de ce type de pbm !
        }
    }
    curl_close($curl);
}