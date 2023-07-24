<?php
//chargement des librairies//
require_once './lib/debug.php';
require_once './lib/format.php';
require_once './lib/route.php';

// chargement du modele connexion //

require_once './model/database.php';
require_once './model/products.php';
require_once './model/orders.php';
require_once  './model/customers.php';
require_once './model/employees.php';


// si on a reçu un ID DANS l'url //
if(isset($_GET['id'])){

    //on recupere cet ID//

     $id = $_GET['id'];  
} else {
     //Sinon on retourne sur la page d'accueil //
    redirect('index.php');

}

 // charge les donnees de la commande //

 
 



$employee = getemployees($id);  


//chargement du template de la page   la view //

include './templates/blocs/employee.phtml';

