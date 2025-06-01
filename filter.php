<?php
require_once 'includes/config.php';
require_once 'includes/database.php';
require_once 'includes/functions.php';

$filters = [
    'price_min' => $_GET['price_min'] ?? '',
    'price_max' => $_GET['price_max'] ?? '',
    'bedrooms' => $_GET['bedrooms'] ?? '',
    'bathrooms' => $_GET['bathrooms'] ?? '',
    'location' => $_GET['location'] ?? '',
    'type' => $_GET['type'] ?? ''
];

$properties = filter_properties($filters);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Filter Properties</title>
    <link rel="stylesheet" href="assets/css/filter.css" />
    <link rel="stylesheet" href="assets/css/variables.css" as="style">
    <link rel="stylesheet" href="assets/css/main.css" as="style">
    <link rel="stylesheet" href="assets/css/home.css" as="style">
</head>
<body>
<?php include 'includes/header.php'; ?>


<main class="filter-page">
    <div class="container">
        <h1>Filter Properties</h1>

        <div class="back-button-wrapper">
            <a href="index.php" class="btn-back">&larr; Back to Main Page</a>
        </div>

        <form method="GET" action="filter.php" class="filter-form">
            <label>Price Range:</label>
            <div class="price-range">
                <input
                    type="number"
                    name="price_min"
                    placeholder="Min Price"
                    value="<?= htmlspecialchars($filters['price_min']) ?>"
                />
                <input
                    type="number"
                    name="price_max"
                    placeholder="Max Price"
                    value="<?= htmlspecialchars($filters['price_max']) ?>"
                />
            </div>

            <label>Bedrooms:</label>
            <input
                type="number"
                name="bedrooms"
                placeholder="e.g. 3"
                value="<?= htmlspecialchars($filters['bedrooms']) ?>"
            />

            <label>Bathrooms:</label>
            <input
                type="number"
                name="bathrooms"
                placeholder="e.g. 2"
                value="<?= htmlspecialchars($filters['bathrooms']) ?>"
            />

            <label>Location:</label>
            <input
                type="text"
                name="location"
                placeholder="Suburb, State"
                value="<?= htmlspecialchars($filters['location']) ?>"
            />

            <label>Property Type:</label>
            <select name="type">
                <option value="" <?= $filters['type'] === '' ? 'selected' : '' ?>>Any</option>
                <option value="house" <?= $filters['type'] === 'house' ? 'selected' : '' ?>>House</option>
                <option value="apartment" <?= $filters['type'] === 'apartment' ? 'selected' : '' ?>>Apartment</option>
                <option value="villa" <?= $filters['type'] === 'villa' ? 'selected' : '' ?>>Villa</option>
            </select>

            <button type="submit" class="btn-submit">Apply Filters</button>
        </form>

        <div class="property-grid">
            <?php if (!empty($properties)): ?>
                <?php foreach ($properties as $property): ?>
                    <div class="property-card">
                        <img
                            src="<?= htmlspecialchars($property['image_url']) ?>"
                            alt="<?= htmlspecialchars($property['title']) ?>"
                        />
                        <h3><?= htmlspecialchars($property['title']) ?></h3>
                        <p class="price">$<?= number_format($property['price'], 2) ?></p>
                        <p><?= htmlspecialchars($property['bedrooms']) ?> Bed | <?= htmlspecialchars($property['bathrooms']) ?> Bath</p>
                        <p><?= htmlspecialchars($property['location']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No properties match your filters.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
