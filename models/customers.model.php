<?php

require_once "connection.php";

class CustomersModel
{
    static public function addCustomer($table, $data)
    {

        $stmt = Connection::connect()->prepare("INSERT INTO $table(name, idDocument, email, phone, address, birthdate) VALUES (:name, :idDocument, :email, :phone, :address, :birthdate)");
        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":idDocument", $data["idDocument"], PDO::PARAM_INT);
        $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt->bindParam(":phone", $data["phone"], PDO::PARAM_STR);
        $stmt->bindParam(":address", $data["address"], PDO::PARAM_STR);
        $stmt->bindParam(":birthdate", $data["birthdate"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    static public function showCustomers($table, $item, $value)
    {
        if ($item != null) {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
        } else {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table");
            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    static public function editCustomer($table, $data)
    {
        $stmt = Connection::connect()->prepare("UPDATE $table SET name = :name, idDocument = :idDocument, email = :email, phone = :phone, address = :address, birthdate = :birthdate WHERE id = :id");

        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":idDocument", $data["idDocument"], PDO::PARAM_INT);
        $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt->bindParam(":phone", $data["phone"], PDO::PARAM_STR);
        $stmt->bindParam(":address", $data["address"], PDO::PARAM_STR);
        $stmt->bindParam(":birthdate", $data["birthdate"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    static public function deleteCustomer($table, $data)
    {
        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");
        $stmt->bindParam(":id", $data, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}
