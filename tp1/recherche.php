<?php

    include "data/pdo.php";
    include "entete.php";
    
    $exo=new pdoConnect("localhost","db_sportifs","root","Kevin_18");

    $data1 = $exo->connex()->query('SELECT `id_sport`,`design` FROM sport');
    $req=$data1->fetchAll(PDO::FETCH_CLASS );
    

    $data2 = $exo->connex()->query('SELECT `depart` FROM personne');
    $req2=$data2->fetchAll(PDO::FETCH_CLASS );
    
    $query = "SELECT `nom`,`prenom`,`mails` FROM `personne`,`pratique` WHERE personne.id_personne = pratique.id_personne AND depart='{$_POST['depart']}' AND id_sport='{$_POST['sport']}'";
    
    $data3= $exo->connex()->query($query);
    $req3=$data3->fetchAll(PDO::FETCH_CLASS );
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>recherche</title>
</head>
<body>
    <div class="container ">
        <div class="row">
            <div class="col-md-6">
                <form action= "<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="application/x-www-form-urlencoded">
                    
                    <fieldset class="px-4 py-4">
                        <legend><b>Vos pratique sportifs</b></legend>
                        <table>
                            Sport pratiqués :
                            <select class="form-control" name="sport" size="1" > 
                                <?php foreach ($req as $value):?>
                                        <option value="<?=$value->id_sport?>"><?=$value->design;?></option>
                                <?php endforeach;?> 
                            </select></br>
                            <label>Niveau :</label>
                            <select  class="form-control" name="niveau" size="1"> 
                                <option value="debutants"> Debutants</option>
                                <option value="confirmé"> Confirmé</option>
                                <option value="pro"> Pro</option>
                                <option value="supporter"> Supporter</option>
                            </select></br>
                            <label> Departement :</label>
                            <select class="form-control" name="depart" size="1" > 
                                <?php foreach ($req2 as $item):?>
                                    <option value="<?=$item->depart?>"><?=$item->depart?></option>";
                                <?php endforeach;?>
                                  
                            </select></br>
                            <input class="btn btn-success px-4 my-4 " type="submit" value="Envoyer" name="envoyer">
                        </table>
                        <div class="row">
                            <div class=" col-md-4 mt-2"><a  href="index.php" class="btn btn-primary">Aller à l'acceuil</a></div>
                            <div class=" col-md-4 mt-2"><a  href="ajout.php" class="btn btn-primary">Ajouter un sport</a></div>
                            <div class=" col-md-4 mt-2"><a  href="redirection.php" class="btn btn-danger">Deconnexion</a></div>
                        </div>
                    </fieldset>
                </form>
            </div>
        
            <div class="col-md-6">
                <?php if(isset($_POST['depart']) && empty($req3)):?>
                    <h4>vous n'avez pas de patenaire pour ce sport à <?= $_POST['depart']?> </h4>
                <?php else: ?>
                    <h4>liste des patenaires de <?=$_POST['depart']?></h4></br>  
                    <?php foreach($req3 as $val):?> 
                        <table class="table">
                            <thead>
                                <tr> 
                                    <?php foreach ($val as $key => $value):?> 
                                        <th scope="col"><?= $key; ?></th>
                                    <?php endforeach; ?>
                                </tr> 
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $val->nom; ?></td>
                                    <td><?= $val->prenom; ?></td>
                                    <td><?= $val->mails; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endforeach;?>
                <?php endif; ?>
            
            </div>
        </div>
    </div>
</body>
</html>