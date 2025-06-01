<?php
require_once 'includes/config.php';
require_once 'includes/database.php';

// Get the category slug from URL, sanitize it
$slug = isset($_GET['type']) ? trim($_GET['type']) : '';

if (!$slug) {
    die('No category specified.');
}

try {
    // Step 1: Get category by slug, including image_url
    $stmt = $conn->prepare("SELECT id, name, image_url FROM categories WHERE slug = :slug LIMIT 1");
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
    $stmt->execute();
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
        die('Category not found.');
    }

    // Step 2: Get up to 5 properties in this category
    $stmt = $conn->prepare("
        SELECT id, title, image_url, price, location, bedrooms, bathrooms, area 
        FROM properties 
        WHERE category_id = :category_id 
        LIMIT 5
    ");
    $stmt->bindParam(':category_id', $category['id'], PDO::PARAM_INT);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?= htmlspecialchars($category['name']); ?> Properties - Real Estate Listings</title>
<link rel="stylesheet" href="assets/css/variables.css" as="style">
    <link rel="stylesheet" href="assets/css/main.css" as="style">
    <link rel="stylesheet" href="assets/css/home.css" as="style">
<style>
    body { font-family: 'Poppins', sans-serif; background: #f9f9f9; margin: 0; padding: 20px; }
    .container_category { max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);}
    h1 { margin-bottom: 10px; color: #333; text-align: center; }
    .category-image { max-width: 100%; height: auto; border-radius: 6px; margin: 10px 0 30px; display: block; }
    .properties-grid { display: flex; gap: 20px; flex-wrap: wrap; justify-content: center; }
    .property-card { background: #fff; border: 1px solid #ddd; border-radius: 6px; width: 220px; overflow: hidden; box-shadow: 0 1px 6px rgba(0,0,0,0.1); }
    .property-card img { width: 100%; height: 140px; object-fit: cover; display: block; }
    .property-info { padding: 15px; }
    .property-info h2 { font-size: 1.1rem; margin: 0 0 10px; color: #222; }
    .property-info p { margin: 5px 0; font-size: 0.9rem; color: #555; }
    .back-home { display: inline-block; margin-top: 30px; background: #007bff; color: white; padding: 10px 18px; border-radius: 4px; text-decoration: none; font-weight: 600; transition: background-color 0.3s ease; }
    .back-home:hover { background: #0056b3; }
</style>
</head>
<body>
<div class="container_category">
    <h1><?= htmlspecialchars($category['name']); ?> Properties</h1>

    <?php if (!empty($category['image_url'])): ?>
        <img src="<?= htmlspecialchars($category['image_url']); ?>" alt="<?= htmlspecialchars($category['name']); ?> Image" class="category-image">
    <?php endif; ?>

    <?php if (count($properties) > 0): ?>
    <div class="properties-grid">
        <?php foreach ($properties as $property): ?>
            <div class="property-card" role="article">
                <a href="property.php?id=<?= $property['id']; ?>">
                    <img src="<?= htmlspecialchars($property['image_url']); ?>" alt="<?= htmlspecialchars($property['title']); ?>" loading="lazy" />
                </a>
                <div class="property-info">
                    <h2><?= htmlspecialchars($property['title']); ?></h2>
                    <p><strong>Price:</strong> $<?= number_format($property['price'], 2); ?></p>
                    <p><strong>Location:</strong> <?= htmlspecialchars($property['location']); ?></p>
                    <p><strong>Beds:</strong> <?= (int)$property['bedrooms']; ?> | <strong>Baths:</strong> <?= (int)$property['bathrooms']; ?></p>
                    <p><strong>Area:</strong> <?= (float)$property['area']; ?> m²</p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
        <p>No properties found in this category.</p>
    <?php endif; ?>

    <a href="index.php" class="back-home">← Return Home</a>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>
