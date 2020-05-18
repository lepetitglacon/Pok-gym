<?php
	require_once("./model/Model.php");
	require_once("./model/ModelNewsletter.php");
    include_once("./view/viewMenu.php");
	include_once("./view/viewNewsletter.php");

	$view->menu = new viewMenu();
	$model = new modelNewsletter();
	$view->content = new viewNewsletter();

	$view->menu->setRubrique($model->getRubrique());
	$view->menu->setRubriqueArticle($model->getRubriqueArticle());

	$error = array();
	
	if(isset($_SESSION['newsletter'])){
		$_SESSION['newsletter']['info'] = 'warning';
		$view->content->setPhrase('Vous avez déjà inscrit une adresse');
	}
	else{
		$_SESSION['newsletter']['info'] = 'info';
		$view->content->setPhrase('Inscrivez vous à la Pokéletter');
	}

	if(isset($_POST['action'])){
		$action = $_POST['action'];
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || $_POST['email'] == ''){
			$view->content->setPhrase('!! Entrez une adresse correcte !!');
			$_SESSION['newsletter']['info'] = 'danger';
		}
		else{
			switch($action){
				case 'S\'inscrire':
					$testMail = $model->getUserByMail($_POST['email']);
					if(!empty($testMail)){
						if($testMail[0]['newsletter'] === '1'){
							$_SESSION['newsletter']['info'] = 'warning';
							$view->content->setPhrase('!! L\'adresse '.$_POST['email'].' est déja inscrite à la Pokéletter !!');
						}
						else{
							$model->updateUserNewsletter1($testMail[0]['id']);
							$_SESSION['newsletter']['info'] = 'success';
							$view->content->setPhrase('!! L\'adresse '.$_POST['email'].' à bien été mise à jour !!');
						}
						
						
						
					}
					else{
						if($model->createUserNewsletter1($_POST['email'])){
						$_SESSION['newsletter']['info'] = 'success';
						$view->content->setPhrase('!! Vous venez d\'inscrire l\'adresse '.$_POST['email'].' à la Pokéletter !!');
						$_SESSION['newsletter']['inscrit'] = 'inscrit';
						
						}
						else{
							$view->content->setPhrase('Oups il y\'a eu un problème');
							$_SESSION['newsletter']['info'] = 'danger';
						}
					}
					
					
					
				break;
				case 'Se désinscrire':
					$testMail = $model->getUserByMail($_POST['email']);
					if(!empty($testMail)){
						if($testMail[0]['newsletter'] === '0'){
							$_SESSION['newsletter']['info'] = 'warning';
							$view->content->setPhrase('!! L\'adresse '.$_POST['email'].' n\'est pas inscrite à la Pokéletter !!');
						}
						else{
							$model->updateUserNewsletter0($testMail[0]['id']);
							$_SESSION['newsletter']['info'] = 'success';
							$view->content->setPhrase('!! L\'adresse '.$_POST['email'].' à bien été mise à jour !!');
						}
						
						
						
					}
					else{
						$_SESSION['newsletter']['info'] = 'danger';
						$view->content->setPhrase('!! L\'adresse n\'existe pas  !!');
					}
				break;
				default:
					
				break;

			}
		}
		
	}
	

	$view->content->setError($error);



	





?>