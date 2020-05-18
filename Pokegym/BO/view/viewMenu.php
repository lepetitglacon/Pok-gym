<?php

class viewMenu implements ViewCoponent {
    public function __construct() {
    }

    public function setRubrique($rubrique){
      $this->rubrique = $rubrique;
    }

    public function setRubriqueArticle($rubrique){
      $this->rubriqueArticle = $rubrique;
    }

    public function getArticleTitle(){

    }

    public function giveHTML()
    {

        ob_start();//capture tous les flux http vers un tampon en mémoire
        ?>

        <header>
        <nav class="container-fluid navbar navbar-expand-xl navbar-light bg-light p-0" id="menu">
  <a class="navbar-brand" href="?nav=Accueil">Pokégym.sh</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="?nav=Accueil">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?nav=Pokéletter">Pokéletter</a>
      </li>
      
      
    <?php for($i=0;$i<count($this->rubrique);$i++) {?>
      <?php if($this->rubrique[$i]['dropdown'] == null) {?>
      <li class="nav-item">
        <a class="nav-link" href="?nav=<?=$this->rubrique[$i]['title']?>"><?=$this->rubrique[$i]['title']?></a>
      </li>
      <?php }else{?>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <?=$this->rubrique[$i]['title']?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php foreach($this->rubriqueArticle as $key => $value) {?>
          <?php if($value['title'] == $this->rubrique[$i]['title']) {?>
            <a class="dropdown-item" href="?nav=<?=$value['atitle']?>"><?=$value['atitle']?></a>
          <?php }?>
          <?php }?>
        </div>
      </li>

        <?php }?>
    <?php }?>
</ul>








    <?php if($_SESSION['connecter'] == 'déconnecté'){?>
      <form class="form-inline my-8 my-lg-0">
        <input type="hidden" name="nav" value="Signup">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">S'inscrire</button>
    </form>
    <form class="form-inline my-8 my-lg-0">
        <input type="hidden" name="nav" value="Signin">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Se connecter</button>
    </form>
    <?php }else{
      if($_SESSION['connecter'] == 'connecté' && ($_SESSION['user'][0]['bo'] == 2 || $_SESSION['user'][0]['bo'] == 1)){?>
      <form class="form-inline my-8 my-lg-0">
        <input type="hidden" name="nav" value="Administrator">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Administration</button>
    </form>
      <form class="form-inline my-8 my-lg-0">
        <input type="hidden" name="nav" value="Account">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Mon compte</button>
      </form>
    <form class="form-inline my-8 my-lg-0">
        <input type="hidden" name="nav" value="Signout">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Se déconnecter</button>
    </form>
    <?php }
    else{?>
     <form class="form-inline my-8 my-lg-0">
        <input type="hidden" name="nav" value="Account">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Mon compte</button>
      </form>
    <form class="form-inline my-8 my-lg-0">
        <input type="hidden" name="nav" value="Signout">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Se déconnecter</button>
    </form>
    }
     
      
      <?php } }?>
  </div>
</nav>
</header>
<?php 

         
        $str = ob_get_contents();
        ob_end_clean();
        return $str;

    }
}
