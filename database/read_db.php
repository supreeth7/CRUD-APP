<?php

require_once 'config.php';

if (isset($_GET['id'])) {
    if ($_GET['id']!="") {
        $id = $_GET['id'];
        $statement = "SELECT * FROM employees WHERE id=?";
        $query = $pdo->prepare($statement);
        if ($query->execute([$id])) {
            if ($query->rowCount()==1) {
                $row = $query->fetch(PDO::FETCH_ASSOC);
                $name = $row['name'];
                $domain = $row['domain'];
                $salary = $row['salary'];
            } else {
                echo "insufficient row count";
            }
        } else {
            echo "Query execution failed!";
        }
    }
    unset($statement);
    unset($pdo);
}
