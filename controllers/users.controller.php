<?php

class UserController
{
    static public function ctrInitUserLogin()
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

    static public function createUser()
    {
        if (isset($_POST["newUser"])) {

            if (
                preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["newName"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUser"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPasswd"])
            ) {
                $table = 'mp_users';

                $encryptpass = crypt($_POST["newPasswd"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $data = array(
                    'name' => $_POST["newName"],
                    'user' => $_POST["newUser"],
                    'password' => $encryptpass,
                    'profile' => $_POST["newProfile"]
                );

                $answer = UsersModel::addUser($table, $data);

                var_dump($answer);

                if ($answer == 'ok') {
                    echo '<script>                 
                    Swal.fire({
                        type: "success",
                        title: "User added succesfully!",
                        showConfirmButton: true,
                        confirmButtonText: "Close"

                    }).then(function(result){
                        if(result.value){

                            window.location = "users";
                        }
                    });                   
                    </script>';
                } else {
                    echo '<script>					
					Swal.fire({
						type: "error",
						title: "Adding user unsuccessful. Try again later.,
						showConfirmButton: true,
						confirmButtonText: "Close"		
						}).then(function(result){
						if(result.value){
								window.location = "users";
							}
						});					
				    </script>';
                }
            } else {
                echo '<script>					
					Swal.fire({
						type: "error",
						title: "No especial characters or blank fields",
						showConfirmButton: true,
						confirmButtonText: "Close"		
						}).then(function(result){
						if(result.value){
								window.location = "users";
							}
						});					
				</script>';
            }
        }
    }
}
