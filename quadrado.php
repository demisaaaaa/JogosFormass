<?php

require_once("../classes/quadrado.class.php");
require_once("../classes/unidademedida.class.php");

$id =  isset($_GET['id'])?$_GET['id']:0; // pegar busca
$msg =  isset($_GET['MSG'])?$_GET['MSG']:""; // pegar busca
if ($id > 0){
    $contato = Quadrado::listar(1,$id)[0]; // cria a variável contato que será utilizada para preencher o formulário quando o usuário clicar para alterar um registro
}
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id= isset($_POST['id'])? $_POST['id']:0; 
        $lado= isset($_POST['lado'])? $_POST['lado']:0; 
        $cor= isset($_POST['cor'])? $_POST['cor']:0; 
        $un= isset($_POST['un'])? $_POST['un']:0; 
        $acao =  isset($_POST['acao'])?$_POST['acao']:0; 
     
        try{
            
            $pun = UnidadeMedida::listar(1,$un)[0]; 
            $quadrado = new Quadrado($id,$lado,$cor,$pun);
                    
                $resultado = "";
                if($acao == 'salvar'){
                    if($id > 0)//alterando
                        // chamar o método para alterar uma quadrado
                        $resultado = $quadrado->alterar();
                    else // inserindo   
                    // chamar o método para incluir uma quadrado
                    $resultado = $quadrado->incluir(); 
                }elseif ($acao == 'excluir'){
                    // chamar o método para exluir uma quadrado
                    $resultado = $quadrado->excluir();
                }
            header("Location: listaquadrado.php");
              /* if ($resultado)
                    header('location: listaquadrado.php');
                else
                    echo "erro ao inserir dados!";*/
     
    }  catch(Exception $e){
       // header('location: listaquadrado.php?MSG=Erro:'.$e->getMessage());
      echo $e->getMessage();
    }
 } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

    //  Listagem e Pesquisa
    $busca =  isset($_GET['busca'])?$_GET['busca']:0; // pegar busca
    $tipo =  isset($_GET['tipo'])?$_GET['tipo']:0; // pegar busca
    $listaUn = UnidadeMedida::listar(0, "");
    $lista = Quadrado::listar($tipo,$busca);
}
     

         
     ?>