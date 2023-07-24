<?php
//chargement des librairies//
require_once './lib/debug.php';
require_once './lib/format.php';
require_once './lib/route.php';

// chargement du modele connexion //

require_once './model/database.php';
require_once './model/customers.php';
require_once './model/orders.php';


// si on a reçu un ID DANS l'url //
if(isset($_GET['id'])){

    //on recupere cet ID//

     $id = $_GET['id'];  
} else {
     //Sinon on retourne sur la page d'accueil //
    redirect('index.php');

}

   // charger les donnees du client //
   $customer= getcustomer($id);  
   
   if(empty($customer)){
    //Sinon on retourne sur la page d'accueil //
   redirect('index.php');

}

// recupere toutes les commandes du client //
$orderscustomer= getordersbycustomernumber($id);
  //d($orderscustomer);// debug pour afficher la table //

   include './templates/blocs/customer.phtml';
