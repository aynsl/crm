<?php
// chargement du modele connexion //
require_once './model/database.php';

// renvoie ltoutes les commandes contenant le produit spécifié//


 function getordersbyproductcode(string $productCode ):array{

         
     // connection ala BDD //
     $database = connect();                   

     // code SQL a executer  //
        $sql =  'SELECT orders.orderNumber,orders.orderDate,orders.customerNumber,customers.customerName,orderdetails.quantityOrdered,orderdetails.priceEach,ROUND (orderdetails.quantityOrdered*orderdetails.priceEach) as `total` 
        FROM `orders` 
        join orderdetails on orderdetails.orderNumber = orders.orderNumber 
        join customers on customers.customerNumber = orders.customerNumber 
        WHERE orderdetails.productCode = :productCode 
        ORDER by orders.orderDate DESC ';     // :  car c'est un string une chaine de caratctere faut pas mettre $productcode // 
 
      // etape importante preparation de  la requete //
        $query = $database->prepare($sql);     
    
     // etape importante  execution de  la requete //
        $query->execute([
            ':productCode' => $productCode
        ]);                     
    
     // recuperation des donnees de la requetes  FETCH ASSOC  //
        $datas = $query->fetchAll(PDO::FETCH_ASSOC);   
    
    //renvoie des datas finales // 
         return $datas;


}
// renvoie ltoutes les commandes contenant le produit spécifié//


function getordersbycustomernumber(string $customerNumber):array{

         
   // connection ala BDD //
   $database = connect();                   

   // code SQL a executer  //
      $sql =  ' SELECT orders.customerNumber,
      orders.orderNumber,
      orders.orderDate,
      orders.requiredDate,
      orders.shippedDate,
      orders.status,
      sum(orderdetails.quantityOrdered) as `quantity`,
      ROUND(sum(orderdetails.quantityOrdered * orderdetails.priceEach) ,2) as `total`
      FROM `orders`
      join orderdetails on orderdetails.orderNumber = orders.orderNumber
      WHERE orders.customerNumber = :customerNumber
      group by orders.orderNumber
      ORDER by  orders.orderDate DESC;';     // :  car c'est un string une chaine de caratctere faut pas mettre $productcode // 

    // etape importante preparation de  la requete //
      $query = $database->prepare($sql);     
  
   // etape importante  execution de  la requete //
      $query->execute([
         ':customerNumber'=> $customerNumber
      ]);                     
  
   // recuperation des donnees de la requetes  FETCH ASSOC  //
      $datas = $query->fetchAll(PDO::FETCH_ASSOC);   
  
  //renvoie des datas finales // 
       return $datas;


}
//   renvoie le detail d'une commande  // 
function  getordersdetails(string $orderNumber):array{


   // connection ala BDD //
   $database = connect();                   

   // code SQL a executer  //
      $sql =  'SELECT orders.orderNumber, 
      orders.orderDate, 
      orders.status, 
      orders.comments, 
      customers.customerName,
       customers.contactLastName, 
       customers.contactFirstName, 
       customers.phone, 
       customers.addressLine1, 
       customers.addressLine2, 
       customers.postalCode, 
       customers.city, 
       customers.state,
       customers.country,
       customers.customerNumber,
        ROUND(SUM(orderdetails.priceEach * orderdetails.quantityOrdered),2) as total
       FROM orders 
       JOIN customers ON customers.customerNumber = orders.customerNumber
       join orderdetails on orderdetails.orderNumber = orders.orderNumber
       WHERE orders.orderNumber = :orderNumber
       group by orders.orderNumber';          
    // etape importante preparation de  la requete //
      $query = $database->prepare($sql);     
  
   // etape importante  execution de  la requete //
     $query->execute([
      ':orderNumber' => $orderNumber
     ]);              
  
   // recuperation des donnees de la requetes  FETCH ASSOC  //
      $datas = $query->fetch(PDO::FETCH_ASSOC);   
      // si il n'y a pas de resultat //
      
  //renvoie des datas finales // 
       return $datas; 
}

function getorder(int $orderNumber):array{
  

   // connection ala BDD //
      $database = connect();                   
  
   // code SQL a executer  //
      $sql= 'SELECT orderdetails.productCode,
                    products.productName,
                    products.productLine,
                    products.productScale,
                    orderdetails.quantityOrdered,
                    orderdetails.priceEach,
                    ROUND(sum(orderdetails.quantityOrdered * orderdetails.priceEach),2) as  total
   FROM orderdetails 
   JOIN products ON products.productCode = orderdetails.productCode
   WHERE orderdetails.orderNumber = :orderNumber
   group by products.productCode;';
  
    // etape importante preparation de  la requete //
      $query = $database->prepare($sql);     
  
   // etape importante  execution de  la requete //
   $query->execute([
      ':orderNumber' => $orderNumber
     ]); 
   // recuperation des donnees de la requetes  FETCH ASSOC  //
      $datas = $query->fetchAll(PDO::FETCH_ASSOC);   
  
  //renvoie des datas finales // 
       return $datas;

}
