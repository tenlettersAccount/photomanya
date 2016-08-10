<?php
session_start();
$_SESSION['contact_updater_message'] = null;

$tel   = trim($_POST['tel']);
$city  = trim($_POST['city']);
$addr  = trim($_POST['addr']);
$email = trim($_POST['email']);

$jsonFile = './contacts/contactsData.json';
$contactsOldData = json_decode(file_get_contents($jsonFile, JSON_UNESCAPED_UNICODE));


$contactData = array(
    'tel'   => $tel,
    'city'  => $city,
    'addr'  => $addr,
    'email' => $email
);


$newData = array();

if( !empty($tel) )
{
    $newData['tel'] = $tel;
    $newData['city'] = $contactsOldData->city;
    $newData['addr'] = $contactsOldData->addr;
    $newData['email'] = $contactsOldData->email;
    file_put_contents( $jsonFile, json_encode($newData, JSON_UNESCAPED_UNICODE) );  
    $_SESSION['contact_updater_message'] = "Телефон успешно изменен!";
}
if( !empty($addr) )
{
    $newData['tel'] = $contactsOldData->tel;
    $newData['city'] = $contactsOldData->city;
    $newData['addr'] = $addr;
    $newData['email'] = $contactsOldData->email;
    file_put_contents( $jsonFile, json_encode($newData, JSON_UNESCAPED_UNICODE) ); 
    $_SESSION['contact_updater_message'] = "Адрес успешно изменен!";
}
if( !empty($email) )
{
    $newData['tel'] = $contactsOldData->tel;
    $newData['city'] = $contactsOldData->city;
    $newData['addr'] = $contactsOldData->addr;
    $newData['email'] = $email;
    file_put_contents( $jsonFile, json_encode($newData, JSON_UNESCAPED_UNICODE) );  
    $_SESSION['contact_updater_message'] = "Email успешно изменен!";
}
if( !empty($city) )
{
    $newData['tel'] = $contactsOldData->tel;
    $newData['city'] = $city;
    $newData['addr'] = $contactsOldData->addr;
    $newData['email'] = $contactsOldData->email;
    file_put_contents( $jsonFile, json_encode($newData, JSON_UNESCAPED_UNICODE) );  
    $_SESSION['contact_updater_message'] = "Город успешно изменен!";
}

// tel && city
if( !empty($tel) &&  !empty($city) ){
    $newData['tel'] = $tel;
    $newData['city'] = $city;
    $newData['addr'] = $contactsOldData->addr;
    $newData['email'] = $contactsOldData->email;
    file_put_contents( $jsonFile, json_encode($newData, JSON_UNESCAPED_UNICODE) ); 
    $_SESSION['contact_updater_message'] = "Телефон и город успешно изменены!";
}
// city && addr 
if( !empty($city) &&  !empty($addr) ){
    $newData['tel'] = $contactsOldData->tel;
    $newData['city'] = $ity;
    $newData['addr'] = $addr;
    $newData['email'] = $contactsOldData->email;
    file_put_contents( $jsonFile, json_encode($newData, JSON_UNESCAPED_UNICODE) ); 
    $_SESSION['contact_updater_message'] = "Город и адрес успешно изменены!";
}
// city && email
if( !empty($city) &&  !empty($email) ){
    $newData['tel'] = $contactsOldData->tel;
    $newData['city'] = $city;
    $newData['addr'] = $contactsOldData->addr;
    $newData['email'] = $email;
    file_put_contents( $jsonFile, json_encode($newData, JSON_UNESCAPED_UNICODE) ); 
    $_SESSION['contact_updater_message'] = "Город и email успешно изменены!";
}


// tel && addr
if( !empty($tel) &&  !empty($addr) )
{
    $newData['tel'] = $tel;
    $newData['city'] = $contactsOldData->city;
    $newData['addr'] = $addr;
    $newData['email'] = $contactsOldData->email;
    file_put_contents( $jsonFile, json_encode($newData, JSON_UNESCAPED_UNICODE) ); 
    $_SESSION['contact_updater_message'] = "Телефон и адрес успешно изменены!";
}
// addr && mail
if( !empty($addr) &&  !empty($email)  )
{
    $newData['tel'] = $contactsOldData->tel;
    $newData['city'] = $contactsOldData->city;
    $newData['addr'] = $addr;
    $newData['email'] = $email;
    file_put_contents( $jsonFile, json_encode($newData, JSON_UNESCAPED_UNICODE) ); 
    $_SESSION['contact_updater_message'] = "Адрес и email успешно изменены!";
}

// tel && mail
if( !empty($tel) && !empty($email) )
{
    $newData['tel'] = $tel;
    $newData['city'] = $contactsOldData->city;
    $newData['addr'] = $contactsOldData->addr;
    $newData['email'] = $email;
    file_put_contents( $jsonFile, json_encode($newData, JSON_UNESCAPED_UNICODE) ); 
    $_SESSION['contact_updater_message'] = "Телефон и email успешно изменены!";
}

// all
if( !empty($tel) &&  !empty($addr) && !empty($email) && !empty($city))
{
    file_put_contents( $jsonFile, json_encode($contactData, JSON_UNESCAPED_UNICODE) ); 
    $_SESSION['contact_updater_message'] = "Телефон, город, адрес и email успешно изменены!";
}

$location = 'Location: '.$_SERVER['HTTP_REFERER'];
header($location);
    
    





?>