<?php

try{

    $pdo = new PDO("mysql:dbname=projeto_ordenacao_resultado;host=localhost", "root", "");
    
} catch(PDOException $e) {
    echo "ERRO: ".$e->getMessage();
    exit;
}

    if(isset($_GET['ordem']) && !empty($_GET['ordem']) ) {
        $ordem = addslashes($_GET['ordem']);
        $sql = "SELECT * FROM usuarios ORDER BY ".$ordem;    
    } else {
        $ordem = "";
        $sql = "SELECT * FROM usuarios";       
    }

?>
<form method="GET">
    <select name="ordem" onchange="this.form.submit()">
        <option></option>
        <option value="nome" <?php echo ($ordem=="nome")?'selected="selected"':'' ?> >Pelo Nome</option>
        <option value="idade" <?php echo ($ordem=="idade")?'selected="selected"':'' ?> >Por Idade</option>
    </select>
</form>


<!-- Table -->
<table border="1" width="400">

    <thead>
        <tr>
            <th>Nome</th>
            <th>Idade</th>
        </tr>
    </thead>
    <?php

        $sql = $pdo->query($sql);
            if($sql->rowCount() > 0) {
                foreach ($sql->fetchAll() as $usuario ) :
                    ?>
                    <tbody>
                        <tr>
                            <td><?= $usuario['nome']; ?></td>
                            <td><?= $usuario['idade']; ?></td>
                        </tr>
                    </tbody>
                   <?php 
                endforeach;
            }
    ?>

</table>