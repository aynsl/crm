<?php

// chargement du modele connexion //
require_once './model/database.php';



// renvoie la liste des produits presque epuises //
// get  renvoie une liste de produits // 

function getoutofstockproducts():array{

 // connection ala BDD //
    $database = connect();                   

 // code SQL a executer  //
    $sql =  'SELECT `productCode`,
                    `productName`, 
                    `productLine`,
                    `productScale`,
                    `quantityInStock`
             FROM   `products`
             WHERE  `quantityInStock`<=200'; 

  // etape importante preparation de  la requete //
    $query = $database->prepare($sql);     

 // etape importante  execution de  la requete //
    $query->execute();                     

 // recuperation des donnees de la requetes  FETCH ASSOC  //
    $datas = $query->fetchAll(PDO::FETCH_ASSOC);   

//renvoie des datas finales // 
     return $datas;                           
}


// renvoie la liste des meilleures vente // 

function getbestsellersproducts():array{
  

      // connection ala BDD //
         $database = connect();                   
     
      // code SQL a executer  //
         $sql= 'SELECT`products`.`productCode`, 
                          `products`.`productName`,
                           SUM(orderdetails.quantityOrdered) as `quantity`  

                FROM `products` 
         
                join orderdetails on orderdetails.productCode = products.productCode 
         
                GROUP by `products`.`productCode`  
                ORDER BY `quantity` DESC
                LIMIT 20 ;';
     
       // etape importante preparation de  la requete //
         $query = $database->prepare($sql);     
     
      // etape importante  execution de  la requete //
         $query->execute();                     
     
      // recuperation des donnees de la requetes  FETCH ASSOC  //
         $datas = $query->fetchAll(PDO::FETCH_ASSOC);   
     
     //renvoie des datas finales // 
          return $datas;

}



// renvoie le nombre de produit dans chaque categorie de produit 

function getnumberofproductsbyproductline(){
      // connection ala BDD //
      $database = connect();                   

      // code SQL a executer  //
         $sql =  'SELECT `productLine`,COUNT(*) as `quantity`
         FROM `products` 
         GROUP by productLine';
     
       // etape importante preparation de  la requete //
         $query = $database->prepare($sql);     
     
      // etape importante  execution de  la requete //
         $query->execute();                     
     
      // recuperation des donnees de la requetes  FETCH ASSOC  //
         $datas = $query->fetchAll(PDO::FETCH_ASSOC);   
     
     //renvoie des datas finales // 
          return $datas;
     
     
}

function getproduct(string $productcode):array{


    // connection ala BDD //
    $database = connect();                   

    // code SQL a executer  //
       $sql =  ' SELECT  * 
                 FROM `products`
                  WHERE `productcode` = :productcode';             // car c'est un string une chaine de caratctere faut pas mettre $productcode // 

     // etape importante preparation de  la requete //
       $query = $database->prepare($sql);     
   
    // etape importante  execution de  la requete //
       $query->execute([
         ':productcode'=> $productcode
       ]);                     
   
    // recuperation des donnees de la requetes  FETCH ASSOC  //
       $datas = $query->fetch(PDO::FETCH_ASSOC);   
       // si il n'y a pas de resultat //
       if($datas === false) {
         // il faut quand meme renvoyer un tableau // 
         $datas = [] ; 
       }  
   //renvoie des datas finales // 
        return $datas; 
}
