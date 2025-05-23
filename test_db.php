<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/config.php';
require_once 'includes/database.php';

try {
    
    $test_query = $conn->query("SELECT * FROM properties WHERE featured = 1");
    $results = $test_query->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<pre>";
    print_r($results);
    echo "</pre>";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>