<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 23/05/2015
 * Time: 14:56
 */
// USED VARIABLE HERE
$mail = $_SESSION['user']['Mail'];
$nom = $_SESSION['user']['name'];
$prenom = $_SESSION['user']['FirstName'];
$tel = $_SESSION['user']['Phone'];
$userSub = $_SESSION['user']['Subcription_ID'];

$currentRDV = $RDV->getRendezvousByUser($_SESSION['user']['ID']);
$currentSub = $sub->getNameByID($userSub);
?>
<div id="account">
    <div class="parameters">
        <p class="title"><img src="view/image/accountUserIcon.png" class="icon" alt="icon">Paramètres</p>
        <p class="under-title">Identifiants</p>
        <div>
            <p class="item-identifiants">Mail : <?php echo $mail; ?></p>
            <p class="item-identifiants">Mot de passe : ****</p>
            <button class="button" id="modifyIdentifiant">Modifier</button>
        </div>
        <p class="under-title">Informations du compte</p>
        <form name="modifyIdentifiant" method="post" action="index.php?p=abonnement">
            <table>
                <tr>
                    <td class="label">Mail :</td>
                    <td><input type="text" class="champ" <?php echo 'value="'.$mail.'"' ?> name="mail" placeholder="Mail"></td>
                </tr>
                <tr class="separation"></tr>
                <tr class="ligne">
                    <td class="label">Nom :</td>
                    <td><input type="text" class="champ" <?php echo 'value="'.$nom.'"' ?> name="nom" placeholder="Nom"></td>
                </tr>
                <tr class="separation"></tr>
                <tr class="ligne">
                    <td class="label">Prénom :</td>
                    <td><input type="text" class="champ" <?php echo 'value="'.$prenom.'"' ?> name="prenom" placeholder="Prenom"></td>
                </tr>
                <tr class="separation"></tr>
                <tr class="ligne">
                    <td class="label">Téléphone :</td>
                    <td><input type="text" class="champ" <?php echo 'value="'.$tel.'"' ?> name="tel" placeholder="Téléphone (facultatif)"></td>
                </tr>
                <tr class="separation"></tr>
                <tr>
                    <td></td>
                    <td><inpu type="hidden" value="<?=$_SESSION['user']['ID']?>" name="sub"></inpu>
                        <input type="submit" class="button" value="Enregistrer"></td>
                </tr>
            </table>

        </form>
    </div>
    <div class="rightBlock">
        <div class="abonnement">
            <p class="title"><img src="view/image/accountUserAbonnement.png" class="icon" alt="icon">Agenda</p>
            <p class="under-title"><?=$currentSub['Name'] ?></p>
            <p class="text"><?=$currentSub['Desc']?></p>
            <a href="index.php?p=abonnement"><button class="button">Changer d'offre</button></a>
        </div>
        <div class="rdv">
            <p class="title"><img src="view/image/accountUserRdv.png" class="icon" alt="icon">Rendez-vous</p>
            <p class="under-title">Prochains rendez-vous</p>
            <?php
                foreach($currentRDV as $value){
                    $temp = $Service->getRendezvousByID($value['Service_ID']);
                    echo "
                        <div class=\"rdv-item\">
                            <p class=\"text\"><div class=\"circle\"></div>".$value['Date']."</p>
                            <p class=\"text\">".$temp[0]['Name']."</p>
                            <p class=\"text\">".$temp[0]['Desc']."</p>
                            <p class=\"text\">".$temp[0]['User/Price']." €</p>
                            <button class=\"button\">Annuler</button>
                        </div>
                        ";
                }
            ?>

            <div class="information">
                <p class="titleInfo">- Attention -</p>
                <p class="textInfo">
                    Toute annulation de réservation dois se faire impérativement 48h à l'avance minimum auprès du centre concerné, sous peine de payer une indemnité.<br>
                    Merci de votre compréhension.
                </p>
            </div>
        </div>
        <div class="agenda">
            <p class="title"><img src="view/image/accountUserAgenda.png" class="icon" alt="icon">Agenda</p>
            <iframe src="https://www.google.com/calendar/embed?src=<?=$mail?>&ctz=Europe/Paris" style="border: 0" width="780" height="380" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>
</div>
