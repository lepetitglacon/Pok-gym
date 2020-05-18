<?php
@session_start(array('use_strict_mode'));
require("./config/conf.php");
require("./view/View.php");
require("./view/ViewCoponent.php");

//Verification si l'utilisateur est toujours connecté ou pas
if(!isset($_SESSION['connecter']) || ($_SESSION['connecter'] == 'connecté' && !isset($_SESSION['user']))){
    $_SESSION['connecter'] = 'déconnecté';
}

//affectation de la variable - $nav pour la navigation
//affectation de la variable - $pageTitle pour la le titre de la page (titre dans le head)
if(isset($_REQUEST['nav'])){
    $nav = $_REQUEST['nav'];
    $pageTitle = $_REQUEST['nav'];
}
else{
    $nav = 'default';
    $pageTitle = 'Accueil';
}



$view = new View($pageTitle);
switch($nav){
    case 'Accueil':
        include "./controller/ControllerAccueil.php";
    break;
    case 'Pokéletter':
        include "./controller/ControllerNewsletter.php";
    break;
    case 'Signin':
        include "./controller/ControllerSignin.php";
    break;
    case 'Signup':
        include "./controller/ControllerSignup.php";
    break;
    case 'Account':
        if($_SESSION['connecter'] == 'connecté'){
            include "./controller/ControllerAccount.php";
        }
        else{
            include "./controller/ControllerAccueil.php";
        }
    break;
    case 'Signout':
        include "./controller/ControllerSignout.php";
    break;
    case 'Subscribe':
        include "./controller/ControllerSubscribe.php";
    break;
    case 'Administrator':
        header("Location:../BO/?nav=Administrator");
    break;    

    default:
        include "./controller/ControllerAccueil.php";
    break;
}

echo $view->printPage();