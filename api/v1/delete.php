<?php
require_once '../../config/Database.php';
require_once '../../classes/Post.php';
require_once '../../helpers/utils.php';

// Instantiate the database and post objects
$database = new Database();
$db = $database->getConnection();
$post = new Post($db);

// Get the post ID from the request body
$data = json_decode(file_get_contents("php://input"));
$post->id = isset($data->id) ? $data->id : die();

// Try to delete the post
if ($post->deletePost()) {
    sendResponse(200, array("message" => "Post deleted successfully."));
} else {
    sendResponse(404, array("message" => "Post not found or could not be deleted."));
}
?>
