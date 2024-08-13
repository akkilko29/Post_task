<?php
// Post class to manage CRUD operations for posts
class Post {
    private $conn;
    private $table = 'posts'; // Table name

    // Properties representing a post
    public $id;
    public $title;
    public $content;
    public $author;
    public $created_at;
    public $updated_at;

    // Constructor to initialize the database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to get all posts
    public function getAllPosts() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Method to get a single post by ID
    public function getPostById() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->author = $row['author'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
            return true;
        } else {
            return false;
        }
    }

    // Method to create a new post
    public function createPost() {
        $query = "INSERT INTO " . $this->table . " (title, content, author) VALUES (:title, :content, :author)";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':author', $this->author);

        // Execute the query and return true if successful
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method to update an existing post
    public function updatePost() {
        // Check if the post exists
        if (!$this->getPostById()) {
            return false; // Post not found
        }
        $title = htmlspecialchars($this->title);
        $content = htmlspecialchars($this->content);
        $author = htmlspecialchars($this->author);
        $id = htmlspecialchars($this->id);
        
        
        $query = "UPDATE " . $this->table . " SET title = :title, content = :content, author = :author, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':id', $id);
        
        // Execute the statement and check for errors
        if ($stmt->execute()) {
            return true;
        } else {
            // Print out the error for debugging
            print_r($stmt->errorInfo());
            return false;
        }
    }

    // Method to delete a post
    public function deletePost() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}
?>
