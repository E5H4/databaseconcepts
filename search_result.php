<?php
$serverName = "localhost";
$username = "root";
$password = "rootpw";
$database = "attiqlab7"; //my database name

// this makes the connection & makes sure it actually works. otherwise itll fail
$conn = mysqli_connect($serverName, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

// this gets lname
$lastName = mysqli_real_escape_string($conn, $_GET['lastName']);

// searches in db
$query = "SELECT * FROM Employee WHERE LNAME='$lastName'";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!-- i added some visuals to make it pretty (: -->
<head> 
    <title>Search Result</title>
    <style>
        body {
            font-family: Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .tail-cont {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            width: 100%;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="tail-cont">
        <div class="indent">
            <div class="indent1">
                <center>
                    <?php
                    // Display search results
                    if ($result) {
                        echo "<h2>Search Results:</h2>";
                        echo "<table>";
                        echo "<tr><th>First Name</th><th>Last Name</th><th>Sex</th><th>Dno</th></tr>";

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['FNAME'] . "</td>";
                            echo "<td>" . $row['LNAME'] . "</td>";
                            echo "<td>" . $row['SEX'] . "</td>";
                            echo "<td>" . $row['DNO'] . "</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "<h2>No results found</h2>";
                    }
                    ?>

                    <a href="search.php">Search again !</a> <!-- goes back to search page -->
                </center>
            </div>
        </div>
    </div>
</body>
</html>

<?php
// closes db connection
mysqli_close($conn);
?>
