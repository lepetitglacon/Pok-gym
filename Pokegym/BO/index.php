<?php
@session_start(array('use_strict_mode'));
require("./config/conf.php");
require("./view/View.php");
require("./view/ViewCoponent.php");


//Verification si l'utilisateur est toujours connecté ou pas
if(!isset($_SESSION['connecter']) || ($_SESSION['connecter'] == 'connecté' && !isset($_SESSION['user']))){
    $_SESSION['connecter'] = 'déconnecté';
    header('Location:../FO/');
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
    
    case 'Administrator':
        include "./controller/ControllerAdministrator.php";
    break;


    //retour FO
    case 'Accueil':
        header('Location:../FO/?nav=Accueil');
    break;
    case 'Pokéletter':
        header('Location:../FO/?nav=Pokéletter');
    break;
    case 'Signin':
        header('Location:../FO/?nav=Signin');
    break;
    case 'Signup':
        header('Location:../FO/?nav=Signup');
    break;
    case 'Account':
        if($_SESSION['connecter'] == 'connecté'){
            header('Location:../FO/?nav=Account');
        }
        else{
            include "./controller/ControllerAccueil.php";
        }
    break;
    case 'Signout':
        header('Location:../FO/?nav=Signout');
    break;
    case 'Subscribe':
        header('Location:../FO/?nav=Signout');
    break;

    default:
        header('Location:../FO/?nav=Accueil');
    break;
}

echo $view->printPage();