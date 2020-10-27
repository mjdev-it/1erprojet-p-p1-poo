<?php


     /*
     $bdd = mysqli_connect("localhost:3307", "visio", "afpa", "phpvisio");



     if (!$bdd) {

          echo "Erreur de connection " . mysqli_connect_errno();

          exit;

     }
     */

     // et inclure en entête dans les fichiers php 
     // require 'cobdd.php';

     //$dsn = "mysql:dbname=dwwm_mes_septembre;host=localhost;port=3306";
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