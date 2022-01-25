<?php
    session_start();
    include "data/pdo.php";
    include "entete.php";
    $exo=new pdoConnect("localhost","db_sportifs","root","Kevin_18");

    $data1 = $exo->connex()->query('SELECT `id_sport`,`design` FROM sport');
    $req=$data1->fetchAll(PDO::FETCH_CLASS );
    

    $requete2= "INSERT INTO `pratique`(`id_personne`,`id_sport`,`niveau`) VALUES ((SELECT `id_personne` FROM `personne` WHERE nom ='{$_POST['nom']}'),'{$_POST['sport']}','{$_POST['niveau']}')";
    $result2=$exo->connex()->exec($requete2); 
    

    if(isset($_POST['ajouter']) && !empty($_POST['ajout']))
    {
        $requete1= "INSERT INTO `sport`(`design`) VALUES ('{$_POST['ajout']}')";
        $result1=$exo->connex()->exec($requete1); 
        header('Location:/ajout.php');
    }

    if (!empty($_SESSION)) {
        foreach ($_SESSION as $value) {}
    }
   
    
    
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ajout</title>
    </head>
<body>
    <div class="container d-flex h-100">
        <div class="row align-self-center">
            <form action= "<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="application/x-www-form-urlencoded">
                <fieldset class="px-4">
                <legend><b>Vos coordonnées</b></legend>
                <table>
                    <tr><td>Nom : </td><td><input type="text" class="form-control" name="nom" size="40" value="<?= $value['nom'] ?>" maxlength="30" disabled /></td></tr>
                    <tr><td>Prénom : </td><td><input type="text" class="form-control" name="prenom" size="40" value="<?= $value['prenom'] ?>" maxlength="30"  disabled/></td></tr>
                    <tr><td>Departement : </td><td><input type="text" class="form-control" name="depart" size="40" value="<?= $value['depart'] ?>" maxlength="30" disabled/></td></tr>
                    <tr><td>E-mail : </td><td><input type="email" class="form-control" name="email" size="40" value="<?= $value['mails'] ?>" maxlength="60" disabled/></td></tr>
                    <tr><td>Telephone : </td><td><input type="tel" class="form-control" name="telephone" size="40" value="<?= $value['tel'] ?>" maxlength="40" disabled/></td></tr>
                </table>
                </fieldset>

                <fieldset class="px-4 py-4">
                <legend><b>Vos pratique sportifs</b></legend>
                <table>
                    <tr>
                        <td>Sport pratiqués :</td>
                        <td><select name="sport" class="form-control" size="1" > 
                                <?php foreach ($req as $value):?>
                                    <option value="<?= $value->id_sport?>"><?= $value->design?></option>
                                <?php endforeach;?>
                            </select>
                        </td> 
                        <td> OU Ajouter un sport à la liste :</td>
                        <td> <input type="text" class="form-control" name="ajout" > </td> 
                        <td> <input type="submit" class="btn btn-primary " name="ajouter" value="Ajouter"> </td></br>
                    </tr>
                    <tr>
                        <td> Niveau :</td>
                        <td><select name="niveau" class="form-control" size="1"> 
                                <option value="debutants"> Debutants</option>
                                <option value="confirmé"> Confirmé</option>
                                <option value="pro"> Pro</option>
                                <option value="supporter"> Supporter</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input class="btn btn-danger px-4 my-4" type="reset"type="reset" value="Effacer"></td>
                        <td><input class="btn btn-success px-4 my-4 " type="submit" value="Envoyer" name="envoyer"></td>
                    </tr>
                </table>
                <div class="row">
                    <div class=" col-md-4 mt-2 "><a  href="index.php" class="btn btn-primary"> Aller à l'acceuil</a></div>
                    <div class=" col-md-4 mt-2 "><a  href="recherche.php" class="btn btn-primary">Recherche de partenaires</a></div>
                    <div class=" col-md-4 mt-2"><a  href="redirection.php" class="btn btn-danger">Deconnexion</a></div>
                </div>
                </fieldset>
            </form>
        </div>
    </div>
</body>
</html>