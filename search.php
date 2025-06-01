<?php
require_once 'includes/config.php';
require_once 'includes/database.php';
require_once 'includes/functions.php';

$suburb = isset($_GET['suburb']) ? trim($_GET['suburb']) : '';
$properties = [];
$error_message = '';
$show_featured = false;

if ($suburb === '' || !preg_match('/[a-zA-Z0-9]/', $suburb)) {
    // Special characters or empty
    $error_message = "Please enter a valid suburb.";
    $page_title = "Invalid Suburb";
} elseif ($suburb === '2100') {
    // Exact match for suburb "2100" shows featured
    $properties = get_featured_properties(6);
    $page_title = "Featured Properties for Suburb 2100";
} else {
    // Regular search for valid suburb
    $stmt = $conn->prepare("SELECT * FROM properties WHERE location LIKE :location");
    $stmt->execute([':location' => '%' . $suburb . '%']);
    $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($properties)) {
        $error_message = "No properties found in \"$suburb\". Showing featured properties instead.";
        $properties = get_featured_properties(6);
        $show_featured = true;
    }

    $page_title = "Search Results for \"$suburb\"";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($page_title); ?> - Real Estate Listings</title>
    <link rel="stylesheet" href="assets/css/property.css">
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="container">
    <h1><?= htmlspecialchars($page_title); ?></h1>

    <?php if ($error_message): ?>
        <div class="error-message" style="color: red; font-weight: bold; margin-bottom: 1em;">
            <?= htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($properties)): ?>
        <div class="property-grid">
            <?php foreach ($properties as $property): ?>
                <div class="property-card">
                    <div class="property-image">
                        <a href="property.php?id=<?= $property['id']; ?>">
                            <img src="<?= htmlspecialchars($property['image_url']); ?>" alt="<?= htmlspecialchars($property['title']); ?>" loading="lazy">
                        </a>
                    </div>
                    <div class="property-content">
                        <h3><?= htmlspecialchars($property['title']); ?></h3>
                        <p class="price">$<?= number_format($property['price'], 2); ?></p>
                        <p class="location">
                            <i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($property['location']); ?>
                        </p>
                        <div class="features">
                            <span><i class="fas fa-bed"></i> <?= $property['bedrooms']; ?> Beds</span>
                            <span><i class="fas fa-bath"></i> <?= $property['bathrooms']; ?> Baths</span>
                            <span><i class="fas fa-vector-square"></i> <?= $property['area']; ?> m²</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif (!$error_message): ?>
        <p>No properties to display.</p>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>
