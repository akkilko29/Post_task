/posts
│
├── /api
│   ├── /v1
│   │   ├── create.php                          # Script to handle POST requests (create post)
│   │   ├── read.php                            # Script to handle GET requests (get all posts or a single post)
│   │   ├── update.php                          # Script to handle PUT requests (update post)
│
├── /config
│   └── Database.php                            # Database connection class
│
├── /classes
│   └── Post.php                                # Post class that handles CRUD operations
│
├── /helpers
│   └── utils.php                               # Utility functions (e.g., response formatting, validation)
│
├── /posts.postman_collection.json              # Postman Collections
│
│
├── /posts.sql                                  # Database
│
│
└── /index.php                                  # Main entry point (if you want to route all requests through a                                                 single file)
