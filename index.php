<?php require_once("../unidademedida/unidademedida.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cadastro de Unidade de Medida</h1>
    <form action="unidademedida.php">
        <label for="id">Id</label>
        <input type="text" name="id" id="id" value="<?=isset($contato)?$contato->getId():0 ?>" readonly>
        <label for="unidade">Unidade</label>
                <select name="unidade">
                    <option value="">px</option>
                    <option value="">mm</option>
                    <option value="">cm</option>
                    <option value="">M</option>
                </select>
        <label for="altura">Altura</label>
        <input type="number" name="altura" id="altura">
        <button type="submit">Salvar</button>
        <button type="reset">Cancelar</button>
    </form>
    <?php 
        foreach ($lista as $registro) {
            echo $registro->getId() . "|" . $registro->getUn() . "<br>";
        }
    ?>
</body>
</html>