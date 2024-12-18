<?php

require_once '../../Model/Post.php';

class PostController {
    public function createPost($title, $content, $video_name) {
        $post = new Post($title, $content, $video_name);
        if ($post->create()) {
            header("Location: ../../View/BackOffice/posts_list.php");
        } else {
            echo "Failed to create post.";
        }
        exit;
    }

    public function createPostFront($title, $content, $video_name) {
        $post = new Post($title, $content, $video_name);
        if ($post->create()) {
            header("Location: ../../View/Frontoffice/forum.php");
        } else {
            echo "Failed to create post.";
        }
        exit;
    }
    public function createPFront($title, $content, $videoFile) {
        $targetDir = "../../assets/videos/";
        $videoName = basename($videoFile["name"]);
        $targetFilePath = $targetDir . $videoName;

        $videoFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ['mp4', 'avi', 'mov', 'wmv', 'flv'];

        if (in_array($videoFileType, $allowedTypes)) {
            if (move_uploaded_file($videoFile["tmp_name"], $targetFilePath)) {
                
                $postId = $this->createPostFront($title, $content, $videoName);
                return $postId; 
            } else {
                throw new Exception("There was an error uploading your video.");
            }
        } else {
            throw new Exception("Invalid video format. Allowed formats: " . implode(", ", $allowedTypes));
        }
    }
    public function getPostById($id) {
        $post = new Post();
        $postData = $post->getById($id);
        
        if ($postData) {
            return $postData;
        } else {
            echo "Post not found.";
        }
    }

    public function getAllPosts() {
        $post = new Post();
        $posts = $post->getAll();
        return $posts;
    }
    public function updatePost($id, $title, $content, $videoFile) {
        $targetDir = "../../assets/videos/";
        $allowedTypes = ['mp4', 'avi', 'mov', 'wmv', 'flv'];
    
        // Fetch existing post data
        $existingPost = $this->getPostById($id);
        if (!$existingPost) {
            throw new Exception("Post not found.");
        }
    
        $videoName = $existingPost->getVideoName(); // Existing video name
    
        // Handle video upload if provided
        if ($videoFile && $videoFile["error"] === UPLOAD_ERR_OK) {
            $newVideoName = basename($videoFile["name"]);
            $newTargetFilePath = $targetDir . $newVideoName;
            $videoFileType = strtolower(pathinfo($newTargetFilePath, PATHINFO_EXTENSION));
    
            if (!in_array($videoFileType, $allowedTypes)) {
                throw new Exception("Invalid video format. Allowed formats: " . implode(", ", $allowedTypes));
            }
    
            // Move uploaded video to target directory
            if (move_uploaded_file($videoFile["tmp_name"], $newTargetFilePath)) {
                // Remove the old video file if a new one is uploaded
                if ($videoName && file_exists($targetDir . $videoName)) {
                    unlink($targetDir . $videoName);
                }
                $videoName = $newVideoName; // Update video name for the post
            } else {
                throw new Exception("There was an error uploading your video.");
            }
        }
    
        // Update the post in the database
        $this->updatePostInDb($id, $title, $content, $videoName);
    }
    
    private function updatePostInDb($id, $title, $content, $videoName) {
        $dbConfig = new DbConfig();
        $pdo = $dbConfig->getConnection();
        $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content, video_name = :video WHERE id = :id");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':video', $videoName); // This will retain the old video if no new one is uploaded
        $stmt->bindParam(':id', $id);
    
        if (!$stmt->execute()) {
            throw new Exception("Failed to update the post.");
        }
    }
    
    public function deletePost($id) {
        $post = new Post();
        if ($post->delete($id)) {
            header("Location: ../../View/BackOffice/posts_list.php");
        } else {
            echo "Failed to delete post.";
        }
    }
        public function deletePostFront($id) {
            $post = new Post();
            if ($post->delete($id)) {
                header("Location: ../../View/Frontoffice/forum.php");
            } else {
                echo "Failed to delete post.";
            }
    }
}
?>