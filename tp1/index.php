<?php
    session_start();
    
    include "data/pdo.php";
    include "entete.php";
    $exo=new pdoConnect("localhost","db_sportifs","root","Kevin_18");
    $data1 = $exo->connex()->query('SELECT `design` FROM sport');
    $req=$data1->fetchAll(PDO::FETCH_CLASS );
    
    if (isset($_POST['email'])) {
        $data2=$exo->connex()->query("SELECT * FROM `personne` WHERE mails ='{$_POST['email']}'");
        $req2=$data2->fetchAll(PDO::FETCH_CLASS );
        if (empty($req2)) {
            header('Location: /inscription.php');
            $_SESSION['message']="<div class=\"alert alert-danger\" role=\"alert\">vous n'avez pas de compte veuillez vous inscrire</div>  ";
        }else {
            foreach ($req2 as $item) {
                echo"<center><h1>Bienvenue Mr/Mme ".strtoupper($item->nom)." \n</h1></center>"; 
                $_SESSION['user']=['id'=>$item->id_personne,
                'nom'=>$item->nom,
                'prenom'=>$item->prenom,
                'mails'=>$item->mails,
                'depart'=>$item->depart,
                'tel'=>$item->telephone];
            }           
        } 
    }


?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Acceuil</title>
</head>
<body>
    <div class="container">
        <div class="row px-5">
            <div class="col-md-8">
                <div class="col-md-6">
                    <h1> Liste des sports </h1>
                    <?php foreach ($req as $value):?>  
                        <ul class="list-group list-group-flush"><li class="list-group-item"><strong><?= ucfirst($value->design)."\n";?></strong></li></ul> 
                    <?php endforeach;?> 
                </div> 
            </div>
            <?php if (empty($_SESSION)) :?>
                <div class="col-md-4">
                <h1>Entrer votre email</h1>
                <form action= "$_SERVER['PHP_SELF'] " method="post" enctype="application/x-www-form-urlencoded">
                    <table>
                        <tr>
                            <td><label> Email: </label></td>
                            <td><input type="email" class="form-control" name="email"/></td>
                            <td><input class="btn btn-primary" type="submit" value="Envoyer" name="envoyer"></td>
                        </tr>
                    </table>
                </form>
                </div>
            <?php else :?>
                <div class="col-md-4">
                    <div class="row">
                    <div class=" col-md-6 mb-4 mt-2 "><a  href="ajout.php" class="btn btn-primary">Inscription pour un nouveau sport</a></div>
                    <div class=" col-md-6 mb-4 mt-2 "><a  href="recherche.php" class="btn btn-primary">Recherche de partenaires</a></div>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
</body>
</html>