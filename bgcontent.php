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
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $row['bg_title']; ?></title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #e6e6e6;
}

/* TOP BAR */
.topline {
    height: 6px;
    background: #2f4f6f;
    width: 100%;
}

/* WRAPPER */
.wrapper {
    max-width: 900px;
    margin: auto;
    padding: 40px 20px;
}

/* TITLE */
h1 {
    color: #2f4f6f;
    font-size: 36px;
    margin-bottom: 10px;
}

/* CATEGORY */
.category {
    display: inline-block;
    background: #2f4f6f;
    color: white;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 13px;
    margin-bottom: 20px;
}

/* IMAGE */
img {
    width: 100%;
    max-height: 450px;
    object-fit: cover;
    margin: 20px 0;
}

/* CONTENT */
.content {
    font-size: 18px;
    line-height: 1.8;
    color: #333;
    white-space: pre-wrap;
}
</style>
</head>

<body>

<div class="topline"></div>

<div class="wrapper">

    <h1><?php echo $row['bg_title']; ?></h1>

    <div class="category">
        <?php echo $row['bg_category']; ?>
    </div>

    <!-- IMAGE FIXED -->
    <?php if (!empty($row['bg_image'])) { ?>
    <img src="<?php echo htmlspecialchars($row['bg_image']); ?>" alt="Blog Image">
<?php } ?>

    <!-- CONTENT -->
    <div class="content">
        <?php echo nl2br(htmlspecialchars($row['bg_content'])); ?>
    </div>

</div>

</body>
</html>