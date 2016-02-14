
<?php
    require_once(dirname(__FILE__)."/src/conection.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $user = User::LogInUser($_POST['email'], $_POST['password']);
        if ($user !== FALSE) {
            $_SESSION['userId'] = $user->getId();
            header("Location: showUser.php?userId=".$user->getId());
        } else {
            echo("Zle dane logowania");
        }
    }
?>


<html>
<head>

</head>
<body>


<fieldset>
    <legend>Logowanie:</legend>
    <form action="login.php" method="post">
        <p>
            <label>
                Email:
                <input type="email" name="email">
            </label>
        </p>
        <p>
            <label>
                Haslo:
                <input type="password" name="password">
            </label>
        </p>
        <p>
            <input type="submit" value="Zaloguj sie">
        </p>
    </form>
</fieldset>

<p>
    <a href='register.php' name='register'>Rejestracja</a>

</p>

</body>
</html>