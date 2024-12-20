<?php

require_once __DIR__ . '/../model/Postss.php';

class PosttController {
    public function createPost($title, $content, $video_name) {
        $post = new Postt($title, $content, $video_name);
        if ($post->create()) {
            header("Location: ../../View/BackOffice/postt_list.php");
        } else {
            echo "Failed to create post.";
        }
        exit;
    }

    public function createPostFront($title, $content, $video_name,$user_id) {
        $post = new Postt($title, $content, $video_name, null, null, $user_id);
        if ($post->create()) {
            header("Location: ../../frontend/templatefront/blogg.php");
        } else {
            echo "Failed to create post.";
        }
        exit;
    }
    public function createPFront($title, $content, $videoFile,$user_id) {
        $targetDir = "../../../assets/videos/";
        $videoName = basename($videoFile["name"]);
        $targetFilePath = $targetDir . $videoName;

        $videoFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ['mp4', 'avi', 'mov', 'wmv', 'flv'];

        if (in_array($videoFileType, $allowedTypes)) {
            if (move_uploaded_file($videoFile["tmp_name"], $targetFilePath)) {
                
                $postId = $this->createPostFront($title, $content, $videoName,$user_id);
                return $postId; 
            } else {
                throw new Exception("There was an error uploading your video.");
            }
        } else {
            throw new Exception("Invalid video format. Allowed formats: " . implode(", ", $allowedTypes));
        }
    }
    public function getPostById($id) {
        $post = new Postt();
        $postData = $post->getById($id);
        
        if ($postData) {
            return $postData;
        } else {
            echo "Post not found.";
        }
    }

    public function getPostWithUser($postId) {
        // Get the database connection
        $DatabaseConfig = new DatabaseConfig();
        $pdo = $DatabaseConfig->getConnexion();
    
        // Prepare the query to fetch the post and user data
        $stmt = $pdo->prepare("SELECT postt.*, utilisateur.Utilisateur AS username FROM postt 
                               JOIN utilisateur ON postt.user_id = utilisateur.id 
                               WHERE postt.id = :postId");
    
        // Execute the query
        $stmt->execute(['postId' => $postId]);
    
        // Fetch the result as an object
        return $stmt->fetch(PDO::FETCH_OBJ);  // Fetching as an object so we can access the properties
    }
    
    

    public function getAllpostt() {
        $post = new Postt();
        $postt = $post->getAll();
        return $postt;
    }
    public function updatePost($id, $title, $content, $videoFile, $user_id) {
        $targetDir = "../../assets/videos/";
        $allowedTypes = ['mp4', 'avi', 'mov', 'wmv', 'flv'];
        
        // Fetch existing post data
        $existingPost = $this->getPostById($id, $user_id); // Pass the user_id to get the post
        if (!$existingPost) {
            throw new Exception("Post not found or you are not the author.");
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
        $this->updatePostInDb($id, $title, $content, $videoName, $user_id);
    }
    
    private function updatePostInDb($id, $title, $content, $videoName, $user_id) {
        $DatabaseConfig = new DatabaseConfig();
        $pdo = $DatabaseConfig->getConnexion();
        $stmt = $pdo->prepare("UPDATE postt SET title = :title, content = :content, video_name = :video WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':video', $videoName);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $user_id);
    
        if (!$stmt->execute()) {
            throw new Exception("Failed to update the post.");
        }
    }


    public function updatePostAdmin($id, $title, $content, $videoFile) {
        $targetDir = "../../assets/videos/";
        $allowedTypes = ['mp4', 'avi', 'mov', 'wmv', 'flv'];
        
        // Fetch existing post data
        $existingPost = $this->getPostById($id); // Pass the user_id to get the post
        if (!$existingPost) {
            throw new Exception("Post not found or you are not the author.");
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
        $this->updatePostInDbAdmin($id, $title, $content, $videoName);
    }


    private function updatePostInDbAdmin($id, $title, $content, $videoName) {
        $DatabaseConfig = new DatabaseConfig();
        $pdo = $DatabaseConfig->getConnexion();
        $stmt = $pdo->prepare("UPDATE postt SET title = :title, content = :content, video_name = :video WHERE id = :id");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':video', $videoName);
        $stmt->bindParam(':id', $id);
    
        if (!$stmt->execute()) {
            throw new Exception("Failed to update the post.");
        }
    }
    
    public function deletePost($id, $user_id) {
        $post = new Postt();
        if ($post->delete($id, $user_id)) {
        } else {
            echo "Failed to delete post or you are not the author.";
        }
    }
    public function deletePostA($id) {
        $post = new Postt();
        if ($post->deleteA($id)) {
        } else {
            echo "Failed to delete post or you are not the author.";
        }
    }
    
}
?>