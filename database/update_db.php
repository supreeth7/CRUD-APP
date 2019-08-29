<?php

require_once 'config.php';

$name = $domain = $salary = "";
$name_err = $domain_err = $salary_err = "";
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $input_name = trim($_POST['name']);
    $input_domain = trim($_POST['domain']);
    $input_salary = trim($_POST['salary']);
    
    if (empty($input_name)) {
        $name_err = "Please enter a valid name";
    } else {
        $name = $input_name;
    }
    
    if (empty($input_domain)) {
        $domain_err = "Please enter a valid domain";
    } else {
        $domain = $input_domain;
    }
    
    if (empty($input_salary)) {
        $salary_err = "Please enter a valid name";
    } else {
        $salary = $input_salary;
    }
    
    if (empty($name_err) && empty($domain_err) && empty($salary_err)) {
        $statement = "UPDATE employees SET name=?, domain=?, salary=? WHERE id=?";
        $q = $pdo->prepare($statement);
        if ($q->execute([$name,$domain,$salary,$id])) {
            header("Location: index.php");
            exit();
        } else {
            echo "Something went wrong! " . $pdo->errorCode();
        }
    
        unset($q);
    }
    
    unset($pdo);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM employees WHERE id = ?";
        if ($stmt = $pdo->prepare($sql)) {
            
            // Attempt to execute the prepared statement
            if ($stmt->execute([$id])) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $name = $row["name"];
                    $domain = $row["domain"];
                    $salary = $row["salary"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
