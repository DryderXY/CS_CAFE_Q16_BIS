<?php
namespace App\Fonctions;
    function Redirect_Self_URL():void{
        unset($_REQUEST);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

function GenereMDP($nbChar) :string{
    $chaine ="mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0";
    $ln = strlen($chaine);
    $pass = '';
    for($i=0; $i<$nbChar; $i++){
        $pass .= $chaine[random_int(0, $ln-1)];
    }
    return $pass;
}

