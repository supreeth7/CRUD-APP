<?php

require_once 'config.php';

$name = $domain = $salary = "";
$name_err = $domain_err = $salary_err = "";

if ($_SERVER['REQUEST_METHOD']=="POST") {
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
        $statement = "INSERT INTO employees (name,domain,salary) VALUES (?,?,?)";
        $q = $pdo->prepare($statement);
        if ($q->execute([$name,$domain,$salary])) {
            header("Location: index.php");
            exit();
        } else {
            echo "Something went wrong! " . $pdo->errorCode();
        }

        unset($q);
    }

    unset($pdo);
}
