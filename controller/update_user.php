<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css" />

        <title>Modifier un utilisateur</title>
    </head>
    <body>
        <h1>  Ajouter un utilisateur</h1>
        <br/>
        <br/>
        <?php

            require '../controller/cobdd.php';

            // pour tests et mise au point
            // var_dump($_POST);

            
            if ( isset($_POST['id']) && !empty($_POST['id']) 
            && isset($_POST['prenom']) && !empty($_POST['prenom'])
             && isset($_POST['nom']) && !empty($_POST['nom']) 
             && isset($_POST['email']) && !empty($_POST['email'])
              && isset($_POST['passwrd']) && !empty($_POST['passwrd']) ){
                
                // $id est transformé en int car c'est un entier dans la bdd
                // or il provient d'un echo de php donc c'est une chaîne de caractères
                // (remarque mj toutefois php ou mysqli à l'air permissif, 
                // car cela fonctionne aussi sans faire cette conversion )
                $id = intval($_POST["id"]);

                //var_dump($row);
                    //echo $row['nom'];
                    $prenom = $_POST['prenom'];
                    $nom = $_POST['nom'];
                    $email = $_POST['email'];
                    $passwrd = $_POST['passwrd'];
                    $passwrd2 = $passwrd;
            }
            else{
                //$id = intval($_POST["id"]);
                echo "<br />Un des champs n'est pas défini ou est vide"."\"<br />";
                $status == "HS";
            }
  
            


            // première requete on vérifie si le nom et le prénom existe déjà
            $query = $pdo->prepare("SELECT id, prenom, nom, passwrd, passwrd2 FROM user WHERE prenom= :prenom AND nom=:nom AND id <> :id;");
            $query->bindParam(':prenom',$prenom,PDO::PARAM_STR);
            $query->bindParam(':nom',$nom,PDO::PARAM_STR);
            $query->bindParam(':id',$id,PDO::PARAM_STR);
            $query->execute();

            // recuperation d'une ligne de resultat
            // en théorie on a 0 ou 1 ligne de resultat.
            $res = $query->fetch();
            
            /* Récupération de toutes les lignes d'un jeu de résultats */
            // mais on va tester plus bas ligne à lifne
            //$res = $query->fetchAll();

            //var_dump($res);
            // On verifie s'il y a au moins un resultat On dit que ça ne va pas
            // qu'on ne peut pas insérer
            if ($res) {
                // si il y a au moins un resultat c'est que le nom avec le prenom
                // existe déjà dans la bdd
                //if  ($row_cnt > 0){
                $id = $res->id;
                $status = "HS2";
            }
            else{

                // lancement 2eme requete on met à jour le nouvel utilisateur
                
                $query = $pdo->prepare("UPDATE user SET prenom=:prenom, nom=:nom, email=:email, passwrd=:passwrd, passwrd2=:passwrd2 WHERE id=:id;");
                $query->bindParam(':prenom',$prenom,PDO::PARAM_STR);
                $query->bindParam(':id',$id,PDO::PARAM_STR);
                $query->bindParam(':nom',$nom,PDO::PARAM_STR);
                $query->bindParam(':email',$email,PDO::PARAM_STR);
                $query->bindParam(':passwrd',$passwrd,PDO::PARAM_STR);
                $query->bindParam(':passwrd2',$passwrd2,PDO::PARAM_STR);
                $res2 = $query->execute();

                if ($res2){
                        $status = "OK";
                }
                else{
                    $status = "HS";
                }           
            }
        
            echo "status [{$status} id {$id}";
            if ( $status == "HS" || $status == "HS2" ){
                header("location:form_update_user.php?id=".$id."prenom=".$prenom."&nom=".$nom."&email=".$email."&passwrd=".$passwd."&status=".$status);
                die;
            }
        

            // je renvoie à index.php 3 parametres, dont ici le nom de la page d'ou l'on sort
            // mais sans le ".php" car cela pose problème
            $page = "update_user";

            // On renvoie sur la page index.php avec aussi la page precedente, le status
            //  et l'id concerné par l'insertion (add_user.php)
            //  ou la maj (update_user.php) ou le delete (delete_user.php)
            header("location:../view/index.php?id=".$id."&status=".$status."&page=".$page);
            die;

        ?>
                  <!-- les icones de fontawesome -->
        <script src="https://kit.fontawesome.com/4ec0c58701.js" crossorigin="anonymous"></script>
                  <!-- bootstrap et jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script type="text/javascript" src="scripts/formulaire_JQuery.js"></script>

    </body>
</html>
