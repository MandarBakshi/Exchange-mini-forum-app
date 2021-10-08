<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";

if (isset($_GET['ID'])) {
	$post_id = $_GET['ID'];
    $sql = "SELECT * FROM posts WHERE post_id = $post_id";
    $sql_comment = "SELECT * FROM comments WHERE post_id = {$_GET['ID']} ORDER BY posted_on DESC";

    $result = mysqli_query($conn, $sql);
    $result_comment = mysqli_query($conn, $sql_comment);

    $rowCount = mysqli_num_rows($result);
    $rowCount_comment = mysqli_num_rows($result_comment);

    // if post is found
    if ($rowCount == 1) {
        $row = mysqli_fetch_array($result);
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    }
} else {
    header("Location: home.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

</head>

<body>

    <h1>Post Details</h1> <br><br>

    <div>
	<div class = "container">
        <div class="card">
            <div class="card-header">
                <span style="color: blue;">@<?php echo $row['user_id'] ?></span>, <?php echo $row['posted_on'] ?>
            </div>
            <h3 class="card-header"> <b><?php echo $row['post_title']; ?></b> </h3>
            <div class="card-body">
                <p class="card-text"> <?php echo $row['post_content']; ?> </p>
                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
        </div>
		</div>

        <!-- Comments Section -->

        <div class="container">
            <!-- Use Accordian -->
			
			<br><br>

            <div class="accordion" id="comment_section">

                <div class="accordion-item">

                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Comments
                        </button>
                    </h2>

                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <!-- keep comments in cards -->
                            <?php while ($row_comment = mysqli_fetch_array($result_comment)) : ?>
                                <div class="card">
                                    <h5 class="card-header"> @<?php echo $row_comment['user_id'] ?> at <?php echo $row_comment['posted_on'] ?> </h5>
                                    <div class="card-body">
                                        <p class="card-text"> <?php echo $row_comment['comment_content'] ?> </p>
                                    </div>
                                </div> <br>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>

                <!-- ################################################################################################ -->

            </div>

        </div>
    </div>

</body>

</html>