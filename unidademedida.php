<?php

require_once("../classes/unidademedida.class.php");

$id =  isset($_GET['id'])?$_GET['id']:0; // pegar busca
$msg =  isset($_GET['MSG'])?$_GET['MSG']:""; // pegar busca
if ($id > 0){
    $contato = UnidadeMedida::listar(1,$id)[0]; // cria a variável contato que será utilizada para preencher o formulário quando o usuário clicar para alterar um registro
}
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id= isset($_POST['id'])? $_POST['id']:0; 
        $descricao= isset($_POST['descricao'])? $_POST['descricao']:0; 
        $un= isset($_POST['un'])? $_POST['un']:0; 
        $acao =  isset($_POST['acao'])?$_POST['acao']:0; 
     
        try{
            $un = UnidadeMedida::listar(1,$un)[0];
                    $quadrado = new UnidadeMedida
            ($id,$descricao,$un);
                    
                $resultado = "";
                if($acao == 'salvar'){
                    if($id > 0)//alterando
                        // chamar o método para alterar uma quadrado
                        $resultado = $quadrado->editar();
                    else // inserindo                        
                        // chamar o método para incluir uma quadrado
                        $resultado = $quadrado->inserir();
                }elseif ($acao == 'excluir'){
                    // chamar o método para exluir uma quadrado
                    $resultado = $quadrado->excluir();
                }
                

                if ($resultado)
                    header('location: listapessoas.php');
                else
                    echo "erro ao inserir dados!";
     
    }  catch(Exception $e){
        header('location: listapessoas.php?MSG=Erro:'.$e->getMessage());
    }
 } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

    //  Listagem e Pesquisa
    $busca =  isset($_GET['busca'])?$_GET['busca']:0; // pegar busca
    $tipo =  isset($_GET['tipo'])?$_GET['tipo']:0; // pegar busca
    $lista = UnidadeMedida::listar($tipo,$busca);
}
     

         
     ?>