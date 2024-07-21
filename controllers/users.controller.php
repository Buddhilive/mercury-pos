<?php

class UserController
{
    public function ctrInitUserLogin()
    {
        if (isset($_POST["authUsername"])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["authUsername"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["authPassword"])) {
                $table = 'mp_users';
                $item = 'username';
                $value = $_POST["authUsername"];

                $answer = UsersModel::showUsers($table, $item, $value);

                // var_dump($answer);

                if ($answer["username"] == $_POST["authUsername"] && $answer["password"] == $_POST["authPassword"]) {
                    $_SESSION["authSession"] = "ok";
                    header('Location: dashboard');
                    exit;
                } else {
                    echo '<br><div class="alert alert-danger">User or password incorrect</div>';
                }
            }
        }
    }
}
