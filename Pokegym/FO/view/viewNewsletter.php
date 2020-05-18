<?php
class viewNewsletter implements ViewCoponent{

    public function __construct(){
    }

    public function setPhrase($phrase){
        $this->phrase = $phrase;
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
            <div class="container-fluid ">
                <div class="container info-bubble">
                    <div class="container">
                        <h5 class="text-center pb-5">La Pokéletter est le meilleur moyen d'avoir des informations sur les Pokégyms</h5>
                        <p class="text-justify">Vous pourrez voir :</p>
                        <ul>
                            <li>Les heures d'ouvertures</li>
                            <li>Les offres</li>
                            <li>Le personnel</li>
                            <li>Les bonnes affaires</li>
                            <li>Les bonnes pratiques</li>
                        </ul>
                    </div>
                    <div class="container text-center">
                        <div class="<?='alert alert-'.$_SESSION['newsletter']['info']?>">
                        <?php
                        if(!empty($this->phrase)){
                            echo $this->phrase;
                        }
                        
                        ?>
                        </div>
                    </div>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="email">Adresse email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <input type="submit" class="btn btn-success" name="action" value="S'inscrire">
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <input type="submit" class="btn btn-danger" name="action" value="Se désinscrire">
                        </div>
                    </form>
                    
                </div>
            </div>
        <?php 
        $str = ob_get_contents();
        ob_end_clean();
        return $str;

    }


}
