<?php
    session_start();
    include_once('./CreateAndPopulateUsersTable.php');

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);

    $sql = "SELECT * FROM users WHERE (loginId = '$username' AND `password` = '$password')";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $row['userName'];
        $_SESSION['userId'] = $row['User_id'];
        $_SESSION['failedLogin'] = false;
    }
    else{
        $_SESSION['failedLogin'] = true;
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>