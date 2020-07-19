<?php
// Add new Characteristic/Attribute to DB
if (isset($_GET['add-attribute-btn']) && !empty($_GET['attribute']) && !empty($_GET['value'])) {
    session_start();
    require '../auth_logic/db.php';

    $user = $_SESSION['id'];
    $attribute = $_GET['attribute'];
    $value = $_GET['value'];
    $stmt = mysqli_stmt_init($conn);
    $sql = "INSERT INTO attributes (attribute, attribValue, user)
             VALUES (?, ?, ?)";

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../profile.php');
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, 'ssi', $attribute, $value, $user);
        mysqli_stmt_execute($stmt);
        header('location: ../profile.php');
        exit();
    }
} else {
    header('location: ../profile.php');
    exit();
}
