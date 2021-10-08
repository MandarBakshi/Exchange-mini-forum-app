<?php

require_once "config.php";

$username = $name = $email = $password = $region = $country = $phone_number = $gender = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $region = $_POST['region'];
    $country = $_POST['country'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO users (name, username, email, password, region, country, phone_number, gender) values ('$name', '$username', '$email', '$password', '$region', '$country', '$phone_number', '$gender')";
    $result = mysqli_query($conn, $sql);

    $sql_check = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
    $result_check = mysqli_query($conn, $sql_check);
    $num_result_check = mysqli_num_rows($result_check);

    if ($num_result_check == 1) {
        header("Location: login.php");
    } else {
        echo "error inserting values";
    }
} else {
    echo "some problem with server";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange - Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>


</head>

<body>
    <div class="container">
        <h1>Register</h1> <br>

        <div class="alert alert-danger" role="alert">
            <p>Keep in mind, your Username and Email should be unique.</p>
            <p><b>One Username can have only one Email</b></p>
        </div>

        <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>

            <div>
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>

            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <div class="col-md-6">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
            </div>

            <div class="col-md-6">
                <label for="region" class="form-label">Select Region</label>
                <select name="region" id="region" class="form-select">
                    <?php $i = 1;
                    $region_dropdown = ""; ?>
                    <?php while ($i <= 5) : ?>
                        <?php echo "<option value='Region #{$i}'>Region #{$i}</option>"; ?>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="country" class="form-label">Select Country</label>
                <select name="country" id="country" class="form-select">
                    <?php $i = 1;
                    $country_dropdown = ""; ?>
                    <?php while ($i <= 10) : ?>
                        <?php echo "<option value='country #{$i}'>country #{$i}</option>"; ?>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number" required>
            </div>

            <div class="col-md-4">
                <label for="gender" class="form-label">Select Gender</label>
                <select name="gender" id="gender" class="form-select">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>


            <input type="submit" class="btn btn-primary" value="Register">
        </form>

    </div>
</body>

</html>