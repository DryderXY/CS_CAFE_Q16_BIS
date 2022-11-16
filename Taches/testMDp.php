<?php
function passgen1($nbChar, $seed=1) {
    $chaine ="mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0";
    $ln = strlen($chaine);
    $pass = '';
    for($i=0; $i<$nbChar; $i++){
        $pass .= $chaine[random_int(0, $ln-1)];
    }
    return $pass;
}

function passgen2($nbChar){
    return substr(str_shuffle(
        'abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789'),1, $nbChar);
}
/*
//Création de la séquence aléatoire à la base du mot de passe
$octetsAleatoires = openssl_random_pseudo_bytes (18) ;
//Transformation de la séquence binaire en caractères alpha
$motDePasse = sodium_bin2base64($octetsAleatoires, SODIUM_BASE64_VARIANT_ORIGINAL);
echo $motDePasse;*/

for($i = 0; $i < 4; $i++)
{
    echo passgen1(10)."\n";
}