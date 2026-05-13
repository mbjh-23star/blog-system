<?php
session_start();

$conn = new mysqli("localhost", "root", "", "blog_db");

$result = $conn->query("SELECT * FROM blogs");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #a5a5a5;
    margin: 0;
    padding: 0;
}

/* CONTAINER (THIS FIXES EDGE ISSUE) */
.container {
    width: 80%;
    margin: auto;
    padding: 30px 0;
}

/* TITLE */
h1 {
    color: #000000;
    margin-bottom: 20px;
}

/* ADD BUTTON */
.add-btn {
    display: inline-block;
    padding: 10px 15px;
    background: #2f4f6f;
    color: white;
    margin-bottom: 20px;
    text-decoration: none;
    border-radius: 6px;
}

.add-btn:hover {
    background: #3f628a;
}

/* CARD */
.card {
    background: #2f4f6f;
    color: #ffffff;
    padding: 18px 22px;
    margin: 14px 0;
    border-radius: 10px;
    box-shadow: 0 6px 14px rgba(0,0,0,0.15);
    border-left: 6px solid #3f628a;
}

/* TITLE */
.card h2 {
    margin: 0;
    color: #ffffff;
}

/* CATEGORY */
.card p:first-of-type {
    display: inline-block;
    background: #3f628a;
    color: white;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 12px;
    margin-top: 8px;
}

/* DESCRIPTION */
.card p {
    color: #eaeaea;
    margin: 8px 0;
}

/* ACTION BUTTONS */
.card a {
    display: inline-block;
    margin-right: 10px;
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    transition: 0.2s;
}

/* EDIT */
.card a:first-of-type {
    background: #7fb3ff;
    color: #1f2f44;
}

/* DELETE */
.card a:last-of-type {
    background: #a7504a;
    color: #1f2f44;
}

.card a:hover {
    opacity: 0.85;
}

/* LOGOUT ICON (TOP RIGHT FIXED) */
.logout-icon {
    position: fixed;
    top: 20px;
    right: 30px;
    background: #3a698a;
    color: white;
    padding: 10px 12px;
    border-radius: 50%;
    text-decoration: none;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    transition: 0.2s;
}

.logout-icon:hover {
    opacity: 0.85;
    transform: scale(1.05);
}
</style>
</head>

<body>

<!-- LOGOUT ICON (ONLY ONCE, NOT INSIDE LOOP) -->
<a href="logout.php" class="logout-icon" title="Logout">➜]</a>

<div class="container">

<h1>Admin Dashboard</h1>

<!-- ADD BLOG BUTTON -->
<a class="add-btn" href="addblog.php">+ Add Blog</a>

<!-- BLOG LIST -->
<?php while($row = $result->fetch_assoc()) { ?>

    <div class="card">
        <h2><?php echo $row['bg_title']; ?></h2>

        <p><?php echo $row['bg_category']; ?></p>

        <p><?php echo $row['bg_shortdesc']; ?></p>

        <!-- EDIT -->
        <a href="editbg.php?id=<?php echo $row['bg_id']; ?>">Edit</a>

        <!-- DELETE -->
        <a href="deletebg.php?id=<?php echo $row['bg_id']; ?>"
           onclick="return confirm('Delete this blog?')">
           Delete
        </a>
    </div>

<?php } ?>

</div>

</body>
</html>