<?php

/**
* ajoute un message en session
*/
function addMessageFlash($type, $message)
{
    // on ajoute le message
    if (in_array($type, ['error', 'success', 'warning']))
        $_SESSION['flashBag'][$type]['message'] = $message;
    return true;
}

/**
* recupére un message en session
*/
function getMessageFlash()
{
    // on retourne le message si il existe
    $temp = [];
    foreach($_SESSION['flashBag'] as $type => $message) {
        $temp[$type] = $message;
    }
    return $temp;
}

/**
* fonction de redirection
*/
function go($url, $time)
{
    die('<meta http-equiv="refresh" content="'.$time.'; url='.$url.'">');
}
