<?php

//CREATE CLASS
class people
{
    //PRIVATE VARIABLE
    private $pdo;

    public function __construct($dbname, $host, $user, $senha)
    {

        try {

            $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha);
        } catch (PDOException $e) {
            echo "erro com banco de dados:" . $e->getmessage();
            exit();
        }
        //GENERIC ERROR
        catch (exception $e) {
            echo "erro generico:" . $e->getmessage();
            exit();
        }
    }


    public function collectdata()
    {
        //----------TAKING DATA OF USER-------- 

        $res = array();

        $cmd = $this->pdo->prepare("SELECT * FROM pessoa ORDER BY id DESC");

        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    //------------REGISTER------------
    public function registerpeople($nome, $telefone, $email)
    {

        $cmd = $this->pdo->prepare("SELECT id  FROM pessoa WHERE  email =:e");

        $cmd->bindValue(":e", $email);
        $cmd->execute();
        //--------------CHECK EMAIL AND INSERT----------
        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            $cmd = $this->pdo->prepare("INSERT INTO pessoa (nome , telefone , email) VALUES (:n,:t,,:e )");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->execute();
            return true;
        }
    }


    //-------------DELETE------------
    public function deletepeople($id)
    {

        $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id =:id");

        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }



    //---------SEND THE SAME VALUES IN INPUT BOX TO UPDATE----------
    public function searchdata($id)
    {

        $res = array();

        $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id =:id");

        $cmd->bindValue(":id", $id);
        $cmd->execute();

        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    //--------------UPDATE------------
    public function updatedata($id, $nome, $telefone, $email)
    {

        $cmd = $this->pdo->prepare("UPDATE pessoa SET nome = :n, telefone :t , email :e WHERE id= :id");
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":t", $telefone);
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return true;
    }
}
