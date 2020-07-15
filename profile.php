<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: index.php');
    exit();
    echo $_SESSION['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <form action="auth_logic/logout.php" method="POST">
        <button class="button">Log Out</button>
    </form>

    <H1>Hello World!</H1>
</body>

</html>