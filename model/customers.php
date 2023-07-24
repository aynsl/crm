<?php
// chargement du modele connexion //
require_once './model/database.php';

//renvoie la liste des produits presque epuises //
// get  renvoie une liste de produits // 

function getbestcustomers():array{
    // connection ala BDD //
    $database = connect();                   

 // code SQL a executer  //
    $sql =  'SELECT  customers.`customerNumber`, customers.`customerName`, ROUND(sum(orderdetails.quantityOrdered*orderdetails.priceEach) ,2 )as CA
    FROM `customers`
    join orders on orders.customerNumber = customers.customerNumber
     JOIN orderdetails on orderdetails.orderNumber = orders.orderNumber
     group by customers.customerNumber
     ORDER by `CA`DESC
     limit 3;
     ';

  // etape importante preparation de  la requete //
    $query = $database->prepare($sql);     

 // etape importante  execution de  la requete //
    $query->execute();                     

 // recuperation des donnees de la requetes  FETCH ASSOC  //
    $datas = $query->fetchAll(PDO::FETCH_ASSOC);   

//renvoie des datas finales // 
     return $datas;

  

}

// renvoie les donnees des clients précisé // 

 function getcustomer(int $customerNumber):array{

 // connection ala BDD //
 $database = connect();                   
 
 // code SQL a executer  //
    $sql =  ' SELECT  customers.customerNumber ,
    customers.customerName ,
    customers.contactLastName,
    customers.contactFirstName,
    customers.phone,
    customers.addressLine1,
    customers.addressLine2,
    customers.city,
    customers.state,
    customers.postalCode,
    customers.country,
    customers.salesRepEmployeeNumber,
    customers.creditLimit ,
    employees.email,
    employees.lastName,
    employees.firstName,
    offices.city as `officecity`,
    offices.country as `officecountry`,
    ROUND(sum(orderdetails.quantityOrdered*orderdetails.priceEach) ,2 )as `CA`
    FROM `customers`
    join employees on employees.employeeNumber = customers.salesRepEmployeeNumber
    join offices on offices.officeCode = employees.officeCode
    join orders on orders.customerNumber = customers.customerNumber
    JOIN orderdetails on orderdetails.orderNumber = orders.orderNumber
    WHERE customers.customerNumber = :customerNumber
    order by customers.customerNumber;';             // car c'est un string une chaine de caratctere faut pas mettre $productcode // 

  // etape importante preparation de  la requete //
    $query = $database->prepare($sql);     

 // etape importante  execution de  la requete //
    $query->execute([
      ':customerNumber'=> $customerNumber
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


 



