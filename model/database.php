<?php

      
//cree une connexion à la BDD // 

function connect(){              

 //tentative de connexion a la BDD //

$dsn = 'mysql:dbname=classicmodels;host=127.0.0.1'; //port:xxxx//
$user = 'root';
$password = 'root';
$database = new PDO($dsn,$user,$password);   // connexion de la base de donnee//

 return $database  ;

}



