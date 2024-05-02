<!DOCTYPE html>
<html>
    
<head>
    <title>Find A Movie - Testing</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
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

                        
                        if($searched_movieGenre == 'noPref' and $searched_movieRating == 'noPref'){
                            $sql = "SELECT Movie.MovieTitle, Movie.MovieRated
                            FROM Movie";
                        }
                        else if($searched_movieRating == 'noPref'){
                            $sql = "SELECT Movie.MovieTitle, Movie.MovieRated
                            FROM Movie
                            JOIN Genre ON Movie.GenreID = Genre.GenreID
                            WHERE Genre.GenreType LIKE '$searched_movieGenre'";
                        }
                        else if($searched_movieGenre == 'noPref'){
                            $sql = "SELECT Movie.MovieTitle, Movie.MovieRated
                            FROM Movie
                            JOIN Genre ON Movie.GenreID = Genre.GenreID
                            WHERE Movie.MovieRated LIKE '$searched_movieRating'";
                        }
                        else{
                            $sql = "SELECT Movie.MovieTitle, Movie.MovieRated
                            FROM Movie
                            JOIN Genre ON Movie.GenreID = Genre.GenreID
                            WHERE Genre.GenreType = '$searched_movieGenre'
                            AND Movie.MovieRated = '$searched_movieRating'";
                        }                               

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table><tr><th>Movie Name&emsp;</th><th>Movie Rating&emsp;</th></tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["MovieTitle"]. "</td><td>" . $row["MovieRated"]. "</tr>";
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
