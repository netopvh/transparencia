<?php

try {
    $conn = new PDO('mysql:host=10.67.116.45;dbname=sesi_ldo', 'sesi', 'd51YuKzyzopck0NO');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $arquivo = fopen($_FILES["csv"]["tmp_name"], 'r');
    $sql = "INSERT INTO CORPOTEC(NOME, CASA, DATA) VALUES (:nome, :casa, now())";
    if(!$arquivo){
        echo "Erro";
    }else{
        while ($valores = fgetcsv($arquivo,2048,";")){
            $stmt = $conn->prepare($sql);
            $stmt->bindParam('nome', $valores[0], PDO::PARAM_);
            $stmt->bindParam('casa', $valores[1], PDO::PARAM_INT);
            $stmt->execute();
        }
    }



} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Cadastro</legend>
        <input type="file" name="csv">
        <input type="hidden" name="sendFile">
        <br><br>
        <button type="submit">Enviar</button>
    </fieldset>
</form>
</body>
</html>
