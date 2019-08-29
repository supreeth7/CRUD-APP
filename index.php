<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP CRUD APP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Employees Details</h2>
                        <a href="create.php" class="btn btn-success pull-right">Add New Employee</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "database/config.php";
                    
                    // database operations
                    $statement = "SELECT * FROM employees";
                    $result = $pdo->query($statement);
                    if ($result) {
                        if ($result->rowCount()>0) {
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Name</th>";
                            echo "<th>Domain</th>";
                            echo "<th>Salary</th>";
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";

                            echo "<tbody>";
                            while ($row = $result->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['domain'] . "</td>";
                                echo "<td>" . $row['salary'] . "</td>";
                                echo "<td>";
                                echo "<a href = 'read.php?id=" . $row['id'] . "'title='View' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                echo "<a href = 'update.php?id=" . $row['id'] . "'title='Update' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                echo "<a href = 'database/delete_db.php?id=" . $row['id'] . "'title='Delete' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";

                            //free result
                            unset($result);
                        } else {
                            echo "<p class='lead'><em>No records were found. </em> </p>";
                        }
                    } else {
                        echo "ERROR: Could not able to execute $statement. " . $pdo->errorCode();
                    }
                    
                    //close the pdo connection
                    unset($pdo);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>