<?php

class UserController
{
    static public function ctrInitUserLogin()
    {
        if (isset($_POST["authUsername"])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["authUsername"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["authPassword"])) {

                $encryptpass = crypt($_POST["authPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $table = 'mp_users';
                $item = 'username';
                $value = $_POST["authUsername"];

                $answer = UsersModel::showUsers($table, $item, $value);

                // var_dump($answer);

                if ($answer["username"] == $_POST["authUsername"] && $answer["password"] == $encryptpass) {
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

                $photo = "";
			
				if (isset($_FILES["newPhoto"]["tmp_name"])){
					list($width, $height) = getimagesize($_FILES["newPhoto"]["tmp_name"]);
					
					$newWidth = 500;
					$newHeight = 500;

					$folder = "views/uploads/images/users/".$_POST["newUser"];

					mkdir($folder, 0755, true);

					if($_FILES["newPhoto"]["type"] == "image/jpeg"){
						$randomNumber = mt_rand(100,999);						
						$photo = "views/uploads/images/users/".$_POST["newUser"]."/".$randomNumber.".jpg";						
						$srcImage = imagecreatefromjpeg($_FILES["newPhoto"]["tmp_name"]);						
						$destination = imagecreatetruecolor($newWidth, $newHeight);
						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
						imagejpeg($destination, $photo);
					}
					if ($_FILES["newPhoto"]["type"] == "image/png") {
						$randomNumber = mt_rand(100,999);						
						$photo = "views/uploads/images/users/".$_POST["newUser"]."/".$randomNumber.".png";					
						$srcImage = imagecreatefrompng($_FILES["newPhoto"]["tmp_name"]);						
						$destination = imagecreatetruecolor($newWidth, $newHeight);
						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
						imagepng($destination, $photo);
					}
				}

                $data = array(
                    'name' => $_POST["newName"],
                    'user' => $_POST["newUser"],
                    'password' => $encryptpass,
                    'profile' => $_POST["newProfile"],
                    'photo' => $photo
                );

                $answer = UsersModel::addUser($table, $data);

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
