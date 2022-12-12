<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CRUD em PHP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <?php
        $pdo = new PDO("mysql:host=localhost;dbname=phpcrud", "root", "");
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['excluir'])) {
            $id_pessoa = (int) $_GET['excluir'];
            $pdo -> exec("DELETE FROM pessoas WHERE id = $id_pessoa");

            header("Location: index.php");
        }

        if (isset($_POST['nome'])) {
            $sql = $pdo -> prepare("INSERT INTO `pessoas` VALUES (null, ?, ?, ?)");
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $cpf = $_POST['cpf'];
            $sql -> execute(array($nome, $email, $cpf));

            echo "
                <div class=\"alert alert-success\" role=\"alert\">
                    $nome foi adicionado com sucesso!
                </div>
            ";
        }
    ?>

    <div class="container">
        <form method="POST" max-width="80%">
            <legend>
                <h2 class="row justify-content-center">Insira os dados abaixo</h2>
            </legend>

            <fieldset>
                <label for="input-nome">Nome:</label>
                <input type="text" name="nome" id="input-nome" class="form-control">
            </fieldset>
            <fieldset>
                <label for="input-email">Email:</label>
                <input type="email" name="email" id="input-email" class="form-control">
            </fieldset>
            <fieldset>
                <label for="input-cpf">CPF:</label>
                <input type="text" name="cpf" id="cpf" class="form-control">
            </fieldset>

            <div class="mt-2">
                <input type="submit" class="btn btn-primary" value="Enviar">

                <input type="reset" class="btn" value="Cancelar">
            </div>
        </form>
    </div>

    <br>
    <?php
        $sql = $pdo->prepare("SELECT * FROM `pessoas`");
        $sql->execute();
        $pessoas = $sql->fetchAll();
        echo "
            <div class='container d-flex justify-content-center'>
                <div class='w-100'>
                    <table class= 'table table-striped table-sm table-hover'>
                        <thead class='table-bordered table-info'>
                            <tr>
                                <th scope='col' class='text-center'>Nome</th>
                                <th scope='col' class='text-center'>E-mail</th>
                                <th scope='col' class='text-center'>CPF</th>
                                <th scope='col' colspan='2' class='text-center'>Ações</th>
                            </tr>
                        </thead>
                        <tbody class='table-striped'>
        ";
        foreach ($pessoas as $pessoa) {
            $id = $pessoa['id'];
            $nome = $pessoa['nome'];
            $email = $pessoa['email'];
            $cpf = $pessoa['cpf'];
            echo "
                            <tr>
                                <td align=center>$nome</td>
                                <td align=center>$email</td>
                                <td align=center>$cpf</td>
                                <td align=center>
                                    <a href=\"?excluir=$id\">( X )</a>
                                </td>
                                <td align=center>
                                    <a href=\"alterar.php?id=$id\">( Alterar )</a>
                                </td>
                            </tr>
            ";
        }
        echo "
                        </tbody>
                    </table>
                </div> 
            </div>
        "
    ?>
</body>
</html>