<?php
require_once '../../config/Database.php';
require_once '../../classes/Post.php';
require_once '../../helpers/utils.php';

// Instantiate the database and post objects
$database = new Database();
$db = $database->getConnection();
$post = new Post($db);

// Check if an ID was provided in the GET request
if (isset($_GET['id'])) {
    $post->id = intval($_GET['id']);  // Set the post ID
    if ($post->getPostById()) {
        // If the post exists, return it
        sendResponse(200, array(
            "id" => $post->id,
            "title" => $post->title,
            "content" => $post->content,
            "author" => $post->author,
            "created_at" => $post->created_at,
            "updated_at" => $post->updated_at
        ));
    } else {
        // If the post does not exist, return a 404 error
        sendResponse(404, array("message" => "Post not found."));
    }
} else {
    // If no ID is provided, return all posts
    $stmt = $post->getAllPosts();
    $posts_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            "id" => $id,
            "title" => $title,
            "content" => $content,
            "author" => $author,
            "created_at" => $created_at,
            "updated_at" => $updated_at
        );

        array_push($posts_arr, $post_item);
    }

    // Send the response with all posts
    sendResponse(200, $posts_arr);
}
?>
