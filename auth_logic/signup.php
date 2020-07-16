<?php

if (isset($_POST['sign-up-btn'])) {
    require 'db.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    if (empty($name) || empty($email) || empty($pwd)) {
        header('location: ../index.php?error=emptyfields&name=' . $name . '&email=' . $email);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]*$/', $name)) {
        header('location: ../index.php?error=invalidnameemail');
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: ../index.php?error=invalidemail&name=' . $name);
        exit();
    } else if (!preg_match('/^[a-zA-Z0-9]*$/', $name)) {
        header('location: ../index.php?error=invalidname&email=' . $email);
        exit();
    } else {
        $stmt = mysqli_stmt_init($conn);
        $sql = 'SELECT emailUsers FROM users WHERE emailUsers = ?';

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('location: ../index.php?error=sqlerror&name=' . $name . '&email=' . $email);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header('location: ../index.php?error=emailtaken&name=' . $name . '&email=' . $email);
                exit();
            } else {
                $sql = 'INSERT INTO users (nameUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)';
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header('location: ../index.php?error=sqlerror&email=' . $email);
                    exit();
                } else {

                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header('location: ../index.php?signup=success');
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header('location: ../index.php');
    exit();
}
