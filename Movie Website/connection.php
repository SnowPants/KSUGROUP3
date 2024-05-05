<!DOCTYPE html>
<html>
<head>
    <title>User Profile - Movie Finder</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
<div class="container">
    <div class="row col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                <h1>User Profile</h1>
            </div>
            <div class="panel-body">
                <?php
                $servername = "localhost";
                $username = "root";  
                $password = "mysql";  
                $dbname = "movie";  

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if(isset($_POST['userID'])) {
                    $userID = $_POST['userID'];

                    // Prepare and bind
                    $stmt = $conn->prepare("SELECT Users.Name, Users.UserEmail, Users.UserPassword, Users.DateOfBirth, Genre.GenreType FROM Users LEFT JOIN Genre ON Users.GenreID = Genre.GenreID WHERE Users.UserID = ?");
                    $stmt->bind_param("i", $userID);  // 'i' specifies the variable type => 'integer'

                    // Execute the statement
                    $stmt->execute();

                    // Get the result
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Fetch associative array and print results
                        while($row = $result->fetch_assoc()) {
                            echo "<p>Name: " . htmlspecialchars($row["Name"]) . "</p>";
                            echo "<p>Email: " . htmlspecialchars($row["UserEmail"]) . "</p>";
                            echo "<p>Password: " . htmlspecialchars($row["UserPassword"]) . "</p>"; 
                            echo "<p>Date of Birth: " . date("Y-m-d", strtotime($row["DateOfBirth"])) . "</p>";
                            echo "<p>Genre Preference: " . ($row["GenreType"] ? htmlspecialchars($row["GenreType"]) : "No preference") . "</p>";
                        }
                    } else {
                        echo "<p>No user found with ID# $userID.</p>";
                    }

                    $stmt->close();
                }
                $conn->close();
                ?>


                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
