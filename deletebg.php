<?php
$conn = new mysqli("localhost", "root", "", "blog_db");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $conn->prepare("DELETE FROM blogs WHERE bg_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: adminindex.php");
exit;
?>