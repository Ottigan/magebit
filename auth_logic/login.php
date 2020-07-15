<?php

if (isset($_POST['login-btn'])) {
    require 'db.php';

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    if (empty($email) || empty($pwd)) {
        header('location: ../index.php?error=emptyfields&email=' . $email);
        exit();
    } else {
        $stmt = mysqli_stmt_init($conn);
        $sql = 'SELECT * FROM users WHERE emailUsers=?';

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('location: ../index.php?error=sqlerror&email=' . $email);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($pwd, $row['pwdUsers']);
                if ($pwdCheck == false) {
                    header('location: ../index.php?error=wrongpwd');
                    exit();
                } else if ($pwdCheck == true) {
                    session_start();
                    $_SESSION['id'] = $row['idUsers'];
                    $_SESSION['name'] = $row['nameUsers'];

                    header('location: ../profile.php?login=success');
                    exit();
                }
            } else {
                header('location: ../index.php?error=noaccount');
                exit();
            }
        }
    }
} else {
    header('location: ../index.php');
    exit();
}
