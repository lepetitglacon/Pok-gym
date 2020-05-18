<?php
	require_once("./model/Model.php");
	require_once("./model/ModelAccount.php");
	include_once("./view/viewMenu.php");
    include_once("./view/viewAccount.php");
	
	
	

	$view->menu = new viewMenu();
	$view->content = new viewAccount();
	$model = new modelAccount();
	
	$_SESSION['user'] = $model->getUserById($_SESSION['user'][0]['id']);
	
	

	$view->menu->setRubrique($model->getRubrique());
	$view->menu->setRubriqueArticle($model->getRubriqueArticle());

	$error = array();

	


	(isset($_REQUEST['innernav'])) ? $innernav = $_REQUEST['innernav'] : $innernav = '';
	$view->content->setInnerNav($innernav);


	if(isset($_REQUEST['innernav'])){
		$innernav = $_REQUEST['innernav'];

		switch ($innernav) {
			case 'Abonnement':
				$abonnement = $model->getUserUSERSUB(($_SESSION['user'][0]['id']));
				if(empty($abonnement)){
					$view->content->setPhrase('Vous n\'avez pas d\'abonnement');
				}
				else{
					$view->content->setData($abonnement);
					$view->content->setPhrase('Vous avez ces abonnements');
					
				}
				
			break;
			case 'Mes Infos':

				if(isset($_POST['Enregistrer'])){
					if($_POST['Enregistrer'] == 'Enregistrer'){
						$mail = $_POST['email'];
						if($model->updateUserMail($_SESSION['user'][0]['id'],$mail)){
							$view->content->setPhrase('Réussi');
							$_SESSION['user'] = $model->getUserById($_SESSION['user'][0]['id']);
						}
						else{
							$view->content->setPhrase('Problème');
						}
					}

					if($_POST['Enregistrer'] == 'Enregistrer nouveau mot de passe'){
						
						if(!password_verify($_POST['oldpassword'],$_SESSION['user'][0]['password'])){
							$view->content->setPhrase('!! Mauvais ancien mot de passe !!');
						}
						else{

							$newpassword = password_hash($_POST["newpassword"],PASSWORD_DEFAULT);

							if(!password_verify($_POST['newpassword2'],$newpassword)){
								$view->content->setPhrase('!! Les nouveaux mots de passe ne correspondent pas !!');
							}
							else{
								if($model->updateUserPassword($_SESSION['user'][0]['id'],$newpassword)){
									$view->content->setPhrase('Nouveau mot de passe enregistré');
									$_SESSION['user'] = $model->getUserById($_SESSION['user'][0]['id']);
								}
								else{
									$view->content->setPhrase('Problème d\'enregistrement');
								}
							}
						}
					}
				}
				
			break;
			case 'Commenter':
					$_SESSION['account']['info'] = 'alert-info';
					$view->content->setPhrase('!! une Baie Pêcha en récompense !!');

					if(isset($_SESSION['commentaire']) && $_SESSION ['commentaire'] == 'posté'){
						$_SESSION['account']['info'] = 'alert-success';
						$view->content->setPhrase('!! Vous avez reçu : Baie Pêcha x1 !!');
					}


				if(isset($_POST['comment'])){

					
					
					if(strlen($_POST['textarea']) > 255 || empty($_POST['textarea'])){
						$_SESSION['account']['info'] = 'alert-danger';
						$view->content->setPhrase('!! Le commentaire n\'est pas conforme !!');
					}
					else{
						$commentaire = $_POST['textarea'];
						if($model->insertComment($_SESSION['user'][0]['id'],$commentaire)){
							$_SESSION['commentaire'] = 'posté';
							$view->content->setPhrase('Vous avez posté un commentaire');
						}
						else{
							$view->content->setPhrase('!! Il y a eu un problème !!');
						}
								

							
							
						
					}
				}
				
				

				
				
			break;
			default:
				break;
		}


		
	}
	else{
		$innernav = '';
	}

	
	
	
	
	$view->content->setError($error);
?>