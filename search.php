<?php
$serverName = "localhost";
$username = "root";
$password = "rootpw";
$database = "attiqlab7";

$conn = mysqli_connect($serverName, $username, $password, $database);
session_start();

// variable for when employee isnt found
$notFoundMessage = "";

// check if user has submited a request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get lname from request
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);

    // searches my database
    $query = "SELECT * FROM Employee WHERE LNAME='$lastName'";
    $result = mysqli_query($conn, $query);

    // check results found
    if (mysqli_num_rows($result) > 0) {
        // if found
        header("Location: search_result.php?lastName=" . urlencode($lastName));
        exit();
    } else {
        // if not found
        $notFoundMessage = "Employee not found. Please try again.";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<style>
    body {
        font-family: Verdana, sans-serif;
    }
</style>
    <title>Search Employee</title>
</head>
<body>
    <div class="tail-cont">
        <div class="indent">
            <div class="indent1">
                <center>
                <h2>Employee Search</h2> 
                    <form action="" method="post"> <!--prints out prompt to user & grabs it -->
                        <label for="lastName">Please enter a last name</label>
                        <br><br>
                        <input type="text" id="lastName" name="lastName" required>
                        <input type="submit" value="Search">
                        <input type="reset" value="Reset">
                    </form>
                    <!-- not found text appears under the search box-->
                    <?php if (!empty($notFoundMessage)) : ?>
                        <p style="color: red;"><?php echo $notFoundMessage; ?></p>
                        <br> <br>
                    <?php endif; ?>
                </center>
            </div>
        </div>
    </div>
</body>
</html>
