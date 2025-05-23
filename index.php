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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <title>Real Estate Listings - Find Your Dream Home</title>
    <meta name="description" content="Discover your perfect home with our comprehensive real estate listings. Search houses, apartments, and villas in your desired location.">
    <meta name="keywords" content="real estate, property listings, homes for sale, houses, apartments, villas">
    
   
    <meta property="og:title" content="Real Estate Listings - Find Your Dream Home">
    <meta property="og:description" content="Search and find your perfect property from our extensive listings">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL; ?>">
    
 
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                        <form class="search-form" action="properties.php" method="GET" role="search">
                            <div class="search-input-group">
                                <label for="location-search" class="visually-hidden">Search location</label>
                                <input 
                                    type="text" 
                                    id="location-search"
                                    name="location"
                                    placeholder="Enter suburb, postcode or state" 
                                    class="search-input"
                                    aria-label="Search location"
                                >
                                <button type="button" class="filters-button" aria-expanded="false" aria-controls="filter-panel">
                                    <i class="fas fa-sliders-h" aria-hidden="true"></i>
                                    <span>Filters</span>
                                </button>
                                <button type="submit" class="search-button">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="featured-properties">
            <div class="container">
                <h2>Featured Properties</h2>
                <div class="property-grid">
                    <?php
                    echo "<!-- Debug: Function exists: " . (function_exists('get_featured_properties') ? 'Yes' : 'No') . " -->";
                    
                    echo "<!-- Debug: Database connection exists: " . (isset($conn) ? 'Yes' : 'No') . " -->";
                    
                    $featured_properties = get_featured_properties(6);
                    
                    if (!empty($featured_properties)):
                        foreach ($featured_properties as $property): ?>
                            <div class="property-card" role="article">
                                <div class="property-image">
                                    <?php 
                                    echo "<!-- Debug: Image path: " . $property['image_url'] . " -->";
                                    ?>
                                    <img src="<?php echo htmlspecialchars($property['image_url']); ?>" 
                                         alt="<?php echo htmlspecialchars($property['title']); ?>"
                                         loading="lazy">
                                    <div class="property-type">
                                        <?php echo htmlspecialchars(ucfirst($property['property_type'])); ?>
                                    </div>
                                </div>
                                <div class="property-content">
                                    <h3><?php echo htmlspecialchars($property['title']); ?></h3>
                                    <p class="price">$<?php echo number_format($property['price'], 2); ?></p>
                                    <p class="location">
                                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                        <span><?php echo htmlspecialchars($property['location']); ?></span>
                                    </p>
                                    <div class="features" role="list">
                                        <span role="listitem">
                                            <i class="fas fa-bed" aria-hidden="true"></i>
                                            <?php echo $property['bedrooms']; ?> Beds
                                        </span>
                                        <span role="listitem">
                                            <i class="fas fa-bath" aria-hidden="true"></i>
                                            <?php echo $property['bathrooms']; ?> Baths
                                        </span>
                                        <span role="listitem">
                                            <i class="fas fa-vector-square" aria-hidden="true"></i>
                                            <?php echo $property['area']; ?> m²
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                    else: ?>
                        <div class="no-properties">
                            <p>No featured properties available at the moment.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="categories">
            <div class="container">
                <h2 class="section-heading">Browse by Category</h2>
                <div class="category-grid">
                    <?php
                    $categories = get_all_categories();
                    foreach ($categories as $category): ?>
                        <div class="category-card">
                            <img src="<?php echo htmlspecialchars($category['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($category['name']); ?>"
                                 loading="lazy">
                            <div class="category-content">
                                <h3><?php echo htmlspecialchars($category['name']); ?></h3>
                                <a href="properties.php?category=<?php echo htmlspecialchars($category['slug']); ?>" 
                                   class="view-properties">
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

    <script src="assets/js/main.js"></script>

    <div id="tab-announcement" class="visually-hidden" aria-live="polite"></div>
</body>
</html>