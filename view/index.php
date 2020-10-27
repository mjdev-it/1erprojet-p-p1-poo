<?pĥp

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/styles.css" />

        <title>Listing des utilisateurs</title>
    </head>
    <body>

        <div class="container-fluid">
            <div class="px-4 py-2">
                <br/>
                <br />
                <br/>
                <br />
                <h1>  Listing des utilisateurs</h1>
                <br/>
                <br />
                <?php

                    require '../controller/cobdd.php';

                    //$dsn = "mysql:dbname=dwwm_mes_septembre;host=localhost;port=3306";
                    /*
                    $dsn = "mysql:dbname=dwwm_mes_septembre;host=localhost";
                    $user = "mjdev";
                    $psswrd = "&(44@5Xr!h3_baMa5fuX";
                    try {
                        $pdo = new PDO($dsn, $user, $psswrd);
                        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }
                    catch(PDOException $e){
                        die("Erreur de Connection" . $e->getMessage());
                    }
                    */

                    // pour debug 
                    
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL); 

                    // pour tests et mise au point
                    //var_dump($_GET);
                    $status = ""; 
                    // Si les champs existent on dit que le $status = "OKHS"
                    // ça peut changer plus tard si en plus les champs sont non vides
                    // sinon ça ne change pas
                    if ( isset($_GET['id']) && isset($_GET['status']) && isset($_GET['page']) ) {
                        $status = "OKHS";
                    }
                    // On teste si des valeurs ont été envoyées à index.php pat la méthode get
                    // avec passage de parametres dans l'url
                    // Ici pas de soucis pour la securité, c'est juste pour afficher un message OK ou pas
                    // suite à ajout, modification ou suppression d'un utilisateur
                    if ( isset($_GET['id']) && !empty($_GET['id']) 
                    && isset($_GET['status']) && !empty($_GET['status']) 
                    && isset($_GET['page']) && !empty($_GET['page'])){
                        
                        $id = intval($_GET["id"]);
                        $status = $_GET['status'];
                        $page = $_GET['page'];

                        /*
                        echo "<br />" ."id = " .$id;
                        echo "<br />" ."status =" .$status;
                        echo "<br />" ." page = " .$page;
                        */
                        $deb_mes = "";
                        $mil_mes = " avec l'id : " . $id;
                        $fin_mes = "<br /> lors de la sortie de la page : " . $page. ".php" ;
                        switch ($status) {
                            case "HS":
                                $deb_mes = "***** Echec ";
                                $mes =  $deb_mes . $mil_mes . $fin_mes ;
                            break;
                            case "OK":
                                $deb_mes = "Bravo Succes ";
                                $mes =  $deb_mes . $mil_mes . $fin_mes ;
                            break;
                            case "HS2":
                                $mes = "Un  utilisateur ayant même prénom et même nom est déjà présent dans la base.<br />";
                                $mes = $mes . "<br />Veuillez contacter le webmaster : mj5sur5@gmail.com";
                                break;
                            default:
                                $deb_mes = "***** Attention ***** ". $status 
                                . "= cas non prévu au programme. Faites un peu attention mj !";
                                //$deb_mes = $deb_mes . "Vous avez status qui est egal a : \"" . $status ."\"";
                                $mes =  $deb_mes . $mil_mes . $fin_mes ;
                            }                        

                        
                    }
                    else{
                        //echo "<br /> Erreur \$_GET(\"id\") et/ou \$_GET(\"page\") et/ou \$_GET(\"status\") n'est pas defini ou est vide"."\"<br />";
                        //echo "<br />" . "mais ceci peut se passer, si vous ouvrer cette page sans passer de paramètres ";
                        $mes = "On a lancé cette page index.php sans y avoir passé de parametres.";
                        $mes = $mes . " Cela provient du fait qu'on n'y vient pas depuis l'une des pages insert_user.php ou delete_user.php ou update_user.php";
                    }

                    if ( $status == "OK" || $status == ""){
                        echo '<p class="p-mj-ok"><br />' . $mes . '<br /><br /></p>';
                    }
                    elseif ( $status == "HS"){
                        echo '<p class="p-mj-hs"><br />' . $mes . '<br /><br /></p>';
                    }
                    else{
                        echo '<p class="p-mj-hs2"><br />' . $mes . '<br /><br /></p>';
                    }
                    echo "<br /><br /><br />";
                ?>
                
                <!--
                <input id="mes" type="hidden" value="<?php //echo $mes; ?>" />
                -->               
                <?php

                    //echo '<h1>Listing des utilisateurs</h1>'; et selection dans la base
                    // mj le 14/10/20 remplacé par utilisation PDO
                    //$sql = "SELECT * FROM user ORDER BY id;";
                    $query = $pdo->query("SELECT * FROM user ORDER BY id;");


                    //$result = mysqli_query($connect, $sql) or die (mysqli_error($connect));

                    $results = $query->fetchAll();

                    //var_dump($results);

                    if ($results) {
                        // pour test
                        //printf("Select a retourné %d lignes.\n", $result->num_rows);

                        $status="OK";
                    
                        echo '<table class="table-class table table-bordered table-striped">';
                        
                        echo '<thead class="thead-class">
                                <tr>
                                    <th>Id</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Suppression ?</th>
                                </tr>
                            </thead>
                        <tbody>';
                        
                        

                        //while($row = mysqli_fetch_assoc($result)){
                        foreach ($results as $result){
                            //var_dump($result);
                            //echo $row['nom'];
                            
                            //var_dump($result);
                            
                            echo '<tr><td>' . $result->id.'</td><td>'
                            . $result->prenom . '</td><td>'
                            .'<a href='.'"../controller/form_update_user.php?id='
                            .$result->id.'&status='.$status.'">'
                            .$result->nom. '</a></td><td>'
                            . $result->email . '</td><td>'
                            . $result->passwrd . '</td><td><a href='
                            .'"../controller/delete_user.php?id='.$result->id
                            .'"><input type="button" class="btn-add btn btn-danger" value="Supprimer"\></a></td></tr>';
                            
                        }
                        /* On aurai pu ecrire au lieu de ci-dessus au sein du html 
                        <?php foreach ($results as $result) ?>
                            <tr>
                                <td><?= $result->id ?></td>
                                <div class="">
                                *
                                *
                                *
                            </tr>
                        <?php endforeach ?>
                            </div>
                        */

                        
                        echo '</tbody></table>';
                        //echo '</table>';
                        
                        echo '<a href='.'"../controller/add_user.php" class='.'"ajout'.'"><input type="button" class="btn-add btn btn-primary" value="Ajouter"\>';

                        // lancement d'ube alert ds le script php ms avec un echo
                        // le alert contient la chaine $mes constitué des 3 variables reçues en parametre
                        // echo "<script type='text/javascript'>alert('".$mes."');</script>";

                        // liberation du jeu de resultats
                        //mysqli_close($result); 

                    }

                    

                    // liberation de la connexion
                    //mysqli_close($connect); 
                ?>
                
          </div>
        </div>
        <!-- les icones de fontawesome -->
        <script src="https://kit.fontawesome.com/4ec0c58701.js" crossorigin="anonymous"></script>       

                  <!-- bootstrap et jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../assets/scripts.js"></script>

    </body>
</html>
<?php

?>