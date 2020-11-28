<?php
// THATS MATERIAL OF STUDYING ABOUT PDO 

//---------CONECTION---------------
try {

    $pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost","root","");
     
}

//--------SHOW ERROR-------

catch (PDOException $e){
        echo "erro com banco de dados:".$e->
        getmessage();
        exit();

    }
    //GENERIC ERROR

       catch (exception $e){
        echo "erro generico:".$e->
        getmessage();
        exit();

    }
    //-----------INSERT-------------

    $res= $pdo -> prepare ("INSERT INTO pessoa (nome,telefone,email)VALUES (:n,:t,:e)");
   //BY BINDVALUE
    $res-> bindValue(":n","Gustavo");
    $res-> bindValue(":t","963197276");
    $res-> bindValue(":e","teste@gmail.com");
    $res->execute();

//---------------DELETE---------

    $res= $pdo -> prepare ("DELETE FROM pessoa WHERE id::id");
    $id=1;
    $cmd->bindValue(":id",$id);
    $cmd ->execute();

//--------------UPDATE(columns)-------

$res = $pdo ->prepare("UPDATE pessoa SET email= :e WHERE id = :id");
$cmd->bindValue(":id","2");
$cmd->bindValue(":e","teste1@gmail.com");
$cmd ->execute();
//--------------SELECT-----------------
$cmd= $pdo-> prepare ("SELECT * FROM pessoa WHERE id =:id");
$cmd->bindValue(":id",4);
$cmd->execute();
$resultado= $cmd-> fetch();

?>