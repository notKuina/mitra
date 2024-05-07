<?php
// Function to count followers for a user
function countFollowers($userId, $conn) {
    $sql = "SELECT COUNT(*) AS follower_count FROM user_follow WHERE following_id = $userId";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['follower_count'];
    } else {
        return 0;
    }
}

// Function to count followings for a user
function countFollowings($userId, $conn) {
    $sql = "SELECT COUNT(*) AS following_count FROM user_follow WHERE follower_id = $userId";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['following_count'];
    } else {
        return 0;
    }
}

// Usage example
// Assuming $conn is your database connection object and $userId is the ID of the user
$userId = 1; // Example user ID
$followersCount = countFollowers($userId, $conn);
$followingsCount = countFollowings($userId, $conn);
echo "Followers: $followersCount, Followings: $followingsCount";
?>
