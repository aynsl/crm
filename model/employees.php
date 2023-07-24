<?php 
require_once './model/database.php';


//renvoie la liste des produits presque epuises //
// get  renvoie une liste de produits // 

function getbestemployees():array{
    // connection ala BDD //
    $database = connect();                   

 // code SQL a executer  //
    $sql =  'SELECT employees.employeeNumber, employees.lastName,employees.firstName,offices.city,
    ROUND(sum(orderdetails.quantityOrdered*orderdetails.priceEach) ,2 )as `Ca`
    FROM `employees` 
    
    join offices on offices.officeCode = employees.officeCode
    join customers on customers.salesRepEmployeeNumber = employees.employeeNumber
    join orders on orders.customerNumber = customers.customerNumber
    join orderdetails on orderdetails.orderNumber = orders.orderNumber
    
    GROUP by employees.employeeNumber
    order by Ca  DESC
    limit 5;';
     

  // etape importante preparation de  la requete //
    $query = $database->prepare($sql);     

 // etape importante  execution de  la requete //
    $query->execute();                     

 // recuperation des donnees de la requetes  FETCH ASSOC  //
    $datas = $query->fetchAll(PDO::FETCH_ASSOC);   

//renvoie des datas finales // 
     return $datas;


}


function getemployees( int $employeeNumber):array{


   // connection ala BDD //
   $database = connect();                   

   // code SQL a executer  //
      $sql =  ' SELECT employees.employeeNumber,
      employees.lastName,
      employees.firstName,
      employees.email,
      employees.jobTitle,
      employees.reportsTo,
      offices.city,
      offices.phone,
      offices.officeCode,
      offices.addressLine1,
      offices.addressLine2,
      offices.state,
      offices.country,
      offices.postalCode,
      offices.territory
FROM `employees` 
join offices on offices.officeCode = employees.officeCode
WHERE employees.employeeNumber = :employeeNumber;';             // car c'est un string une chaine de caratctere faut pas mettre $productcode // 

    // etape importante preparation de  la requete //
      $query = $database->prepare($sql);     
  
   // etape importante  execution de  la requete //
      $query->execute([
        ':employeeNumber'=> $employeeNumber
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