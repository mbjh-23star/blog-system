<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$conn = new mysqli("localhost", "root", "", "blog_db");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$msg = "";

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $short = $_POST['short_description'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $image = $_POST['image'];

    $stmt = $conn->prepare("INSERT INTO blogs (bg_title, bg_shortdesc, bg_content, bg_category, bg_image)
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $short, $content, $category, $image);

    if ($stmt->execute()) {
        $msg = "Blog added successfully!";
    } else {
        $msg = "Error adding blog.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Blog</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #a19f9f; /* full grey page */
    padding: 40px;
}

/* TITLE */
h2 {
    color: #2f4f6f;
    margin-bottom: 20px;
}

/* INPUTS DIRECTLY ON PAGE */
input, textarea {
    display: block;
    width: 400px;
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #bbb;
    background: #fff;
}

/* TEXTAREA SIZE */
textarea {
    height: 140px;
    resize: none;
}

/* BUTTON */
button {
    width: 420px;
    padding: 10px;
    background: #2f4f6f;
    color: white;
    border: none;
    cursor: pointer;
    margin-top: 10px;
}

button:hover {
    background: #3f628a;
}

/* MESSAGE */
.msg {
    color: green;
    font-weight: bold;
    margin-bottom: 10px;
}
</style>
</head>

<body>

<h2>Add Blog</h2>

<?php if ($msg != "") echo "<div class='msg'>$msg</div>"; ?>

<form method="POST">
    <input name="title" placeholder="Title" required>
    <input name="short_description" placeholder="Short Description" required>
    <textarea name="content" placeholder="Content" required></textarea>
    <input name="category" placeholder="Category" required>
    <input name="image" placeholder="Image file name" required>
    <button name="submit">Add Blog</button>
</form>

</body>
</html>