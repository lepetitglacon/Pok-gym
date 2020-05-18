<?php
class viewAccueil implements ViewCoponent{

    public function __construct(){
    }

    public function getSubs($subs){
        $this->subs = $subs;
    }

    public function getCOMMENT($comments){
        $this->comments = $comments;
    }

    public function setError($error){
        $this->error = $error;
    }

    public function giveHTML(){
        ob_start();
        
        if(!empty($this->error)){
            echo '<pre class="alert alert-warning">';
            foreach ($this->error as $error => $errorValue) {
                echo '<p>L\'erreur est '.$error.'. Raison : '.$errorValue;
            }
            echo '</pre>';
        } 
    ?>
        <div class="container-fluid p-0">
            <div id="map" class="container-fluid">
                <h1 id="pagetitle">Pokégym Sinnoh</h1>
            </div>
            <div class="container" id="intro">
                <h1 class="text-center mb-5">Bienvenue sur Pokégym.Sh</h1>
                <h3 class="text-center mb-5">Le site des Pokégyms de Sinnoh !</h3>
                <h5 class="text-center">Vous retrouverez toutes les informations des Pokégyms sur ce site.</h5>
                <h3 class="text-center mt-5">Allez je te choisis !</h3>
            </div>
            <div class="container-fluid d-flex justify-content-around">
            <?php for ($i = 0;$i < count($this->subs);$i++) {?>
            
                <div class="card" id="<?='card-'.$this->subs[$i]['name']?>">
                    <div class="card-img-top img-card d-flex justify-content-center">
                        <img src="<?=$this->subs[$i]['svg']?>" alt="<?=$this->subs[$i]['name']?>" class="img-fluid">
                    </div>
                    <div class="card-body pt-0 pr-0 pl-0 pb-0">
                        <h5 class="card-title text-center">Abonement</h5>
                        <h3 class="card-title text-center" style="color:<?=$this->subs[$i]['color']?>;"><?= $this->subs[$i]['name']; ?></h3>
                        <div class="container-fluid p-0 m-0" style="background-color:<?=$this->subs[$i]['backgroundcolor']?>;">
                        <p class="card-text text-center" style="color:<?=$this->subs[$i]['color2']?>;">Inscription + badge</p>
                        <p class="card-text text-center" style="color:<?=$this->subs[$i]['color2']?>;">35.99</p>
                        </div>
                        <h5 class="card-text text-center">Accès à la salle</h5>
                        <p class="card-text text-center" style="color:<?=$this->subs[$i]['color']?>;"><?php echo $this->subs[$i]['access']; ?></p>
                        <h5 class="card-text text-center">Suivi par un</h5>
                        <p class="card-text text-center"  style="color:<?=$this->subs[$i]['color']?>;"><?php echo $this->subs[$i]['coach']; ?></p>
                        <form class="d-flex justify-content-center" action="">
                            <input type="hidden" name="innernav" value="<?php if($_SESSION['connecter'] == 'connecté'){echo 'Abonnement';}?>">
                            <input type="hidden" name="nav" value="<?php if($_SESSION['connecter'] == 'connecté'){echo 'Account';$_POST['innernav'] = 'Abonnement';}else{echo 'Signin'; }?>">
                            <input class="btn btn-green" type="submit" value="<?= $this->subs[$i]['price'].'$' ?>">
                        </form>
                    </div>
                </div>
            <?php } ?>
            </div>
            <div class="container" id="comments">
                <div class="container-fluid">
                    <h1 class="text-center">Commentaires</h1>
                    <h3 class="text-center">Les derniers commentaires</h3>
                    <div class="container info-bubble">
                        <?php for($i=0;$i<count($this->comments) && $i<5;$i++){?>
                            <div class="card m-5">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"> Posté par : <?= $this->comments[$i]['surname'];?> <?= $this->comments[$i]['name'];?></li>
                                    <li class="list-group-item"> Le : <?= $this->comments[$i]['datecreated'];?></li>
                                    <li class="list-group-item text-justify text-center"><?= $this->comments[$i]['content'];?></li>
                                </ul>
                            </div>

                        <?php }?>
                    </div>
                </div>
                <div>
                    
                </div>
            </div>
        </div>
        <?php 

        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }
}
