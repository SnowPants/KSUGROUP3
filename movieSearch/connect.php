<!DOCTYPE html>
<html>
    
<head>
    <title>Find A Movie</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <style>
        /* Add spacing between table rows */
        table {
            width: 100%; /* Ensure the table takes up the full width of its container */
        }

        table th,
        table td {
            padding: 10px;
            text-align: center; /* Center-align the content within each cell */
        }

        /* Set equal width for each column */
        table th,
        table td {
            width: 25%; /* Set each column to occupy 25% of the table width */
        }
    </style>

</head>

<body>

<h3><a onclick = "history.back()"><< Back to Search</a></h3>

<div class="container">
            <div class="row col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <h1>Search Results</h1>
                    </div>
                    <div class="panel-body">
                        <?php
                        
                        // Un-comment below switch statement for connection status debug

                        // switch (connection_status())
                        // {
                        // case CONNECTION_NORMAL:
                        //   $txt = 'Connection is in a normal state';
                        //   break;
                        // case CONNECTION_ABORTED:
                        //   $txt = 'Connection aborted';
                        //   break;
                        // case CONNECTION_TIMEOUT:
                        //   $txt = 'Connection timed out';
                        //   break;
                        // case (CONNECTION_ABORTED & CONNECTION_TIMEOUT):
                        //   $txt = 'Connection aborted and timed out';
                        //   break;
                        // default:
                        //   $txt = 'Unknown';
                        //   break;
                        // }
                        // echo $txt;


                        //Collect HTML form data.  "name" and "password" should be same as in the Form definition in HTML (name="name" and name="password" )
                        $searched_movieRating = $_POST['searched_movieRating'];
                        $searched_movieGenre = $_POST['searched_movieGenre'];

                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "test";
                        
                        // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);

                        // Check connection
                        if($conn->connect_error){
                            echo "$conn->connect_error";
                            die("Connection Failed : ". $conn->connect_error);
                        } 
                        
                        if ($searched_movieGenre == 'noPref' and $searched_movieRating == 'noPref') {
                            $sql = "SELECT Movie.MovieID, Movie.MovieTitle, Movie.MovieRated, Director.DirectorName 
                                    FROM Movie
                                    JOIN Director ON Movie.DirectorID = Director.DirectorID";
                        } else if ($searched_movieRating == 'noPref') {
                            $sql = "SELECT Movie.MovieID, Movie.MovieTitle, Movie.MovieRated, Director.DirectorName 
                                    FROM Movie
                                    JOIN Genre ON Movie.GenreID = Genre.GenreID
                                    JOIN Director ON Movie.DirectorID = Director.DirectorID
                                    WHERE Genre.GenreType LIKE '$searched_movieGenre'";
                        } else if ($searched_movieGenre == 'noPref') {
                            $sql = "SELECT Movie.MovieID, Movie.MovieTitle, Movie.MovieRated, Director.DirectorName 
                                    FROM Movie
                                    JOIN Genre ON Movie.GenreID = Genre.GenreID
                                    JOIN Director ON Movie.DirectorID = Director.DirectorID
                                    WHERE Movie.MovieRated LIKE '$searched_movieRating'";
                        } else {
                            $sql = "SELECT Movie.MovieID, Movie.MovieTitle, Movie.MovieRated, Director.DirectorName 
                                    FROM Movie
                                    JOIN Genre ON Movie.GenreID = Genre.GenreID
                                    JOIN Director ON Movie.DirectorID = Director.DirectorID
                                    WHERE Genre.GenreType = '$searched_movieGenre'
                                    AND Movie.MovieRated = '$searched_movieRating'";
                        }                      

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output row header labels
                            echo "<table><tr><th>&emsp;&emsp;</th> <th>Movie Name&emsp;</th> <th>Movie Rating&emsp;</th> <th>Directed By&emsp;</th> </tr>";
                            // output data of each row

                            while ($row = $result->fetch_assoc()) {
                                $imagePath = "../../KSUGROUP3-main/library/" . $row["MovieID"] . ".jpg";
                                echo "<tr><td><img src='" . $imagePath . "' style='width: 100px; border: 5px solid;'></td><td>" . $row["MovieTitle"] . "</td><td>" . $row["MovieRated"] . "</td><td>" . $row["DirectorName"] . "</td></tr>";
                                echo "<tr><td colspan='4'><hr></td></tr>"; // Add a line after each row
                            }
                            echo "</table>";
                        } else {
                            echo "0 results";
                        }

                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>
