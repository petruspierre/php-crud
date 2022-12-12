<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
    $pdo = new PDO("mysql:host=localhost;dbname=phpcrud", "root", "");

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $sql = $pdo->prepare("SELECT * FROM pessoas WHERE id = $id");
        $sql->execute();
        $pessoas = $sql->fetchAll();

        foreach ($pessoas as $aluno) {
            $nome = $aluno['nome'];
            $email = $aluno['email'];
            $cpf = $aluno['cpf'];

            echo "
                <div class=\"container\">
                    <form method=\"POST\" max-width=\"80%\">
                        <legend>
                            <h2 class=\"row justify-content-center\">Editar dados da pessoa $id</h2>
                        </legend>

                        <fieldset>
                            <label for=\"input-nome\">Nome:</label>
                            <input value=\"$nome\" type=\"text\" name=\"nome\" id=\"input-nome\" class=\"form-control\">
                        </fieldset>
                        <fieldset>
                            <label for=\"input-email\">Email:</label>
                            <input value=\"$email\" type=\"email\" name=\"email\" id=\"input-email\" class=\"form-control\">
                        </fieldset>
                        <fieldset>
                            <label for=\"input-cpf\">CPF:</label>
                            <input value=\"$cpf\" type=\"text\" name=\"cpf\" id=\"cpf\" class=\"form-control\">
                        </fieldset>

                        <div class=\"mt-2\">
                            <input type=\"submit\" class=\"btn btn-primary\" value=\"Editar\">

                            <a href=\"index.php\">Voltar</a>
                        </div>
                    </form>
                </div>
            ";
        }
    }

    if (isset($_POST['nome'])) {
        $id = (int)$_GET['id'];
        $sql = $pdo->prepare("UPDATE pessoas SET nome = ?, email = ?, cpf = ? WHERE id = $id");
        $sql -> execute(array($_POST['nome'], $_POST['email'], $_POST['cpf']));
        header("Location: index.php");
    }
?>