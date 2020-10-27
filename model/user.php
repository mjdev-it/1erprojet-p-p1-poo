<?php

    # Commentaires à placer au début de chaque fichier php :
    /**
    *
    * @package     Gestion_Utilisateurs
    * @subpackage  User
    * @author      mj <mj5sur5@gmail.com>
    * @version     v (08/10/2020)
    * @copyright   Copyright (c) 2020, mjdev
    * @param  string $immatriculation  l'immatriculation
    * @param  string $couleur la couleur
    * @param float $poids     le poids
    * @param float $puissance   la puissance
    * @param  string $type type de voiture
    */
    //include "/var/www/html/php2/classes/Personne.class.php";

    Class User{

        protected  int $id;

        protected  string $prenom;  
        
        protected  string $nom;

        protected  string $psswrd;



        //public Personne $conducteur;

        public function __construct(int $id,
                                    string $prenom,
                                    string $nom,
                                    float $psswrd){
            $this->id = $id;
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->psswrd = $psswrd;

        }

        public function getId(){
            return $this->id;
        }

        public function getPrenom(){
            return $this->prenom;
        }

        public function getNom(){
            return $this->nom;
        }

        public function getPsswrd(){
            return $this->psswrd;
        }

        public function __toString(){
            
            
            $id = $this->id;
            $prenom = $this->prenom;
            $nom = $this->nom;
            $psswrd =  $this->psswrd;

            //$NomPers = $this->conducteur->getNom();
            $formatmes = "<br />l'utilisateur de nom %s %s"  
             . " a l'id %d";
            $mes = sprintf($formatmes, $prenom, $prenom, $id);
            return $mes;
        }
    }
