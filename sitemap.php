<?php
header("Content-Type: application/xml; charset=utf-8");

require_once 'includes/config.php';
require_once 'includes/database.php';
require_once 'includes/functions.php';

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo SITE_URL; ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <?php
    try {
        $properties = $conn->query("SELECT * FROM properties ORDER BY created_at DESC");
        while ($property = $properties->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <url>
                <loc><?php echo SITE_URL . '/property.php?id=' . htmlspecialchars($property['id']); ?></loc>
                <lastmod><?php echo date('Y-m-d', strtotime($property['updated_at'] ?? $property['created_at'])); ?></lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
            <?php
        }
    } catch(PDOException $e) {
        error_log("Sitemap generation error: " . $e->getMessage());
    }
    ?>

    <?php
    try {
        $categories = $conn->query("SELECT * FROM categories");
        while ($category = $categories->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <url>
                <loc><?php echo SITE_URL . '/properties.php?category=' . htmlspecialchars($category['slug']); ?></loc>
                <changefreq>weekly</changefreq>
                <priority>0.7</priority>
            </url>
            <?php
        }
    } catch(PDOException $e) {
        error_log("Sitemap categories error: " . $e->getMessage());
    }
    ?>

    <url>
        <loc><?php echo SITE_URL; ?>/about.php</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc><?php echo SITE_URL; ?>/contact.php</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
</urlset> 