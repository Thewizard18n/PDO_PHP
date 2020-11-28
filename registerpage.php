<?php
            //require php archive
            require_once 'class-people.php';
            //create variable to receive the class
            $p= new people("CRUDPDO","localhost","root","");

            ?>

            <!DOCTYPE html>
            <html lang= "pt-br">
            <head>
            <meta charset ="utf-8">
            <title>REGISTER</title>
            <link rel = "stylesheet" href= "style.css">
            </head>
            <body>
                <?php
                //----------METHOD POST REGISTER AND GET UPDATE--------
               if(isset($_POST['nome']))
               {
                     
                    if(isset($_GET['id_up']) && !empty($_GET['id_up']))
                    {
                    
                    $id_upd= addslashes($_GET['id_up']);
                    $nome = addslashes($_POST['nome']);
                    $telefone =addslashes($_POST['telefone']);
                    $email =addslashes($_POST['email']);
                     
                   if (!empty($nome) && !empty ($telefone) && !empty($email)) 
                   {
                         
                         $p->updatedata($id_upd,$nome,$telefone,$email);
                         header ("location:index.php");

                        } else
                        {
                        echo " preencha todos os campos!";

                        }

                    
                    }else{
                 
                $nome = addslashes($_POST['nome']);
                $telefone =addslashes($_POST['telefone']);
                $email =addslashes($_POST['email']);
                 
                if (!empty($nome) && !empty ($telefone) && !empty($email)) {
                 
                if (!$p->registerpeople($nome,$telefone,$email)){

                echo "email ja foi cadastrado!";

                }
            



                }else

                {
                echo " preencha todos os campos!";

                }


                }

                ?>
                
                <?php
                 
                 if (isset($_GET['id_up'])) 
                 {
                     
                    $idupdate= addslashes($_GET['id_up']);
                    $res= $p->searchdata($idupdate);
                    

                 }
 

                ?>

            <section id="esquerda">
            <form method ="POST">
            <h2>REGISTER</h2>
            <label for="nome" >Nome</label>
            <input type="text" name="nome"id ="nome"
            value="<?php if (isset($res)){echo $res['nome'];}?>"
            >
            <label for="telefone" >Telefone</label>
            <input type = "text"name="telefone"id ="telefone"
            value="<?php if (isset($res)){echo $res['telefone'];}?>"
            >
            <label for="email" >Email</label>
            <input type= "email"name="email"id ="email"
            value="<?php if (isset($res)){echo $res['email'];}?>"
            >
            <input type = "submit" 
            value = "<?php if(isset($res)){echo "atualizar";}else{
                echo "cadastrar";}?>">





            </form>

            </section>
            <section id= "direita ">
            <table>
                <tr id ="titulo">
                 <td>nome</td>
                 <td>telefone</td>
                 <td colspan="2">email</td>
               </tr>

              <?php
             
            $dados= $p->collectdata();
             
            if (count($dados)>0)
            {
            
            for ($i=0;$i < count ($dados); $i++)
            {
            
            echo "<tr>";
            
            foreach ($dados[$i]as $k => $v)
            {
             
            if($k != "id")
            {
             
            echo "<td>".$v."</td>";

            }

            }
            ?>
            <td>
              <a href="index.php?id_up=<?php echo $dados[$i]['id'];?>">editar</a>
              <a href ="index.php?id=<?php echo $dados[$i]['id'];?>">excluir</a>
            </td>
            <?php
            echo "</tr>";
            }

            }
            else
            { //DB EMPTY
                echo "ainda nao há pessoas cadastradas!";


            }

            ?>         
</table>

</section>

</body>
</html>

<?php

    //-----------------METHOD GET DELETE------------------
    if(isset($_GET['id']))
    {

     
    $id_pessoa = addslashes($_GET['id']);
     
    $p-> deletepeople($id_pessoa);
   
    header ("location: index.php"); 
     
    }  

?> 