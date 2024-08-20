<?php
include_once('quadrado.php');
     /**
      *  string $sdn,
      * $username = null,
      * $password = null,
      */
     // montar consulta

     /*$sql = "SELECT * FROM pessoa";
     $id = isset($_GET['id'])?$_GET['id']:0;
     if($id > 0){
         $comando = $conexao->prepare($sql);
         $comando->bindValue(':id',$id);
         $comando->execute();
         $contato = $comando->fetch();
     }*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de quadrados</title>
</head>
<body>
<?php
$busca =  isset($_GET['busca'])?$_GET['busca']:0; // pegar busca
$tipo =  isset($_GET['tipo'])?$_GET['tipo']:0; // pegar busca
 $lista = Quadrado::listar($tipo,$busca);?>
    <h2><?=$msg?></h2>
    <! -- formulario de cadastro -- >
    <form action="quadrado.php" method="post">
        <fieldset>
        <label for="id">Id:</label>
        <input type="text" name="id" id="id" value="<?=isset($contato)?$contato->getId():0 ?>" readonly>
        <label for="lado">Lado:</label>
        <input type="number" name="lado" id="lado" value="<?php if (isset($contato)) echo $contato->getLado() ?>">
        <label for="cor">Cor:</label>
        <input type="color" name="cor" id="cor" value="<?php if (isset($contato)) echo $contato->getCor() ?>">
        <label for="un">Unidade</label>
                <select name="un">
                    <option value="">Selecione</option>
                    <?php foreach ($listaUn as $registro) { ?>
                        <option value="<?=$registro->getId()?>"><?=$registro->getDescricao()?></option>
                    <?php } ?>
                </select>
                <?php
                $uns = Quadrado::listar();
                foreach($uns as $un){
                    $str = "<option value='{$un->getId()}";
                    if(isset($forma))
                    if ($forma->getUn()->getId()== $un->getId())
                    $str .= "'>{$un->getUn}</option>"; 
                }
                ?>
        <button type="submit">Salvar</button>
        <button type="reset">Cancelar</button>
    </form>
    </fieldset>
    <hr>
    <! -- formulario de pesquisa -- >
    <form action="" method="get">
        <fieldset>
            <legend>Pesquisa</legend>
    <label for="busca">Busca:</label>
        <input type="text" name="busca" id="busca" value="">
        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo">
            <option value="0">Escolha</option>
            <option value="1">Id</option>
            <option value="2">Lado</option>
            <option value="3">Cor</option>
            <option value="4">Unidade</option>
        </select>
        <button type="submit">Buscar</button>
        </fieldset>
    </form>
    <h1>Lista meus contatos</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>Cor</th>
            <th>Lado</th>
            <th>Unidade</th>
        </tr>
        <?php foreach($lista as $quadrado){ ?>
            <tr>
                <td><a href="listaquadrado.php?id=<?= $quadrado->getId() ?>"><?= $quadrado->getId() ?></a></td>
                <td><?= $quadrado->getLado() ?></td>
                <td><?= $quadrado->getCor() ?></td>
                <td><?= $quadrado->getUn()->getDescricao()?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>