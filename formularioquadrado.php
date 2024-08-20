<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
   <h3><legend>FORMULARIO</legend></h3> 
    <fieldset>
    <action="quadrado.php" method="post">
        <legend>Dados do Quadrado</legend>
    <fieldset>
    <label for="id">ID</label>
        <input type="text" name="id" id="id"> 
        <label for="lado">Lado</label>
        <input type="color" name="lado" id="lado">
        <label for="cor">Cor</label>
        <input type="color" name="cor" id="">
        <label for="unidade">Unidade</label>
                <select name="unidade">
                    <option value="">Selecione</option>
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
    
        
   
    <button type="submit" name="acao" value="salvar">Salvar</button>
    <button type="submit" name="acao" value="excluir">Excluir</button>
    <button type="submit" name="acao" value="cancelar">Cancelar</button>
    
    </fieldset>
    </form>
    <legend>Pesquisa</legend>
    <br>
    <legend>Lista meus contatos</legend><br>
    <th>Id</th>/
    <th>Cor</th>/
    <th>Tamanho</th>/
    <th>Unidade</th>
</body>
</html>