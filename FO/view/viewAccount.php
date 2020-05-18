<?php
class viewAccount implements ViewCoponent{

    public function __construct(){
    }

    public function setPhrase($phrase){
        $this->phrase = $phrase;
    }

    public function setError($error){
        $this->error = $error;
    }

    public function setInnerNav($innernav){
        $this->innernav = $innernav;
    }

    public function setData($data){
        $this->data = $data;
    }




    public function giveHTML(){
        ob_start();?>

        <div class="container info-bubble navbar navbar-expand-xl d-flex justify-content-center">
            <form action="" method="request">
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <input type="hidden" name="nav" value="Account">
                        <input class="btn btn-success" type="submit" name="innernav" value="Abonnement">
                    </div>
                    <div class="col d-flex justify-content-center">
                        <input class="btn btn-success" type="submit" name="innernav" value="Mes Infos">
                    </div>
                    <div class="col d-flex justify-content-center">
                        <input class="btn btn-success" type="submit" name="innernav" value="Commenter">
                    </div>
                </div>
            </form>
        </div>

        <?php 
        if(!empty($this->innernav)){?>

            <div class="container-fluid info-bubble">
                <div class="container-fluid d-flex flex-column justify-content-center align-items-center">
                    <h1><?=$this->innernav;?></h1> <?php 

                    switch($this->innernav){
                        case 'Abonnement':
                            if(isset($this->phrase)){?>
                                <div class="alert alert-warning">
                                    <?= $this->phrase?>
                                </div><?php 
                            }?>
                            <div class="container"><?php
                            

                                if(!empty($this->data)){
                                    $j = 0;
                                    foreach($this->data as $key => $value){?>
                                    <div class="card m-5">
                                        <h1 class="card-header">Abonnement : <?= $key+1?></h1>
                                        <img class="card-img-top" src="<?= $this->data[$j]['svg']?>" alt="" style='height:200px;'>
                                        <div class="card-body">
                                        <?php foreach($this->data[$j] as $key => $value) { 
                                            if($key != 'svg'){?>
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="card-text"><?= $key?></p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="card-text"><?= $value?></p>
                                                    </div>
                                                </div>
                                            <?php }?>
                                                
                                            
                                        <?php }
                                        $j++;?>
                                            <div class="row d-flex justify-content-center">
                                                <div class="col d-flex justify-content-end">
                                                    <form action="">
                                                        <input type="hidden" name="innernav" value="Abonnement">
                                                        <input type="hidden" name="nav" value="Account">
                                                        <input class="btn btn-info" type="submit" value="Voir">
                                                    </form>
                                                </div>
                                                <div class="col d-flex justify-content-start">
                                                    <form action="">
                                                        <input type="hidden" name="innernav" value="Abonnement">
                                                        <input type="hidden" name="nav" value="Account">
                                                        <input class="btn btn-danger" type="submit" value="Se désabonner">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                   
                            </div>   

                        <div class="container d-flex justify-content-center">
                            <form action="" method="post">
                            <input class="btn btn-success" type="submit" name="nav" value="S'abonner">
                            </form>
                        </div>     
                                <?php  
                                    
                                }
                        break;
                        case 'Mes Infos':

                            if(isset($this->phrase)){?>
                                <div class="alert alert-warning">
                                    <?= $this->phrase?>
                                </div><?php 
                            }
                            if(isset($_POST['Modifier']) && $_POST['Modifier'] == 'Modifier'){?>
                            
                            <div class="container"><?php
                            if(isset($this->phrase)){?>
                                <div class="alert alert-warning">
                                    <?= $this->phrase?>
                                </div><?php 
                            }?>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col">
                                        <p>Nom :</p>
                                        </div>
                                        <div class="col">
                                            <?= $_SESSION['user'][0]['name']?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                        <p>Prénom :</p>
                                        </div>
                                        <div class="col">
                                            <?= $_SESSION['user'][0]['surname']?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                        <p>Adresse Mail :</p>
                                        </div>
                                        <div class="col">
                                            <input class="form-control" type="email" name="email" id="" value="<?= $_SESSION['user'][0]['email']?>"> 
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col d-flex justify-content-center">
                                                <input class="btn btn-success" type="submit" name="Enregistrer" value="Enregistrer">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <?php }
                            elseif(isset($_POST['Modifier']) && $_POST['Modifier'] == 'Modifier le mot de passe') {?>
                            
                            <div class="container"><?php
                            if(isset($this->phrase)){?>
                                <div class="alert alert-warning">
                                    <?= $this->phrase?>
                                </div><?php 
                            }?>
                                <div class="row">
                                    <div class="col">
                                    <p>Nom :</p>
                                    </div>
                                    <div class="col">
                                        <?= $_SESSION['user'][0]['name']?> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                    <p>Prénom :</p>
                                    </div>
                                    <div class="col">
                                        <?= $_SESSION['user'][0]['surname']?> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                    <p>Adresse Mail :</p>
                                    </div>
                                    <div class="col">
                                        <?= $_SESSION['user'][0]['email']?> 
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="col d-flex justify-content-center">
                                        <form action="" method="post">
                                        <div class="form-group">
                                            <label for="oldpassword">Ancien mot de passe</label>
                                            <input type="password" class="form-control" name="oldpassword" id="oldpassword">
                                        </div>
                                        <div class="form-group">
                                            <label for="newpassword">Nouveau mot de passe</label>
                                            <input type="password" class="form-control" name="newpassword" id="newpassword">
                                        </div>
                                        <div class="form-group">
                                            <label for="password2">Vérifier nouveau mot de passe</label>
                                            <input type="password" class="form-control" name="newpassword2" id="password">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <input class="btn btn-success" type="submit" name="Enregistrer" value="Enregistrer nouveau mot de passe">
                                        </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            

                            <?php }
                            else{?>

                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                    <p>Nom :</p>
                                    </div>
                                    <div class="col">
                                        <?= $_SESSION['user'][0]['name']?> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                    <p>Prénom :</p>
                                    </div>
                                    <div class="col">
                                        <?= $_SESSION['user'][0]['surname']?> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                    <p>Adresse Mail :</p>
                                    </div>
                                    <div class="col">
                                        <?= $_SESSION['user'][0]['email']?> 
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="col d-flex justify-content-center">
                                        <form action="" method="post">
                                            <input class="btn btn-success" type="submit" name="Modifier" value="Modifier">
                                        </form>
                                    </div>
                                    
                                </div>
                                <div class="row d-flex justify-content-center mt-2">
                                    <form action="" method="post">
                                        <input class="btn btn-danger" type="submit" name="Modifier" value="Modifier le mot de passe">
                                    </form>
                                </div>
                            </div>

                            <?php }
                        break;
                        case 'Commenter':?>
                            <div class="container">
                                <h3 class="text-center m-5">Commentez la salle !</h3>
                                <?php if(isset($this->phrase)){?>

                                <p class="text-center alert <?=$_SESSION['account']['info']?>"><?=$this->phrase?></p>
                                <?php }
                                
                                    if(!empty($this->error)){?>
                                        <div><?=$this->error?></div>;
                                    <?php }?>
                                <div class="container">
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col d-flex flex-column align-items-center">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">255 char. max.</span>
                                                    </div>
                                                    <textarea class="form-control" aria-label="" name="textarea"></textarea>
                                                </div>
                                                <div class="mt-5">
                                                    <input type="hidden" name="innernav" value="Commenter">
                                                    <input type="hidden" name="nav" value="Account">
                                                    <input class="btn btn-success" type="submit" name="comment" value="Poster le commentaire">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php 
                        break;
                        default:?> 
                        <div>Erreur 404<br>Cette page n'existe pas</div>
                        <?php
                        break;
                            }
                            
                            
                            
                                


                            
                            ?>     
                </div>
            </div>

        <?php }
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
        
    
}
}
