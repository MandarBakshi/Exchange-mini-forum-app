<?php


// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";


$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];

$sql = "SELECT * FROM posts ORDER BY posted_on DESC";
$result = mysqli_query($conn, $sql);
$rowCount = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    <title>Home Page</title>
</head>

<body>

    <div id="navbar_fixed_top">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="Resources/Images/logo_1.svg" alt="" width="30" height="30" class="d-inline-block align-text-top">
                    <b>Exchange</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Downloads</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span style="color: #f0932b;"><b>Hello, <?php echo $name; ?></b></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Account settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <br><br><br>
    <h1>Welcome back, <b><span style="color: #6c5ce7;"> <?php echo $name; ?> </span></b> </h1> <br>

    <div id="posts_section" class="container">

        <div class="row g-3">
            <h1 class="col-md-4">Latest Posts</h1>
            <div class="col-md-4">
                <a href="createPost.php" class="btn btn-primary">Create New Post</a>
            </div>
        </div>

        <div class="container">
            <?php $wordCount = 50;
            $post_content_1; ?>
            <?php while ($row = mysqli_fetch_array($result)) : ?>
                <div class="card">
                    <div class="card-header">
                        <span style="color: blue;">@<?php echo $row['user_id'] ?></span>, <?php echo $row['posted_on'] ?>
                    </div>
                    <h3 class="card-header"> <b><?php echo $row['post_title']; ?></b> </h3>
                    <div class="card-body">
                        <?php $post_content_1 = $row['post_content']; ?>
                        <?php if (str_word_count($post_content_1) >= $wordCount) {
                            $post_content_2 = substr($post_content_1, 0, 250) . '...';
                        } else {
                            $post_content_2 = $row['post_content'];
                        } ?>
                        <p class="card-text"> <?php echo $post_content_2; ?> </p>
                        <?php echo "<a href='post_details.php?ID={$row['post_id']}' class='btn btn-outline-primary'>Read more</a>"; ?>

                    </div>
                </div>
                <br>
            <?php endwhile; ?>
        </div>

    </div>



</body>

</html>