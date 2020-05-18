<?php
class viewSignup implements ViewCoponent{

    public function __construct(){
    }

    public function setPhrase($phrase){
        $this->phrase = $phrase;
    }

    public function setError($error){
        $this->error = $error;
    }


    public function giveHTML(){
        ob_start();?>
        
        <div class="container info-bubble">
            <div class="container">
                
            </div>
            <div class="container text-center">
                <h3 class="mb-5">Inscrivez-vous</h3>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="password2">Retaper votre mot de passe</label>
                    <input type="password" class="form-control" name="password2" id="password">
                </div>
                <div class="container">
                    
                    <?php if(!empty($this->phrase)){?>
                    <div class="<?=$_SESSION['signup']['info'];?> text-center">
                        <?=$this->phrase;?>
                    </div>
                    <?php
                    }
                    if(!empty($this->error)){
                        echo '<pre class="alert alert-warning">';
                        foreach ($this->error as $error => $errorValue) {
                            echo '<p class="text-justify">Erreur de '.$error.'. | Raison : '.$errorValue;
                        }
                        echo '</pre>';
                    } 
                    ?>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <input type="submit" class="btn-green" name="action" value="S'inscrire">
                </div>
            </form>
        </div>
        <?php 
        $str = ob_get_contents();
        ob_end_clean();
        return $str;

    }


}
