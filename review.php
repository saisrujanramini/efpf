<?php
include 'db.php';

function getReviews($product_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT reviews.rating, reviews.review, users.username FROM reviews JOIN users ON reviews.user_id = users.id WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function addReview($user_id, $product_id, $rating, $review) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO reviews (user_id, product_id, rating, review, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiis", $user_id, $product_id, $rating, $review);
    return $stmt->execute();
}
?>
