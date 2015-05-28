<?php
$AllSub = $sub->getAllSubcription();
if(isset($_SESSION['user'])){
    $currentSub = $sub->getNameByID($_SESSION['user']['Subcription_ID']);
}else{
    $_SESSION['abonnement'] = $_GET['v'];
    go("index.php?p=identify",0);
}
if(isset($_POST['radio'])){
    $user->setUserSubscription($_SESSION['user']['ID'],$_POST['radio']);
    go("index.php", 0);
}
?>
<div class="abonnement">
    <p class="title">Choisissez votre abonnement</p>
    <form action="#" method="post" name="form-abo">
        <?php
        var_dump($_SESSION['abonnement']);
        var_dump($_GET['v']);
        foreach($AllSub as $value){
            if(isset($_SESSION['abonnement']) && $_SESSION['abonnement'] == $value['ID']){
                echo "
            <div class=\"radioButton abonnementChange\">
                <img src=\"view/image/abo".$value['ID'].".png\" alt=\"photo".$value['ID']."\">
                <input id=\"radio".$value['ID']."\" type=\"radio\" name=\"radio\" value=\"".$value['ID']."\" checked=\"true\">
                <label for=\"radio".$value['ID']."\" class=\"radioLabel\"><span><span></span></span>".$value['Name']."</label>
                <p class=\"text\">".$value['Desc'] ."</p>
            </div>
            ";
            }else if(isset($currentSub) && $currentSub['ID'] == $value['ID']){
                echo "
            <div class=\"radioButton abonnementChange\">
                <img src=\"view/image/abo".$value['ID'].".png\" alt=\"photo".$value['ID']."\">
                <input id=\"radio".$value['ID']."\" type=\"radio\" name=\"radio\" value=\"".$value['ID']."\" checked=\"true\">
                <label for=\"radio".$value['ID']."\" class=\"radioLabel\"><span><span></span></span>".$value['Name']."</label>
                <p class=\"text\">".$value['Desc'] ."</p>
            </div>
            ";
            }else{
                echo "
            <div class=\"radioButton abonnementChange\">
                <img src=\"view/image/abo".$value['ID'].".png\" alt=\"photo".$value['ID']."\">
                <input id=\"radio".$value['ID']."\" type=\"radio\" name=\"radio\" value=\"".$value['ID']."\">
                <label for=\"radio".$value['ID']."\" class=\"radioLabel\"><span><span></span></span>".$value['Name']."</label>
                <p class=\"text\">".$value['Desc'] ."</p>
            </div>
            ";
            }
        }
        ?>
        <input type="submit" class="button">
    </form>
</div>