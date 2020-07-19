<?php
// Edit/Save item
if (isset($_GET['edit'])) {
    session_start();
    require '../auth_logic/db.php';

    $id = $_GET['edit'];
    $attribute = $_GET['attribute'];
    $value = $_GET['attribValue'];
    $stmt = mysqli_stmt_init($conn);
    $sql = 'UPDATE attributes SET attribute = ?, attribValue = ? WHERE id = ?';

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../profile.php');
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, 'ssi', $attribute,  $value, $id);
        mysqli_stmt_execute($stmt);
        header('location: ../profile.php');
        exit();
    }
} else {
    header('location: ../profile.php');
    exit();
}
