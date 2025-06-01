<?php
require_once 'includes/config.php';
require_once 'includes/database.php';
require_once 'includes/functions.php';

$type = $_GET['type'] ?? 'apartment';

$allowed_types = ['house', 'apartment', 'villa'];

if (!in_array($type, $allowed_types)) {
    // Redirect or show error if invalid type
    header('Location: index.php');
    exit;
}

// Function to get properties by type
function get_properties_by_type($type) {
    global $pdo;  // Assuming PDO connection in includes/database.php
    
    $stmt = $pdo->prepare("SELECT * FROM properties WHERE type = :type ORDER BY price DESC");
    $stmt->execute(['type' => $type]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$properties = get_properties_by_type($type);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?= ucfirst($type) ?> Listings</title>
    <link rel="stylesheet" href="assets/css/filter.css" />
    <link rel="stylesheet" href="assets/css/variables.css" as="style">
    <link rel="stylesheet" href="assets/css/main.css" as="style">
    <link rel="stylesheet" href="assets/css/home.css" as="style">
</head>
<body>
<?php include 'includes/header.php'; ?>

<main class="filter-page">
    <div class="container">
        <h1><?= ucfirst($type) ?> Listings</h1>

        <div class="back-button-wrapper">
            <a href="index.php" class="btn-back">&larr; Back to Main Page</a>
        </div>

        <div class="property-grid">
            <?php if (!empty($properties)): ?>
                <?php foreach ($properties as $property): ?>
                    <div class="property-card">
                        <img src="<?= htmlspecialchars($property['image_url']) ?>" alt="<?= htmlspecialchars($property['title']) ?>" />
                        <h3><?= htmlspecialchars($property['title']) ?></h3>
                        <p class="price">$<?= number_format($property['price'], 2) ?></p>
                        <p><?= htmlspecialchars($property['bedrooms']) ?> Bed | <?= htmlspecialchars($property['bathrooms']) ?> Bath</p>
                        <p><?= htmlspecialchars($property['location']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No <?= htmlspecialchars($type) ?> properties found.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
