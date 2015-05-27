<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 12/05/2015
 * Time: 15:04
 */

session_start();

//affiche les erreurs
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

// require_once __DIR__.'/controller/autoload.php';

require_once __DIR__.'/model/User.php';
require_once __DIR__.'/model/Connection.php';
require_once __DIR__.'/model/RendezVous.php';
require_once __DIR__.'/model/Partner.php';
require_once __DIR__.'/model/Subcription.php';
require_once 'model/function.php';

$user = new \model\User(Connection::getConnection());
$RDV = new model\Rendezvous(Connection::getConnection());
$partner = new model\Partner(Connection::getConnection());
$sub = new model\Subcription(Connection::getConnection());

// Liste blanche, c'est notre routing qui correspont à nos pages
$routing = [
    'home' => [
        'controller' => 'home',
        'secure' => false
    ],
    'identify' => [
        'controller' => 'identify',
        'secure' => false
    ],
    'logout' => [
        'controller' => 'logout',
        'secure' => true
    ],
    'profil' => [
        'controller' => 'profil',
        'secure' => true
    ],
    'account' => [
        'controller' => 'account',
        'secure' => true
    ],
    'partner' => [
        'controller' => 'partner',
        'secure' => false
    ],
    'contact' => [
        'controller' => 'contact',
        'secure' => false
    ]
];

// verifions la pertinance de la page en GET
if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    //page par defaut
    $page = 'home';
}
//check pour la sécurité : si la page à la clée 'secure' est true et que $_SESSION['name'] n'est pas définis
if ($routing[$page]['secure'] === true && !isset($_SESSION['user'])) {
    //Met en session un message informatif
    addMessageFlash('warning', 'Veuillez vous connecter afin d\'accéder à cette page');
    //redirection
    header("location: index.php?p=identify");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Site d'EasyRelax">
    <meta name="author" content="EasyRelax Developpers team">
    <link rel="stylesheet" type="text/css" href="view/css/reset.css">
    <link rel="stylesheet" type="text/css" href="view/css/style.css">
    <link rel="stylesheet" type="text/css" href="view/css/stylesheet-pure-css.css">
    <link rel="icon" type="image/png" href="view/image/iconsite.png">
    <script src="view/js/jquery-2.1.4.min.js"></script>
    <script src="view/js/jquery.mousewheel.min.js"></script>
    <script src="view/js/jquery.visible.min.js"></script>
    <script type="text/javascript" src="view/js/jquery.carouFredSel-6.2.1.js"></script>
    <script src="view/js/script.js"></script>
    <title>EasyRelax</title>
</head>
<body>
<div id="menu">
    <img src="view/image/logo.png" id="logo" alt="logo">
    <h1 class="title">EasyRelax</h1>
    <?php // message Flash
    if (isset($_SESSION['flashBag'])) {
        $message = getMessageFlash();
        unset($_SESSION['flashBag']);
        foreach($message as $type => $value) {
            echo "<p class='".$type." messageFlash'>".$value['message']."</p>";
        }
    }
    ?>
    <ul id="menu-item">
        <a href="index.php?p=home" class="menu-link"><li class="element">Accueil</li></a>
        <a href="index.php?p=home#offres" class="menu-link"><li class="element">Nos offres</li></a>
        <a href="index.php?p=partner" class="menu-link"><li class="element">Partenaires</li></a>
        <a href="index.php?p=contact" class="menu-link"><li class="element">Contact</li></a>
        <?php if (isset($_SESSION['user'])) {
            ?>
            <a href="#" class="menu-link" id="loadMenu"><li class="element"><?php echo $_SESSION['user']['FirstName'];?><img src="view/image/user-icon.png" alt="user icon" id="user-icon"></li></a>
            <?php
        } else {
            ?>
            <a href="index.php?p=identify" class="menu-link" id="logbutton"><li class="element">S'identifier<img src="view/image/user-icon.png" alt="user icon" id="user-icon"></li></a>
            <?php
        }
        ?>
    </ul>
    <div id="accountMenu">
        <a href="index.php?p=account"><div class="item"><img src="view/image/settings.png" class="icon iconParam" alt="parametres">Mon compte</div></a>
        <div class="separation"></div>
        <a href="index.php?p=logout"><div class="item logout"><img src="view/image/logout.png" class="icon" alt="logout">   Déconnexion</div></a>
    </div>
</div>
<?php
// Charge la page demandée
$fileController = 'controller/'.$routing[$page]['controller'].'.php';
if (file_exists($fileController))
    require $fileController;
else
    echo 'File is missing';
?>
</body>
</html></html>