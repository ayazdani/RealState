<?php

function get_featured_properties() {
    global $conn;
    try {
        $query = $conn->query("SELECT * FROM properties WHERE featured = 1");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return [];
    }
}
function get_all_categories() {
    global $conn;  // Use your PDO connection
    $stmt = $conn->query("SELECT id, name, slug, image_url FROM categories ORDER BY name ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function format_price($price) {
    return '$' . number_format($price, 0, '.', ',');
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function filter_properties($filters) {
    global $conn;

    $sql = "SELECT * FROM properties WHERE 1=1";
    $params = [];

    if (!empty($filters['price_min'])) {
        $sql .= " AND price >= :price_min";
        $params[':price_min'] = $filters['price_min'];
    }

    if (!empty($filters['price_max'])) {
        $sql .= " AND price <= :price_max";
        $params[':price_max'] = $filters['price_max'];
    }

    if (!empty($filters['bedrooms'])) {
        $sql .= " AND bedrooms = :bedrooms";
        $params[':bedrooms'] = $filters['bedrooms'];
    }

    if (!empty($filters['bathrooms'])) {
        $sql .= " AND bathrooms = :bathrooms";
        $params[':bathrooms'] = $filters['bathrooms'];
    }

    if (!empty($filters['location'])) {
        $sql .= " AND location LIKE :location";
        $params[':location'] = '%' . $filters['location'] . '%';
    }

    if (!empty($filters['type'])) {
        $sql .= " AND property_type = :type";
        $params[':type'] = $filters['type'];
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
