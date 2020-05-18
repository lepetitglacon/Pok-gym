<?php 
class Model {

    public $pdo;

    public function __construct(){
        $conf = array(
            'host' => 'localhost',
            'database' => 'pokegym',
            'login' => 'root',
            'password' => 'naruto39000'
        );

        try{
            $pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';',$conf['login'],$conf['password']);
            $this->pdo = $pdo;
        }
        catch(PDOException $e){
            if(Conf::$debug >= 1){
                die($e->getMessage());
            }
            else{
                die('impossible de se connecter à la base');
            }
        } 
    }

    public function getAllFromTable($table){
        $sql = 'SELECT * FROM :table';
        $req = $this->pdo->prepare($sql);
        $reponse = $req->execute(array(':table' => $table));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    
    //-------------------TABLE USER-------------------
    public function getAllUser(){
        $sql = 'SELECT * FROM USER';
        $req = $this->pdo->prepare($sql);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    //Getters

    public function getUserById($id){
        $sql = 'SELECT * FROM USER WHERE id = :id';
        $req = $this->pdo->prepare($sql);
        $reponse = $req->execute(array(':id' => $id));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserByName($name){
        $sql = 'SELECT * FROM USER WHERE name = :name';
        $req = $this->pdo->prepare($sql);
        $reponse = $req->execute(array(':name' => $name));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserByMail($mail){
        $sql = 'SELECT * FROM USER WHERE email = :email';
        $req = $this->pdo->prepare($sql);
        $reponse = $req->execute(array(':email' => $mail));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    //Setters

    /*Créer un utilisateur avec tous les champs.
    *@params    nom
    *@params    prenom
    *@params    password hashé
    *@params    mail*/
    public function createUser($name,$surname,$password,$mail){
        $sql = 'INSERT INTO `USER`(`name`, `surname`, `password`, `email`) VALUES (:name,:surname,:password,:email)';
        $req = $this->pdo->prepare($sql);
        $req->bindparam('name', $name);
        $req->bindparam('surname', $surname);
        $req->bindparam('password', $password);
        $req->bindparam('email', $mail);
        return $req->execute();
    }

    /*Complète un utilisateur qui n'avait que la Newsletter.
    *@params    mail*/
    public function createUserFromMail($name,$surname,$password,$mail){
        $sql = 'UPDATE `USER` SET `name`= :name,`surname`=:surname,`password`=:password WHERE `email` = :email';
        $req = $this->pdo->prepare($sql);
        $req->bindparam('name', $name);
        $req->bindparam('surname', $surname);
        $req->bindparam('password', $password);
        $req->bindparam('email', $mail);
        return $req->execute();
    }

    /*Créer un utilisateur avec son adresse mail et l'inscrit à la newsletter.
    *@params    mail
    */
    public function createUserNewsletter1($email){
        $sql = "INSERT INTO `USER` (`email`, `newsletter`) VALUES (:email, '1')";
        $req = $this->pdo->prepare($sql);
        $req->bindparam('email', $email);
        return $req->execute();
    }
    
    /*Inscrit un utilisateur existant à la newsletter.
    *@params    id
    */
    public function updateUserNewsletter1($id){
        $sql = "UPDATE `USER` SET `newsletter`= '1' WHERE `id` = :id";
        $req = $this->pdo->prepare($sql);
        $req->bindparam('id', $id);
        return $req->execute();
    }

    public function updateUserNewsletter0($id){
        $sql = "UPDATE `USER` SET `newsletter`= '0' WHERE `id` = :id";
        $req = $this->pdo->prepare($sql);
        $req->bindparam('id', $id);
        return $req->execute();
    }

    public function updateUserMail($id,$mail){
        $sql = 'UPDATE `USER` SET `email`= :email WHERE `id` = :id';
        $req = $this->pdo->prepare($sql);
        $req->bindparam('id', $id);
        $req->bindparam('email', $mail);
        return $req->execute();
    }

    public function updateUserPassword($id,$password){
        $sql = 'UPDATE `USER` SET `password`= :password WHERE `id` = :id';
        $req = $this->pdo->prepare($sql);
        $req->bindparam('id', $id);
        $req->bindparam('password', $password);
        return $req->execute();
    }

    //Other

    //-------------------TABLE SUB-------------------

    public function getAllSub(){
        $sql = 'SELECT * FROM SUB';
        $req = $this->pdo->prepare($sql);
        $reponse = $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    //-------------------TABLE USERSUB-------------------

    public function getUserUSERSUB($id){
        $sql = 'SELECT SUB.`name`, SUB.`access`, SUB.`price`, SUB.`coach`, SUB.`svg` FROM `USERSUB`,`SUB` WHERE USERSUB.idSub = SUB.id AND `idUser` = :id';
        $req = $this->pdo->prepare($sql);
        $req->bindparam('id',$id);
        $reponse = $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    //-------------------TABLE COMMENT-------------------

    public function getAllCOMMENT(){
        $sql = 'SELECT * FROM COMMENT';
        $req = $this->pdo->prepare($sql);
        $reponse = $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCommentsUser(){
        $sql = 'SELECT C.*, U.name, U.surname FROM COMMENT C, USER U WHERE C.userid = U.id ORDER BY C.datecreated DESC';
        $req = $this->pdo->prepare($sql);
        $reponse = $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertComment($id, $content){
        $sql = 'INSERT INTO `COMMENT`(`userid`, `content`) VALUES ( :id, :content)';
        $req = $this->pdo->prepare($sql);
        $req->bindparam('id',$id);
        $req->bindparam('content',$content);
        return $req->execute();

    }

    //-------------------TABLE RUBRIQUE-------------------
    public function getRubriqueArticle(){
        $sql = 'SELECT R.`title`, R.`dropdown`, A.`title` AS `atitle` FROM `RUBRIQUEARTICLE` RA, `RUBRIQUE` R, `ARTICLE` A WHERE A.id = idarticle AND R.id = idrubrique GROUP BY RA.`id`';
        $req = $this->pdo->prepare($sql);
        $reponse = $req->execute();
        return $req->fetchAll(PDO::FETCH_NAMED);
    }

    public function getRubrique(){
        $sql = 'SELECT title, dropdown FROM `RUBRIQUE` GROUP BY `title`';
        $req = $this->pdo->prepare($sql);
        $reponse = $req->execute();
        return $req->fetchAll(PDO::FETCH_NAMED);
    }
}