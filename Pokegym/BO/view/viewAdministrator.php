<?php
class viewAdministrator implements ViewCoponent{

    public function __construct(){
    }

    public function setPhrase($phrase){
        $this->phrase = $phrase;
    }

    public function setError($error){
        $this->error = $error;
    }

    public function setRubrique($rubrique){
        $this->rubrique = $rubrique;
    }
  
    public function setRubriqueArticle($rubrique){
        $this->rubriqueArticle = $rubrique;
    }

    public function setInnerNav($innernav){
        $this->innernav = $innernav;
    }

    public function setData($data){
        $this->data = $data;
    }




    public function giveHTML(){
        ob_start();

        if($_SESSION['user'][0]['bo'] == 2){ //SI USER EST ADMIN?>

        <div class="container info-bubble">
            <div class="nav d-flex justify-content-center">
                <form action="">
                    <input type="hidden" name="nav" value="Administrator">
                    <input class="btn btn-success" type="submit" name="adminnav" value="Newsletter">
                    <input class="btn btn-success" type="submit" name="adminnav" value="Comptes">
                    <input class="btn btn-success" type="submit" name="adminnav" value="Rubriques">
                    <input class="btn btn-success" type="submit" name="adminnav" value="Articles">
                    <input class="btn btn-success" type="submit" name="adminnav" value="Commentaires">
                </form>
            </div>
        </div>
        <?php if(!empty($this->innernav)){
        switch($this->innernav){ 
            case 'Comptes':
                $keys = array_keys($this->data[0])?>

                <div class="container-fluid info-bubble">
                <?php if(isset($this->phrase)){?>
                    <div class="alert alert-danger d-flex justify-content-center">
                        <?=$this->phrase?>
                    </div>
                        
                <?php }?>
                    <div class="container-fluid alerte-dark">
                        <h1>Comptes</h1>
                            <table class="table table-light table-striped" style="border-radius:5px;">
                                <thead class="thead-light">
                                    <tr class="table-active">
                                    <th scope="col"></th>
                                    <th scope="col"><input class="btn btn-light" type="submit" value="<?=$keys[1]?>"></th>
                                    <th scope="col"><input class="btn btn-light" type="submit" value="<?=$keys[2]?>"></th>
                                    <th scope="col"><input class="btn btn-light" type="submit" value="<?=$keys[3]?>"></th>
                                    <th scope="col"><input class="btn btn-light" type="submit" value="<?=$keys[4]?>"></th>
                                    <th scope="col"><input class="btn btn-light" type="submit" value="<?=$keys[5]?>"></th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="table-striped">
                                <?php for($i=0;$i<count($this->data);$i++){?>
                                    
                                    <tr>
                                    
                                        <th scope="row"><?=$i?></th>
                                        <td><?=$this->data[$i]['name']?></td>
                                        <td><?=$this->data[$i]['surname']?></td>
                                        <td><?=$this->data[$i]['email']?></td>
                                        <td><?=$this->data[$i]['newsletter']?></td>

                                        <td><?php if(isset($_POST['Modifier']) && $_POST['id'] == $this->data[$i]['id']){?><input class="form-control" form="form" type="text" name="bo" value="<?=$this->data[$i]['bo']?>"></td>
                                        <td scope="col"><form action="" method="post" id="form"><input class="btn btn-success" type="submit" name="Enregistrer" value="Enregistrer"><input type="hidden" name="id" value="<?=$this->data[$i]['id']?>"></form></th>
                                        <?php } else {?><?=$this->data[$i]['bo']?></td>
                                        <td scope="col"><form action="" method="post"><input class="btn btn-info" type="submit" name="Modifier" value="Modifier"><input type="hidden" name="id" value="<?=$this->data[$i]['id']?>"></form></th>
                                            <?php }?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                    </table>
                </div>
            </div>
            <?php break;

            case 'Rubriques':?>

                <div class="container-fluid">
                    <div class="container info-bubble d-flex flex-column align-items-center">
                        <?php if(isset($this->phrase)){?>
                            <div class="alert alert-warning"><?=$this->phrase?> </div>
                            <?php }?>
                        
                    <h3 class="m-3">Ajouter une rubrique</h3>
                        <div class="container">
                            <form action="" method="post" class="d-flex flex-column align-items-center">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Titre" name="rubrique" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-check mb-5">
                                    <input class="form-check-input" type="checkbox" name="checkbox" value="5" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Dropdown ?
                                    </label>
                                </div>
                                <input type="hidden" name="adminnav" value="Rubriques">
                                <input type="hidden" name="nav" value="Administrator">
                                <input class="btn btn-success" type="submit" name="addrubrique" value="Ajouter Rubrique">
                            </form>
                        </div>
                    </div>
                </div>
                <?php break;
                case 'Commentaires':?>
                <div class="container-fluid info-bubble">

                        <?php $keys = array_keys($this->data[0]);
                         for($i=0;$i<count($this->data);$i++){?>
                            <table class="table table-light table-striped" style="border-radius:5px;">
                                <thead class="thead-light">
                                    <tr class="table-active">
                                    <th scope="col"></th>
                                    <th scope="col"><input class="btn btn-light" type="submit" value="<?=$keys[4]?>"></th>
                                    <th scope="col"><input class="btn btn-light" type="submit" value="<?=$keys[5]?>"></th>
                                    <th scope="col"><input class="btn btn-light" type="submit" value="<?=$keys[2]?>"></th>
                                    <th scope="col"><input class="btn btn-light" type="submit" value="<?=$keys[3]?>"></th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="table-striped">
                                <?php for($i=0;$i<count($this->data);$i++){?>
                                    
                                    <tr>
                                    
                                        <th scope="row"><?=$i?></th>
                                        <td><?=$this->data[$i]['name']?></td>
                                        <td><?=$this->data[$i]['surname']?></td>
                                        <td><?=$this->data[$i]['content']?></td>
                                        <td><?=$this->data[$i]['datecreated']?></td>
                                        <td scope="col"><form action="" method="post"><input class="btn btn-danger" type="submit" name="Supprimer" value="Supprimer"><input type="hidden" name="id" value="<?=$this->data[$i]['id']?>"></form></th>
                                            <?php }?>
                                    </tr>
                            </tbody>
                    </table>

                        <?php }?>
                    </div>
                <?php break;
                case 'Newsletter':?>

                <div class="info-bubble my-0 container d-flex flex-column align-items-center">
                    <h3 class="text-center">Envoyer un mail</h3>
                    <form action="" method="post">
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </form>
                </div>

                <div class="container-fluid info-bubble">

                <?php $keys = array_keys($this->data[0]);?>
                <h2 class="text-center">Utilisateurs inscrits à la Pokéletter</h2>
                <?php for($i=0;$i<count($this->data);$i++){?>
                    <table class="table table-light table-striped" style="border-radius:5px;">
                        <thead class="thead-light">
                            <tr class="table-active">
                            <th scope="col"></th>
                            <th scope="col"><input class="btn btn-light" type="submit" value="<?=$keys[1]?>"></th>
                            <th scope="col"><input class="btn btn-light" type="submit" value="<?=$keys[2]?>"></th>
                            <th scope="col"><input class="btn btn-light" type="submit" value="<?=$keys[4]?>"></th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="table-striped">
                        <?php for($i=0;$i<count($this->data);$i++){?>
            
            <tr>
            
                <th scope="row"><?=$i?></th>
                <td><?=$this->data[$i]['name']?></td>
                <td><?=$this->data[$i]['surname']?></td>
                <td><?=$this->data[$i]['email']?></td>
                <td scope="col"><form action="" method="post"><input class="btn btn-danger" type="submit" name="Supprimer" value="Supprimer"><input type="hidden" name="id" value="<?=$this->data[$i]['id']?>"></form></th>
                    <?php }?>
            </tr>
    </tbody>
</table>

<?php }?>


                <?php break;

                case 'Articles':?>

                <div class="info-bubble my-0 container d-flex flex-column align-items-center">
                    <h3 class="text-center">Ajouter un article</h3>
                    <form action="" method="post">
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                        <?php foreach($this->rubrique as $key => $value){?>


                        <?php }?>
                    </form>
                </div>

                <div class="container-fluid info-bubble">

                


                <?php break;?>
                                    
        <?php } } }
        else{ //SI USER EST UTILISATEUR?>

        

        <?php }

        $str = ob_get_contents();
        ob_end_clean();
        return $str;
        
   }
}
