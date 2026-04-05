<?php
// RDS Connection Settings
$host = "REPLACE_WITH_RDS_ENDPOINT";
$db_name = "cafe_db";
$username = "admin";
$password = "REPLACE_WITH_RDS_PASSWORD";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch Menu Items
    $stmt = $conn->prepare("SELECT name, category, price, description FROM menu_items ORDER BY category");
    $stmt->execute();
    $menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $error = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Complete Menu | Cafe Cloud9-PH</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #fefae0; color: #333; padding: 2rem; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        h1 { font-family: 'Playfair Display', serif; color: #4a3427; text-align: center; border-bottom: 2px solid #d4a373; padding-bottom: 1rem; }
        .menu-category { margin-top: 2rem; color: #d4a373; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .item { display: flex; justify-content: space-between; margin: 1rem 0; border-bottom: 1px dashed #ddd; padding-bottom: 0.5rem; }
        .item-info { flex: 1; }
        .price { font-weight: 600; color: #4a3427; }
        .error { background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; }
        .back-btn { display: inline-block; margin-top: 2rem; color: #4a3427; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

<div class="container">
    <h1>Cafe Cloud9-PH Full Menu</h1>

    <?php if (isset($error)): ?>
        <div class="error">
            <strong>Connection Error:</strong> <?php echo $error; ?>
            <p>Make sure your RDS Security Group allows traffic from this EC2 instance!</p>
        </div>
        <!-- Sample Data for Preview if DB Fails -->
        <div class="menu-category">Preview Mode (Check RDS Connection)</div>
        <div class="item"><div class="item-info"><strong>Espresso Maker (Manual)</strong><br><small>Classic stovetop espresso maker.</small></div><div class="price">₱1,200</div></div>
        <div class="item"><div class="item-info"><strong>Dark Roast Beans (500g)</strong><br><small>Premium Sagada beans.</small></div><div class="price">₱450</div></div>
    <?php else: ?>
        <?php 
        $current_category = "";
        foreach($menu_items as $item): 
            if ($current_category != $item['category']): 
                $current_category = $item['category'];
                echo "<div class='menu-category'>$current_category</div>";
            endif;
        ?>
            <div class="item">
                <div class="item-info">
                    <strong><?php echo htmlspecialchars($item['name']); ?></strong><br>
                    <small><?php echo htmlspecialchars($item['description']); ?></small>
                </div>
                <div class="price">₱<?php echo number_format($item['price'], 2); ?></div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <a href="index.html" class="back-btn">← Back to Home</a>
</div>

</body>
</html>
