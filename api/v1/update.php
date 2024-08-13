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
if (!empty($data->id) && !empty($data->title) && !empty($data->content) && !empty($data->author)) {
    // Set the post properties
    $post->id = $data->id;
    $post->title = $data->title;
    $post->content = $data->content;
    $post->author = $data->author;

    // Try to update the post
    if ($post->updatePost()) {
        // If successful, return a 200 OK status
        sendResponse(200, array("message" => "Post updated successfully."));
    } else {
        // If the post was not found or update failed, return a 404 Not Found status
        sendResponse(404, array("message" => "Post not found or no changes made."));
    }
} else {
    // If data is incomplete, return a 400 Bad Request status
    sendResponse(400, array("message" => "Incomplete data. Please provide all required fields."));
}
?>
