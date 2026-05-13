<?php
$conn = new mysqli("localhost", "root", "", "blog_db");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $conn->prepare("SELECT * FROM blogs WHERE bg_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Blog not found");
}

if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $category = $_POST['category'];
    $shortdesc = $_POST['shortdesc'];

    $stmt = $conn->prepare("
        UPDATE blogs 
        SET bg_title = ?, bg_category = ?, bg_shortdesc = ?
        WHERE bg_id = ?
    ");

    $stmt->bind_param("sssi", $title, $category, $shortdesc, $id);
    $stmt->execute();

    header("Location: adminindex.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Blog</title>

<style>
body {
    margin: 0;
    font-family: Arial;
    background: #999797;
}

/* PAGE WRAPPER (SIDE STYLE, NOT CENTER BOX) */
.wrapper {
    padding: 60px;
}

/* HEADING */
h2 {
    color: #17395b;
    margin-bottom: 25px;
}

/* FORM STYLE (FULL WIDTH SIDE LAYOUT) */
form {
    width: 100%;
    max-width: 900px;
}

/* INPUTS */
input, textarea {
    width: 100%;
    padding: 14px;
    margin: 12px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    box-sizing: border-box;
}

/* TEXTAREA */
textarea {
    height: 180px;
    resize: none;
}

/* BUTTON */
button {
    padding: 12px 18px;
    background: #2f4f6f;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
}

button:hover {
    background: #3f628a;
}
</style>
</head>

<body>

<div class="wrapper">

    <h2>Edit Blog</h2>

    <form method="POST">

        <input type="text" name="title"
        value="<?php echo htmlspecialchars($row['bg_title']); ?>"
        placeholder="Title">

        <input type="text" name="category"
        value="<?php echo htmlspecialchars($row['bg_category']); ?>"
        placeholder="Category">

        <textarea name="shortdesc"
        placeholder="Short Description"><?php echo htmlspecialchars($row['bg_shortdesc']); ?></textarea>

        <button name="update">Update Blog</button>

    </form>

</div>

</body>
</html>