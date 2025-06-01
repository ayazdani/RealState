<?php
require_once 'includes/config.php';
require_once 'includes/database.php';

$term = isset($_GET['term']) ? trim($_GET['term']) : '';

if ($term === '') {
    echo json_encode([]);
    exit;
}

try {
    // Query distinct suburb/location names starting with the typed term
    $stmt = $conn->prepare("SELECT DISTINCT location FROM properties WHERE location LIKE :term ORDER BY location ASC LIMIT 10");
    $likeTerm = $term . '%';
    $stmt->bindParam(':term', $likeTerm, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode($results);
} catch (PDOException $e) {
    // Return empty array on error
    echo json_encode([]);
}
