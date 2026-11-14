<?php
require 'db.php';
$featured_pets = $pdo->query("SELECT * FROM pets LIMIT 3")->fetchAll();
$total_pets = $pdo->query("SELECT COUNT(*) FROM pets")->fetchColumn();
?>