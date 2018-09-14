
<?php

//To be able to instantiate this class write: use \Wil\BDoodle\Model;

class Model
{
    protected function dbConnect()
    {
        $db_host = "localhost";
        $db_name = "hotel";
        $db_user = "root";
        $db_pass = "";
        //Because we have placed Manager in a namespace, we have to add a \in front of PDO 
        //because the PDO is located in the global namspace 
        $pdo = new PDO('mysql:host='.$db_host.'; dbname='.$db_name, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        return $pdo;
    }

}



?>