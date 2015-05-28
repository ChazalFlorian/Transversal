<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 17/05/2015
 * Time: 18:37
 */
if (isset($_SESSION['user'])) {
    go('index.php', 0);
}
if (!empty($_POST)) {
    if ($_POST['hidden'] === 'subscription') {
        $_POST['radio'] = (int) $_POST['radio'];

        $nbUser = $user->countUserByMail($_POST['mail']);

        if (isset($nbUser) && $nbUser == 0) {
            $user->addUser($_POST);
            $_SESSION['user'] = $user->getUserByMailAndPassword($_POST['mail'], $_POST['password']);
            addMessageFlash('success', 'Inscription réussie, bienvenue '.$_POST['firstName']);
            if(isset($_SESSION['abonnement'])){
                go('index.php?p=abonnement', 0);
            }else{
                go('index.php', 0);
            }
        } else {
            addMessageFlash('error', 'Cet identifiant est déjà pris');
            go('?p=identify', 0);
        }
    } else if ($_POST['hidden'] === 'login') {
        $result = $user->getUserByMailAndPassword($_POST['mail'], $_POST['password']);
        if ($result) {
            $_SESSION['user'] = $result;
            addMessageFlash('success', 'Vous êtes maintenant connecté en tant que '.$_SESSION['user']['FirstName']);
            if(isset($_SESSION['abonnement'])){
                go('index.php?p=abonnement', 0);
            }else{
                go('index.php', 0);
            }
        } else {
            addMessageFlash('error', 'Les identifiants sont incorrects');
            go('index.php?p=identify', 0);
        }
        unset($_POST['password'], $_POST['password_verif']);
    }

}


?>
<div id="identify">
    <div id="login">
        <p class="title">Identifiez-vous ici ..</p>
        <form name="login" method="post" action="index.php?p=identify">
            <input type="text" class="champ noError" name="mail" placeholder="Adresse mail" autofocus>
            <input type="password" class="champ" name="password" placeholder="Mot de passe">
            <div class="error"></div>
            <input type="hidden" name="hidden" value="login">
            <input type="submit" class="button" value="Connexion">
        </form>
    </div>
    <div id="separation"></div>
    <div id="subscription">
        <p class="title">.. ou inscrivez-vous là</p>
        <form name="subscription" method="post" action="index.php?p=identify">
            <input type="text" class="champ" id="subLastName" name="lastName" placeholder="Nom">
            <div class="error" id="errLastName"></div>
            <input type="text" class="champ" name="firstName" placeholder="Prénom">
            <div class="error" id="errFirstName"></div>
            <input type="text" class="champ" name="mail" id="champMail" placeholder="Adresse mail">
            <div class="error" id="errMail"></div>
            <input type="text" class="champ" name="tel" placeholder="Téléphone (facultatif)">
            <div class="error" id="errTel"></div>
            <input type="password" class="champ" name="password" placeholder="Mot de passe">
            <div class="error" id="errPass"></div>
            <input type="password" class="champ" name="password_verif" placeholder="Vérification du mot de passe">
            <div class="error" id="errVerif"></div>
            <div class="radioButton">
                <input id="radio1" type="radio" name="radio" value=1>
                <label for="radio1" class="radioLabel"><span><span></span></span>Utilisateur</label>
            </div>
            <div class="radioButton">
                <input id="radio2" type="radio" name="radio" value=2>
                <label for="radio2" class="radioLabel"><span><span></span></span>Partenaire</label>
            </div>
            <div class="error" id="errType"></div>
            <input type="hidden" name="hidden" value="subscription">
            <input type="submit" class="button" value="Inscription">
        </form>
    </div>
</div>
<script type="text/javascript" src="view/js/formVerify.js"></script>
