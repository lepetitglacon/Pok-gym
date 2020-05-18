<?php
	require_once("./model/Model.php");
	require_once("./model/ModelSignup.php");
	include_once("./view/viewMenu.php");
    include_once("./view/viewSignup.php");
	
	$view->menu = new viewMenu();
	$view->content = new viewSignup();
	$model = new modelSignup();

	$view->menu->setRubrique($model->getRubrique());
	$view->menu->setRubriqueArticle($model->getRubriqueArticle());

	$error = array();
	$nom = '';
	$password1 = '';
	$password2 = '';

	$view->content->setPhrase('');
	

	if(isset($_POST['action'])){
		//----------erreurs/vérifications----------
		(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty($_POST['email'])) ? $error['email'] = 'Entrez une adresse correcte' : $email = $_POST['email'];
		(empty($_POST['nom'])) ? $error['nom'] = 'Entrez un nom correcte' : $nom = $_POST['nom'];
		(empty($_POST['prenom'])) ? $error['prenom'] = 'Entrez un prénom correcte' : $prenom = $_POST['prenom'];
		(empty($_POST['password'])) ? $error['password'] = 'Entrez un password correcte' : $password1 = password_hash($_POST["password"],PASSWORD_DEFAULT);
		(empty($_POST['password2'])) ? $error['2ème password'] = 'Entrez un 2ème password correcte' : $password2 = $_POST["password2"];
		
		(!password_verify($password2,$password1)) ? $error['valeurs'] = 'Les mots de passe ne sont pas identiques' : '';

		if(empty($error)){
			if(!empty($model->getUserByMail($_POST['email']))){
				$testMail = $model->getUserByMail($_POST['email']);
				if(!empty($testMail[0]['password'])){
					$_SESSION['signup']['info'] = 'alert alert-warning';
					$view->content->setPhrase('!! L\'utilisateur existe déjà !!');
				}
				else{
					if($model->createUserFromMail($nom,$prenom,$password1,$email)){
						$_SESSION['signup']['info'] = 'alert alert-success';
						$view->content->setPhrase('Utilisateur crée depuis l\'adresse '.$_POST['email']);
					}
					else{
						$view->content->setPhrase('Oups il y\'a eu un problème 1');
					}
				}
				
				
			}
			else{
				if($model->createUser($nom,$prenom,$password1,$email)){
					$_SESSION['signup']['info'] = 'alert alert-success';
					$view->content->setPhrase('Utilisateur crée');
				}
				else{
					$view->content->setPhrase('Oups il y\'a eu un problème 2');
				}
				
			}
		}
	}

	$view->content->setError($error);
?>