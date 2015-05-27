<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 24/05/2015
 * Time: 11:27
 */
?>
<div class="headerContact">
    <div class="box">
        <p class="title">Contact</p>
    </div>
</div>
<div id="formContactBloc">
    <div class="text">
        <p class="title">Une question ?</p>
        <p class="">Si vous avez besoin d’un renseignement ou voulez nous contacter sur nos différentes offres, vous pouvez !</p>
    </div>
    <div class="form">
        <p class="title">Nous contacter</p>
        <form name="contact" action="index.php?p=contact" method="post">
            <input type="text" name="name" class="champ inline" placeholder="Votre nom">
            <input type="text" name="mail" class="champ inline" placeholder="Votre mail">
            <input type="text" name="subject" class="champ block" placeholder="Sujet">
            <textarea class="textarea" name="text" placeholder="Votre message ..."></textarea>
            <input type="submit" name="valider" value="Envoyer" class="button">
        </form>
    </div>
    <div class="adress">
        <p class="title"><img src="view/image/location.png" class="icon" alt="location">Paris, 19e</p>
        <p class="text">35 rue des hormes 01.32.64.35.27</p>
    </div>
</div>