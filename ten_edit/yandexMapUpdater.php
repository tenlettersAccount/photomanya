<?php
session_start();
$_SESSION['yandexMapMessage'] = null;
    
$script = trim($_POST['yandexMapScript']);
$jsonFile = './contacts/yandexMapScript.json';

$scriptArray = array(
    'mapScript' => $script
);

if(!empty($script)){
    file_put_contents( $jsonFile, json_encode($scriptArray, JSON_UNESCAPED_UNICODE) ); 
    $_SESSION['yandexMapMessage'] = "Координаты карты успешно обновлены!";
}
$location = 'Location: '.$_SERVER['HTTP_REFERER'];
header($location);
    
?>