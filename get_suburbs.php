<?php
require_once 'includes/config.php';
require_once 'includes/database.php';

$term = isset($_GET['term']) ? trim($_GET['term']) : '';

if ($term === '') {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT DISTINCT location FROM properties WHERE location LIKE :term LIMIT 10");
$stmt->execute([':term' => $term . '%']);
$results = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($results);
