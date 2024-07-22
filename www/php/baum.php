<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



function baum($holz) {
    $text = date("Y-m-d H:i:s")."✩".$holz;
    //$texxt = $holz;
    $public_key = openssl_get_publickey(file_get_contents("../keys/public.pem"));
    openssl_public_encrypt($text, $encrypted, $public_key);
    $encrypted_hex = bin2hex($encrypted);
    $command = "INSERT INTO `hgu-abi-25_abizeitungDB`.`tree` (`branch`) VALUES ('".$encrypted_hex."');";
    $sql = sqlCommand($command);
        
}
?>