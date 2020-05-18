<?php
	require_once("./model/Model.php");
	require_once("./model/ModelAdministrator.php");
	include_once("./view/viewMenu.php");
    include_once("./view/viewAdministrator.php");
	
	$view->menu = new viewMenu();
	$view->content = new viewAdministrator();
	$model = new modelAdministrator();

	$view->menu->setRubrique($model->getRubrique());
	$view->menu->setRubriqueArticle($model->getRubriqueArticle());

	$error = array();

	if(isset($_REQUEST['adminnav'])){
		$adminnav = $_REQUEST['adminnav'];
		$view->content->setInnerNav($adminnav);
	}
	else{
		$adminnav = 'default';
		$view->content->setInnerNav($adminnav);
	}

	

	switch ($adminnav) {
		case 'Comptes':
			
			$view->content->setData($model->getAllUserWithoutPassword());
			if(isset($_POST['Supprimer'])){
				$view->content->setData($model->getAllUserWithoutPassword());
			}

			if(isset($_POST['Enregistrer'])){
				print_r(count($model->getUserAdministrator()));
				if(count($model->getUserAdministrator()) <= 1 && ($_POST['bo'] == 0 || $_POST['bo'] == 1)){
					$view->content->setPhrase('!! Impossible il ne reste qu\'1 administrateur !!');
				}
				else{
					$model->updateUserBo($_POST['id'],$_POST['bo']);
					$view->content->setData($model->getAllUserWithoutPassword());
					$_SESSION['user'] = $model->getUserById($_SESSION['user'][0]['id']);
				}
				
			}

			if(isset($_POST['Supprimer'])){

				if(count($model->getUserAdministrator()) <= 1){
					$view->content->setPhrase('!! Impossible il ne reste qu\'un administrateur !!');
				}
				else{
					$model->deleteUser($_POST['id']);
					$view->content->setData($model->getAllUserWithoutPassword());
					$_SESSION['user'] = $model->getUserById($_SESSION['user'][0]['id']);
				}
			}
		break;

		case 'Rubriques':

			if(isset($_POST['addrubrique']) && !empty($_POST['rubrique'])){

				if($model->getAllRubriqueName())
				
				if(empty($_POST['checkbox'])){
					$checkbox = null;
				}
				else{
					$checkbox = $_POST['checkbox'];
				}
				
				if($model->insertRubrique($_POST['rubrique'],$checkbox)){
					$view->menu->setRubrique($model->getRubrique());
					$view->menu->setRubriqueArticle($model->getRubriqueArticle());
				}
			}
			else{
				$view->content->setPhrase('Rubrique manquante');
			}
		break;	

		case 'Articles':
				$view->menu->setRubrique($model->getRubrique());
				$view->menu->setRubriqueArticle($model->getRubriqueArticle());

			if(isset($_POST['addrubrique']) && !empty($_POST['rubrique'])){

				if($model->getAllRubriqueName())
				
				if(empty($_POST['checkbox'])){
					$checkbox = null;
				}
				else{
					$checkbox = $_POST['checkbox'];
				}
				
				if($model->insertRubrique($_POST['rubrique'],$checkbox)){
					$view->menu->setRubrique($model->getRubrique());
					$view->menu->setRubriqueArticle($model->getRubriqueArticle());
				}
			}
			else{
				$view->content->setPhrase('Rubrique manquante');
			}
		break;

		case 'Commentaires':
			$view->content->setData($model->getAllCommentsUser());


			if(isset($_POST['Supprimer'])){
				if($model->deleteComment($_POST['id'])){
					$view->content->setPhrase("Supprimé");
					$view->content->setData($model->getAllCommentsUser());
				}
				
			}
		break;

		case 'Newsletter':
			$view->content->setData($model->getAllUserNewsletter());

			if(isset($_POST['Supprimer'])){
				if($model->updateUserNewsletter0($_POST['id'])){
					$view->content->setData($model->getAllUserNewsletter());
				}
			}

		
		break;
		

		
		default:
			break;
	}


	

	
	
	
	
	$view->content->setError($error);
?>