<?php
$conn = new mysqli("localhost", "root", "", "blog_db");

$search = isset($_POST['search']) ? $_POST['search'] : "";
$category = isset($_POST['category']) ? $_POST['category'] : "";
$date = isset($_POST['date']) ? $_POST['date'] : "";

$sql = "SELECT * FROM blogs WHERE 1=1";

if ($search != "") {
    $sql .= " AND bg_title LIKE '%$search%'";
}

if ($category != "") {
    $sql .= " AND bg_category = '$category'";
}

if ($date != "") {
    $sql .= " AND DATE(bg_created) = '$date'";
}

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
?>

<div class="card">

    <?php if (!empty($row['bg_image'])) { ?>
        <img src="<?php echo htmlspecialchars($row['bg_image']); ?>" 
        style="width:100%; height:200px; object-fit:cover; border-radius:10px;">
    <?php } ?>

    <h2><?php echo $row['bg_title']; ?></h2>

    <p class="category"><?php echo $row['bg_category']; ?></p>

    <p><?php echo $row['bg_shortdesc']; ?></p>

    <a href="bgcontent.php?id=<?php echo $row['bg_id']; ?>">
        Read More →
    </a>

</div>

<?php } ?>