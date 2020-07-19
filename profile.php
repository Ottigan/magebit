<?php
// Limiting access to logged in users by fetching 
// the global $_SESSION variable
session_start();
if (!isset($_SESSION['id'])) {
    header('location: index.php');
    exit();
} else {
    require 'auth_logic/db.php';

    // Fetch all the current Attributes for the currently logged in USER
    $stmt = mysqli_stmt_init($conn);
    $sql = 'SELECT * FROM attributes WHERE user = ?';
    $attributes;

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: profile.php');
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
        mysqli_stmt_execute($stmt);
        $attributes = mysqli_stmt_get_result($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles/profile.css?" type="text/css">
</head>

<body>
    <header>
        <!-- Correctly ending users SESSION -->
        <form action="auth_logic/logout.php" method="POST">
            <button class="log-out-btn button" type="submit">Log Out</button>
        </form>
    </header>
    <main class="main-container">
        <div class="dark-container">
            <!-- Personalizwed header based on currentyl logged in users chosen name -->
            <?php
            echo "<h1>About $_SESSION[name]</h1>";
            ?>
            <span class="under-line"></span>
            <form class="add-attribute-form" action="profile_logic/add_attrib.php" method="GET">
                <span>
                    <input id="input-attribute" type='text' name='attribute' maxlength="20" autocomplete="off" required>
                    <label for="input-attribute">Characteristic</label>
                </span>
                <span>
                    <input id="input-value" type='text' name='value' autocomplete="off" required>
                    <label for="input-value">Description</label>
                </span>
                <button class="button" type="submit" name="add-attribute-btn">Add</button>
            </form>
            <table>
                <tbody>
                    <!-- Populating the table with attributes added to DB -->
                    <?php while ($row = mysqli_fetch_array($attributes)) { ?>
                        <tr <?php echo "id='row-$row[id]'" ?>>
                            <?php echo "<td id='attribute-$row[id]'>$row[attribute]</td>" ?>
                            <?php echo "<td id='attribValue-$row[id]'>$row[attribValue]</td>" ?>
                            <td>
                                <a <?php echo "id='$row[id]' class='edit' href='#'" ?>>Edit</a>
                                <a <?php echo "class='remove' href='profile_logic/remove_attrib.php?remove=$row[id];'" ?>>Remove</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Disclaimer  -->
    <footer>
        <h5>ALL RIGHTS RESERVED "MAGEBIT" 2016.</h5>
    </footer>
    <script src="js/profile.js"></script>
</body>

</html>