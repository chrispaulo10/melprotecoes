<?php

session_start();

// unset($_SESSION['melAdminLogado']);

if (isset($_SESSION['melAdminLogado']) && $_SESSION['melAdminLogado'] === true) {
    require_once "homeAdminMel.html";
} else {
    if (
        isset($_POST["login"]) && isset($_POST["senha"]) &&
        $_POST["login"] == "kelp" && $_POST["senha"] == "123" 
    ) {
        $_SESSION['melAdminLogado'] = true;
        require_once "homeAdminMel.html";
    }

?>

<form method="post">
    <input type="text" name="login" placeholder="login">
    <input type="password" name="senha" placeholder="senha">
    <input type="submit" value="Enviar">
</form>

<?php

}