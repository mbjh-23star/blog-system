<?php
session_start();
$conn = new mysqli("localhost", "root", "", "blog_db");

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin 
            WHERE ad_username='$username' 
            AND ad_password='$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: adminindex.php");
        exit();
    } else {
        $error = "Invalid login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: url("images/bgg.jpg") no-repeat center center/cover;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* overlay */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.55);
}

/* login box */
.login-box {
    position: relative;
    width: 360px;
    background: rgba(255,255,255,0.95);
    padding: 40px 35px;
    border-radius: 14px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.35);

    /* 🔥 THIS FIXES YOUR SHIFT ISSUE */
    display: flex;
    flex-direction: column;
    align-items: stretch;
    box-sizing: border-box;
}

/* title */
.login-box h2 {
    margin: 0 0 20px 0;
    text-align: center;
    color: #2f4f6f;
}

/* inputs */
input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 8px;

    /* 🔥 FIXES “shifted input look” */
    box-sizing: border-box;
}

/* button */
button {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    background: #2f4f6f;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

button:hover {
    background: #3f628a;
}

/* error */
.error {
    color: red;
    text-align: center;
    margin-bottom: 10px;
}
</style>
</head>

<body>

<div class="overlay"></div>

<div class="login-box">

    <h2>ADMIN LOGIN</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

</div>

</body>
</html>