<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 20/05/2015
 * Time: 18:22
 */

if (session_status() === PHP_SESSION_ACTIVE) { // si la session est active
    $_SESSION = []; // on supprime la clé 'user' du tableau SESSION
    addMessageFlash('success', 'Vous avez été deconnecté avec succès');
    go('index.php', 0);
}