<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";

// $username = $name = $email = $password = $region = $country = $phone_number = $gender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    // $password = $_POST['password'];
    // $region = $_POST['region'];
    // $country = $_POST['country'];
    // $phone_number = $_POST['phone_number'];
    // $gender = $_POST['gender'];
    $userID = $_SESSION['user_id'];
    $post_title = $_POST['post_title'];
    $post_content = $_POST['post_content'];
    // $posted_on = $_POST['posted_on'];
    $posted_on = date('Y/m/d H:i:s');

    $sql = "INSERT INTO posts (user_id, post_title, post_content, posted_on) values ('$userID', '$post_title', '$post_content', '$posted_on')";
    $result = mysqli_query($conn, $sql);

    $sql_check = "SELECT * FROM posts WHERE post_title = '$post_title' and post_content = '$post_content'";
    $result_check = mysqli_query($conn, $sql_check);
    $num_result_check = mysqli_num_rows($result_check);

    if ($num_result_check >= 1) {
        header("Location: home.php");
    } else {
        echo "error creating post";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <title>Create Post</title>
</head>

<body>

    <div class="container">
        <h1>Create New Post</h1> <br>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="mb-3">
                <label for="post_title" class="form-label">Post Title</label>
                <h3>
                    <input type="text" class="form-control" name="post_title" id="post_title" placeholder="Post Title">
                </h3>
            </div>
            <div class="mb-3">
                <label for="post_content" class="form-label">Post Content</label>
                <textarea class="form-control" name="post_content" id="post_content" rows="7"></textarea>
            </div>

            <input type="submit" class="btn btn-primary" value="Create Post">

        </form>

    </div>
</body>

</html>