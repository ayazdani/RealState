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
    global $conn;
    try {
        $query = $conn->query("SELECT * FROM categories");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return [];
    }
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