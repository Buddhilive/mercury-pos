<?php

class CustomersController
{
    static public function createCustomer()
    {
        if (isset($_POST["newCustomer"])) {
            if (
                preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["newCustomer"]) &&
                preg_match('/^[0-9]+$/', $_POST["newIdDocument"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["newEmail"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["newPhone"]) &&
                preg_match('/^[#\.\-\/\,a-zA-Z0-9 ]+$/', $_POST["newAddress"])
            ) {
                $table = "mp_customers";

                $data = array(
                    "name" => $_POST["newCustomer"],
                    "idDocument" => $_POST["newIdDocument"],
                    "email" => $_POST["newEmail"],
                    "phone" => $_POST["newPhone"],
                    "address" => $_POST["newAddress"],
                    "birthdate" => $_POST["newBirthdate"]
                );

                $answer = CustomersModel::addCustomer($table, $data);

                if ($answer == "ok") {
                    echo '<script>
					Swal.fire({
						  type: "success",
						  title: "The customer has been saved",
						  showConfirmButton: true,
						  confirmButtonText: "Ok"
						  }).then(function(result){
									if (result.value) {
									window.location = "customers";
									}
								})
					</script>';
                }
            } else {
                echo '<script>
					Swal.fire({
						  type: "error",
						  title: "Customer cannot be blank or especial characters!",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {
							window.location = "customers";
							}
						})
			  	</script>';
            }
        }
    }

    static public function showCustomers($item, $value)
    {
        $table = "mp_customers";
        $answer = CustomersModel::showCustomers($table, $item, $value);

        return $answer;
    }

    static public function editCustomer()
    {
        if (isset($_POST["editCustomer"])) {
            if (
                preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editCustomer"]) &&
                preg_match('/^[0-9]+$/', $_POST["editIdDocument"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editEmail"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["editPhone"]) &&
                preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editAddress"])
            ) {
                $table = "mp_customers";

                $data = array(
                    "id" => $_POST["idCustomer"],
                    "name" => $_POST["editCustomer"],
                    "idDocument" => $_POST["editIdDocument"],
                    "email" => $_POST["editEmail"],
                    "phone" => $_POST["editPhone"],
                    "address" => $_POST["editAddress"],
                    "birthdate" => $_POST["editBirthdate"]
                );

                $answer = CustomersModel::editCustomer($table, $data);

                if ($answer == "ok") {
                    echo '<script>
					Swal.fire({
						  type: "success",
						  title: "The customer has been edited",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
									if (result.value) {
									window.location = "customers";
									}
								})
					</script>';
                }
            } else {
                echo '<script>
					Swal.fire({
						  type: "error",
						  title: "¡Customer cannot be blank or especial characters!",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {
							window.location = "customers";
							}
						});
			  	</script>';
            }
        }
    }

    static public function deleteCustomer()
    {
        if (isset($_GET["idCustomer"])) {
            $table = "mp_customers";
            $data = $_GET["idCustomer"];

            $answer = CustomersModel::deleteCustomer($table, $data);

            if ($answer == "ok") {
                echo '<script>
				Swal.fire({
					  type: "success",
					  title: "The customer has been deleted",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then(function(result){
								if (result.value) {
								window.location = "customers";
								}
							});
				</script>';
            }
        }
    }
}
