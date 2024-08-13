<?php
require_once '../../config/Database.php';
require_once '../../classes/Post.php';
require_once '../../helpers/utils.php';

// Instantiate the database and post objects
$database = new Database();
$db = $database->getConnection();
$post = new Post($db);

// Get the input data from the request body
$data = json_decode(file_get_contents("php://input"));

// Ensure that all required fields are present
if (!empty($data->title) && !empty($data->content) && !empty($data->author)) {
    // Set the post properties
    $post->title = $data->title;
    $post->content = $data->content;
    $post->author = $data->author;

    // Try to create the post
    if ($post->createPost()) {
        // If successful, return a 201 Created status
        sendResponse(201, array("message" => "Post created."));
    } else {
        // If unsuccessful, return a 503 Service Unavailable status
        sendResponse(503, array("message" => "Unable to create post."));
    }
} else {
    // If data is incomplete, return a 400 Bad Request status
    sendResponse(400, array("message" => "Incomplete data."));
}
?>
