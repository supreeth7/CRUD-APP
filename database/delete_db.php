<?php

require_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (!empty($id)) {
        $statement = "DELETE FROM employees WHERE id=".$id;
        $query = $pdo->prepare($statement);
        if ($query->execute()) {
            header("Location: http://".$_SERVER['HTTP_HOST']. "/CRUD-APP/index.php");
            exit();
        } else {
            echo "Query processing error" . $pdo->errorInfo();
        }
    } else {
        echo("ID should not be empty field!");
    }
}
