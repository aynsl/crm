<?php


 //chargement des librairies//

 require_once './lib/debug.php';
  require_once './lib/format.php';

// chargement du modele connexion //

 require_once './model/database.php';
 require_once './model/products.php';
 require_once './model/customers.php';
 require_once './model/employees.php';
// chargement des datas en provenance du model 
$productsOutOfStock = getoutofstockproducts();
$bestsellers = getbestsellersproducts();
$bestcustomers = getbestcustomers();
$bestemployees=getbestemployees();
$productlines=getnumberofproductsbyproductline();
// affichage du tableau dans la page //
//d($productline);//



//chargement du template de la page   la view //

 include './templates/blocs/index.phtml';

// include         tente de charger le fichier.
// include_once    tente de charger le fichier une seule fois.
//require est similaire à include, mais considère le fichier comme obligatoire.
// Si le fichier ne peut pas être chargé, une erreur fatale se produira. //
//require_once // est similaire à require, mais garantit que le fichier est chargé une seule fois.
