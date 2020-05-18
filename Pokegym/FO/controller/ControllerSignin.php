<?php
	require_once("./model/Model.php");
	require_once("./model/ModelSignin.php");
	include_once("./view/viewMenu.php");
	include_once("./view/viewSignin.php");
	
	$view->menu = new viewMenu();
	$view->content = new viewSignin();
	$model = new modelSignin();

	$view->menu->setRubrique($model->getRubrique());
	$view->menu->setRubriqueArticle($model->getRubriqueArticle());

	$error = array();

	if(isset($_POST['action'])){
		(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty($_POST['email'])) ? $error['email'] = 'Entrez une adresse correcte' : $email = $_POST['email'];
		(empty($_POST['password'])) ? $error['password'] = 'Entrez un password correcte' : $password = $_POST["password"];
		
		if(empty($error)){
			if(empty($model->getUserByMail($email)) || empty($model->getUserByMail($email)[0]['password'])){
				$_SESSION['signin']['info'] = 'alert alert-danger';
				$view->content->setPhrase('!! Utilisateur Inconnu !!');
			}
			else{
				if (!password_verify($password,$model->getUserByMail($email)[0]['password'])) {
					$_SESSION['signin']['info'] = 'alert alert-warning';
					$view->content->setPhrase('!! Mauvais mot de passe !!');
				}
				else{
					$_SESSION['signin']['info'] = 'alert alert-success';
					$_SESSION['connecter'] = 'connecté';
					$_SESSION['user'] = $model->getUserBymail($email);
					if($_SESSION['user'][0]['bo'] == 2 || $_SESSION['user'][0]['bo'] == 1){
						header('Location:../BO/');
					}
					else{
						header('Location:?nav=Account');
					}
					
					
				}
			}
			
		}
	}

	$view->content->setError($error);
	
?>