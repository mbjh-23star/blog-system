<?php
$conn = new mysqli("localhost", "root", "", "blog_db");

$result = $conn->query("SELECT * FROM blogs");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>

    <style>
    body {
        font-family: Arial;
        background: #929292;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: auto;
        padding-top: 20px;
    }

    h1 {
        text-align: center;
        color: #1f2f44;
    }

    .card {
        background: #fff;
        color: #222;
        padding: 18px;
        margin: 15px 0;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .category {
        display: inline-block;
        background: #1f2f44;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        margin-bottom: 10px;
    }

    input, select {
        padding: 10px;
        margin: 8px 5px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    input:focus, select:focus {
        border-color: #1f2f44;
    }

    @media (max-width: 768px) {
        .container { width: 95%; }
        .card { font-size: 14px; }
        input, select { width: 100%; margin: 5px 0; }
    }
    </style>
</head>

<body>

<div class="container">

<h1>Blogs</h1>

<input type="text" id="search" placeholder="Search blogs...">

<select id="category">
    <option value="">All Categories</option>
    <option value="Lifestyle">Lifestyle</option>
    <option value="Health">Health</option>
    <option value="Study Tips">Study Tips</option>
    <option value="Food">Food</option>
</select>

<input type="date" id="date">

<div id="blogContainer">

<?php while($row = $result->fetch_assoc()) { ?>

    <div class="card">

        <?php if(!empty($row['bg_image'])) { ?>
    <img src="<?php echo htmlspecialchars($row['bg_image']); ?>" 
    style="width:100%; height:200px; object-fit:cover; border-radius:10px;">
<?php } ?>

        <h2><?php echo $row['bg_title']; ?></h2>

        <p class="category"><?php echo $row['bg_category']; ?></p>

        <p><?php echo $row['bg_shortdesc']; ?></p>

    </div>

<?php } ?>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function loadBlogs() {
    $.ajax({
        url: "fetchbg.php",
        type: "POST",
        data: {
            search: $("#search").val(),
            category: $("#category").val(),
            date: $("#date").val()
        },
        success: function(data) {
            $("#blogContainer").html(data);
        }
    });
}

$("#search").on("keyup", loadBlogs);
$("#category").on("change", loadBlogs);
$("#date").on("change", loadBlogs);

loadBlogs();
</script>

</body>
</html>