<?php
	require_once("./model/Model.php");
	require_once("./model/ModelAccueil.php");
	include_once("./view/viewMenu.php");
    include_once("./view/viewAccueil.php");
	
	$view->menu = new viewMenu();
	$view->content = new viewAccueil();
	$model = new modelAccueil();

	$error = array();

	$view->content->setError($error);
	

	
	$view->menu->setRubrique($model->getRubrique());
	$view->menu->setRubriqueArticle($model->getRubriqueArticle());
	
	$view->content->getSubs($model->getAllSub());
	$view->content->getCOMMENT($model->getAllCommentsUser());
?>