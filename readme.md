#CRM Classic Models

C'est une application de gestion de  relation client " **__tableau de bord__**".
On peut y visualiser les différentes commandes réalisées, ainsi que l'historique des clients.

###### index.php ###### 

l'interface principale qui nous affiche le détails de ce que nous voulons afficher voici une explication détailée


1.Chargement des bibliothèques :

    Les bibliothèques debug.php et format.php sont incluses à l'aide de require_once. Ces fichiers contiennent probablement des fonctions utilitaires ou des outils de débogage.

2.Chargement des fichiers de modèle :

    Les fichiers database.php, products.php, customers.php et employees.php sont inclus à l'aide de require_once. Ces fichiers contiennent probablement des fonctions pour interagir avec une base de données ou récupérer des données à partir des modèles.

3.Récupération des données à partir des modèles :

    Plusieurs fonctions sont appelées pour récupérer des données à partir des modèles :
        getoutofstockproducts() récupère une liste de produits en rupture de stock.
        getbestsellersproducts() récupère une liste des produits les plus vendus.
        getbestcustomers() récupère une liste des meilleurs clients.
        getbestemployees() récupère une liste des meilleurs employés.
        getnumberofproductsbyproductline() récupère le nombre de produits par ligne de produit.

4.Affichage des données dans le modèle :

    Le fichier de modèle index.phtml est inclus à l'aide de l'instruction include. Ce fichier contient probablement du code HTML et PHP pour afficher les données récupérées à partir des modèles.


