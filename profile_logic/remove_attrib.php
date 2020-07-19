<?php
// Remove item
if (isset($_GET['remove'])) {
    session_start();
    require '../auth_logic/db.php';

    $id = $_GET['remove'];
    $stmt = mysqli_stmt_init($conn);
    $sql = "DELETE FROM attributes WHERE id = ?";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../profile.php');
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        header('location: ../profile.php');
        exit();
    }
} else {
    header('location: ../profile.php');
    exit();
}
