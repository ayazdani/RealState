<?php
function render_property_card($property) {
?>
    <div class="property-card">
        <div class="property-image">
            <img src="<?php echo htmlspecialchars($property['image_url']); ?>" 
                 alt="<?php echo htmlspecialchars($property['title']); ?>">
            <span class="property-tag">For Sale</span>
        </div>
        <div class="property-content">
            <h3 class="property-title"><?php echo htmlspecialchars($property['title']); ?></h3>
            <p class="property-location">
                <i class="fas fa-map-marker-alt"></i>
                <?php echo htmlspecialchars($property['location']); ?>
            </p>
            <div class="property-features">
                <span class="feature">
                    <i class="fas fa-bed"></i>
                    <?php echo $property['bedrooms']; ?> Beds
                </span>
                <span class="feature">
                    <i class="fas fa-bath"></i>
                    <?php echo $property['bathrooms']; ?> Baths
                </span>
                <span class="feature">
                    <i class="fas fa-ruler-combined"></i>
                    <?php echo $property['area']; ?> sqft
                </span>
            </div>
            <div class="property-price">
                $<?php echo number_format($property['price']); ?>
            </div>
        </div>
    </div>
<?php
}
?>
