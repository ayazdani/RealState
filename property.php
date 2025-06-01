<?php
require_once 'includes/config.php';
require_once 'includes/database.php';
require_once 'includes/functions.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid property ID.");
}

$property_id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM properties WHERE id = ?");
$stmt->execute([$property_id]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    die("Property not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($property['title']); ?> - Property Details</title>
    <link rel="stylesheet" href="assets/css/property.css">
    <link rel="stylesheet" href="assets/css/variables.css" as="style">
    <link rel="stylesheet" href="assets/css/main.css" as="style">
    <link rel="stylesheet" href="assets/css/home.css" as="style">

</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="property-details">
        <div class="property-container">
    <div class="property-header">
        <h1><?= htmlspecialchars($property['title']) ?></h1>
        <div class="property-meta"><?= htmlspecialchars($property['location']) ?> | <?= ucfirst($property['property_type']) ?></div>
    </div>

    <img class="property-image" src="<?= htmlspecialchars($property['image_url']) ?>" alt="<?= htmlspecialchars($property['title']) ?>">

    <div class="property-details">
        <div class="property-detail"><i class="fas fa-bed"></i><br><?= $property['bedrooms'] ?> Bedrooms</div>
        <div class="property-detail"><i class="fas fa-bath"></i><br><?= $property['bathrooms'] ?> Bathrooms</div>
        <div class="property-detail"><i class="fas fa-car"></i><br><?= $property['parking'] ?? 'N/A' ?> Parking</div>
        <div class="property-detail"><i class="fas fa-dollar-sign"></i><br>$<?= number_format($property['price'], 2) ?></div>
        <div class="property-detail"><i class="fas fa-vector-square"></i><br><?= $property['area'] ?> m²</div>
    </div>

    <div class="property-description">
        <?= nl2br(htmlspecialchars($property['description'])) ?>
    </div>

    <a class="back-to-home" href="index.php"><i class="fas fa-arrow-left"></i> Back to Home</a>
</div>

    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
