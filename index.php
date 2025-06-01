<?php
require_once 'includes/config.php';
require_once 'includes/database.php';
require_once 'includes/functions.php';

try {
    $test = $conn->query("SELECT COUNT(*) FROM properties");
    $count = $test->fetchColumn();
    error_log("Total properties in database: " . $count);
} catch(PDOException $e) {
    error_log("Test query failed: " . $e->getMessage());
}

$featured_properties = get_featured_properties(6);
$categories = get_all_categories();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Real Estate Listings - Find Your Dream Home</title>
    <meta name="description" content="Discover your perfect home with our comprehensive real estate listings. Search houses, apartments, and villas in your desired location." />
    <meta name="keywords" content="real estate, property listings, homes for sale, houses, apartments, villas, real estate agent, property search" />
    <meta name="robots" content="index, follow" />
    <meta name="author" content="Real Estate Listings" />
    <link rel="canonical" href="<?php echo SITE_URL; ?>" />
    <!-- Open Graph and Twitter Cards meta (keep as is) -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/variables.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/home.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- jQuery UI Autocomplete Styles -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
</head>
<body>
    <a href="#main-content" class="skip-link">Skip to main content</a>
    <?php include 'includes/header.php'; ?>

    <main id="main-content" role="main">
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Find your perfect home</h1>

                    <div class="search-tabs">
                        <button class="tab active" data-tab="buy">Buy</button>
                        <button class="tab" data-tab="rent">Rent</button>
                        <button class="tab" data-tab="sold">Sold</button>
                    </div>

                    <div class="search-container">
                        <form class="search-form" action="search.php" method="GET" role="search">
                            <div class="search-input-group">
                                <label for="location-search" class="visually-hidden">Search location</label>
                                <input 
                                    type="text" 
                                    id="location-search"
                                    name="suburb"
                                    placeholder="Enter suburb, postcode or state" 
                                    class="search-input"
                                    aria-label="Search location"
                                    required
                                />
                                <a href="filter.php" class="filters-button" role="button">
                                    <i class="fas fa-sliders-h" aria-hidden="true"></i>
                                    <span>Filters</span>
                                </a>
                                <button type="submit" class="search-button">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured properties section -->
        <section class="featured-properties">
            <div class="container">
                <h2>Featured Properties</h2>
                <div class="property-grid">
                    <?php if (!empty($featured_properties)): ?>
                        <?php foreach ($featured_properties as $property): ?>
                            <div class="property-card" role="article">
                                <div class="property-image">
                                    <a href="property.php?id=<?= $property['id']; ?>">
                                        <img src="<?= htmlspecialchars($property['image_url']); ?>" 
                                             alt="<?= htmlspecialchars($property['title']); ?> - <?= htmlspecialchars($property['property_type']); ?> in <?= htmlspecialchars($property['location']); ?>"
                                             loading="lazy" width="800" height="600" decoding="async" />
                                    </a>
                                    <div class="property-type" aria-label="Property type">
                                        <?= htmlspecialchars(ucfirst($property['property_type'])); ?>
                                    </div>
                                </div>
                                <div class="property-content">
                                    <h3><?= htmlspecialchars($property['title']); ?></h3>
                                    <p class="price">$<?= number_format($property['price'], 2); ?></p>
                                    <p class="location">
                                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                        <span><?= htmlspecialchars($property['location']); ?></span>
                                    </p>
                                    <div class="features" role="list">
                                        <span role="listitem"><i class="fas fa-bed"></i> <?= $property['bedrooms']; ?> Beds</span>
                                        <span role="listitem"><i class="fas fa-bath"></i> <?= $property['bathrooms']; ?> Baths</span>
                                        <span role="listitem"><i class="fas fa-vector-square"></i> <?= $property['area']; ?> m²</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-properties">
                            <p>No featured properties available at the moment.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="categories">
            <div class="container">
                <h2 class="section-heading">Browse by Category</h2>
                <div class="category-grid">
                    <?php foreach ($categories as $category): ?>
                        <div class="category-card">
                            <a href="category.php?type=<?= urlencode($category['slug']); ?>">
                                <img src="<?= htmlspecialchars($category['image_url']); ?>" 
                                     alt="<?= htmlspecialchars($category['name']) . ' properties'; ?>"
                                     loading="lazy" width="400" height="300" decoding="async" />
                            </a>
                            <div class="category-content">
                                <h3><?= htmlspecialchars($category['name']); ?></h3>
                                <a href="category.php?type=<?= urlencode($category['slug']); ?>" 
                                   class="view-properties"
                                   aria-label="View <?= htmlspecialchars($category['name']); ?> properties">
                                   View Properties
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    </main>

    <?php include 'includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
    $(function() {
        $("#location-search").autocomplete({
            source: 'get_suburbs.php',
            minLength: 2,
            delay: 300
        });
    });
    </script>
</body>
</html>
