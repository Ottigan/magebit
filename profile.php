<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: index.php');
    exit();
} else {
    require 'auth_logic/db.php';

    if (isset($_GET['add-attribute-btn']) && !empty($_GET['attribute']) && !empty($_GET['value'])) {
        $user = $_SESSION['id'];
        $attribute = $_GET['attribute'];
        $value = $_GET['value'];
        mysqli_query(
            $conn,
            "INSERT INTO attributes (attribute, attribValue, user)
             VALUES ('$attribute', '$value', '$user')"
        );
        header('location: profile.php');
    }

    // Remove item
    if (isset($_GET['remove'])) {
        $id = $_GET['remove'];
        mysqli_query($conn, "DELETE FROM attributes WHERE id = $id");
        header('location: profile.php');
    }

    $attributes = mysqli_query($conn, "SELECT * FROM attributes WHERE user = $_SESSION[id]");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles/profile.css">
</head>

<body>
    <header>
        <form action="auth_logic/logout.php" method="POST">
            <?php
            echo "<p>Welcome, $_SESSION[name]</p>";
            ?>
            <button class="log-out-btn button" type="submit">Log Out</button>
        </form>
    </header>

    <main class="main-container">
        <div class="dark-container">
            <form class="add-attribute-form" action="profile.php" method="GET">
                <span>
                    <label>Attribute</label><br>
                    <input type='text' name='attribute' autocomplete="off">
                </span><br>
                <span>
                    <label>Description</label><br>
                    <input type='text' name='value' autocomplete="off">
                </span>
                <button class="button" type="submit" name="add-attribute-btn">Add</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Characteristics</th>
                        <th>Values</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($attributes)) { ?>
                        <tr>
                            <td><?php echo $row['attribute'] ?></td>
                            <td><?php echo $row['attribValue'] ?></td>
                            <td>
                                <a href="profile.php?remove=<?php echo $row['id']; ?>">Remove</a>
                                <a href="profile.php?edit=<?php echo $row['id']; ?>">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </main>
    <footer>
        <h5>ALL RIGHTS RESERVED "MAGEBIT" 2016.</h5>
    </footer>
</body>

</html>