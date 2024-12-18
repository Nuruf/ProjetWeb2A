<?php
require '../../controller/PostController.php';
require '../../controller/LikeDislikeController.php';
$postController = new PostController();
$posts = $postController->getAllPosts();
$likeDislikeController = new LikeDislikeController();

// Fetch vote statistics
$voteStatisticsJson = $likeDislikeController->getVoteStatistics();
$voteStatistics = json_decode($voteStatisticsJson, true); // Decode the JSON string

// Check for errors in the decoded data
if (isset($voteStatistics['error'])) {
    echo "Error fetching vote statistics: " . $voteStatistics['error'];
    exit; // Stop execution if there's an error
}

// Prepare arrays for chart data
$dates = [];
$likes = [];
$dislikes = [];

// Iterate over the decoded data
foreach ($voteStatistics as $stat) {
    $dates[] = $stat['date'];
    $likes[] = (int)$stat['likes'];
    $dislikes[] = (int)$stat['dislikes'];
}
// Debugging: Log the prepared data
error_log("Dates: " . print_r($dates, true));
error_log("Likes: " . print_r($likes, true));
error_log("Dislikes: " . print_r($dislikes, true));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_FILES['video'])) {
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $videoFile = $_FILES['video'];

        // Validate video upload
        $allowedFormats = ['video/mp4', 'video/webm', 'video/ogg'];
        $maxFileSize = 50 * 1024 * 1024; // 50MB

        if (!in_array($videoFile['type'], $allowedFormats)) {
            echo "Invalid video format. Only MP4, WebM, and OGG are allowed.";
            exit;
        }

        if ($videoFile['size'] > $maxFileSize) {
            echo "File size exceeds 50MB.";
            exit;
        }

        try {
            // Call your postController
            $postId = $postController->createPost($title, $content, $videoFile);
            header("Location: postDetails.php?id=" . $postId);
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all required fields.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/blogs/blog-3/assets/css/blog-3.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
  
<div class="user-info">
        <img src="logoo.png" alt="User Profile">
        <span>bienvenue sur notre site  : username</span>
    </div>

    <nav>
        <ul>
            <li><a href="#profile" onclick="showSection('profile')">Profile</a></li>
            <li><a href="posts_list.php" onclick="showSection('forum')">Blog</a></li>
            <li><a href="#skillSwap" onclick="showSection('skillSwapp')">Skill Swapp</a></li>
            <li><a href="#blog" onclick="showSection('blog')">Forum</a></li>
            <li><a href="#Quiz" onclick="showSection('quiz')">Quiz</a></li>
            <li><a href="#Reclamation" onclick="showSection('reclamation')">Réclamation</a></li>
        </ul>
    </nav>

    <!-- Contenu principal -->
    <main class="content">
        
        
       


        <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary"></h1>
        <a  onclick="createPost()" class="btn btn-success">Create New Post</a>
    </div>
<section class="py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
        <h3 class="fs-6 text-secondary mb-2 text-uppercase text-center">Our News</h3>
        <h2 class="display-5  text-center">Here is our blog's latest posts </h2>
      </div>
    </div>
  </div>

  <div class="container my-5">
    <div class="search-filter-section mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <input type="text" class="form-control shadow-sm" placeholder="Search posts by title..." id="searchInput" onkeyup="filterPosts()">
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-info shadow-sm" id="voiceSearchButton">
                <i class="fas fa-microphone"></i> Speak
                </button>
            </div>
            <div class="col-md-6">
                <select class="form-select shadow-sm" id="filterCategory" onchange="filterPosts()">
                    <option value="">Filter by Category</option>
                    <option value="Business">Business</option>
                    <option value="Technology">Technology</option>
                    <option value="Lifestyle">Lifestyle</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row gy-4 gy-lg-0" id="postsGrid">
    <div id="noResultsMessage" class="text-center text-muted" style="display: none;">
    <h4>No results found</h4>
</div>
        <?php foreach ($posts as $post): ?>
        <div class="col-12 col-lg-4 py-3 post-card" data-title="<?php echo htmlspecialchars($post['title']); ?>">
            <article>
                <div class="card border-0 shadow-sm">
                    <figure class="card-img-top m-0 overflow-hidden bsb-overlay-hover">
                        <a href="postDetails.php?id=<?php echo htmlspecialchars($post['id']); ?>">
                            <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="https://images.rawpixel.com/image_800/czNmcy1wcml2YXRlL3Jhd3BpeGVsX2ltYWdlcy93ZWJzaXRlX2NvbnRlbnQvbHIvcm0zMTQtYWRqLTEwLmpwZw.jpg" alt="Business">
                        </a>
                        <figcaption>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInLeft" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                            </svg>
                            <h4 class="h6 text-white bsb-hover-fadeInRight mt-2">Read More</h4>
                        </figcaption>
                    </figure>
                    <div class="card-body bg-white p-4">
                        <div class="entry-header mb-3">
                            <ul class="entry-meta list-unstyled d-flex mb-2">
                                <li>
                                    <a class="link-primary text-decoration-none" href="#!">CATEGORY</a>
                                </li>
                            </ul>
                            <h2 class="card-title entry-title h5 mb-0">
                                <a class="link-dark text-decoration-none" href="#!"><?php echo htmlspecialchars($post['title']); ?></a>
                            </h2>
                        </div>
                        <p class="card-text entry-summary text-secondary">
                            <?php echo htmlspecialchars($post['content']); ?>
                        </p>
                    </div>
                    <div class="card-footer bg-white p-4">
                        <ul class="entry-meta list-unstyled d-flex align-items-center m-0">
                            <li>
                                <a class="fs-7 link-secondary text-decoration-none d-flex align-items-center" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                                        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                    </svg>
                                    <span class="ms-2 fs-7"><?php echo htmlspecialchars($post['created_at']); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </article>
        </div>
        <?php endforeach; ?>
    </div>
</div>

</section>
</div>
<div id="createPostModal" class="modal fade" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createPostModalLabel">Create New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="postForm" enctype="multipart/form-data" action="" method="post" onsubmit="return validateForm();">
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter post title">
                    <div id="titleError" class="text-danger d-none">Title must be at least 5 characters.</div>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label fw-bold">Content</label>
                    <textarea id="content" name="content" class="form-control" rows="8" placeholder="Write your content here..."></textarea>
                    <div id="contentError" class="text-danger d-none">Content must be at least 20 characters.</div>
                </div>
                <div class="mb-3">
                    <label for="video" class="form-label fw-bold">Upload Video</label>
                    <input type="file" id="video" name="video" class="form-control" accept="video/*">
                    <div id="videoError" class="text-danger d-none">Please upload a valid video file.</div>
                </div>

                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-primary btn-lg">Create Post</button>
                        <a href="#"  onclick="closePostModal()" class="btn btn-secondary btn-lg">Back to Post List</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container my-5">
    <h2 class="text-center">Statistics</h2>
    <canvas id="myChart" width="400" height="200"></canvas>
</div>


    </main> 
    <!-- Chart Creation -->
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const voteChart = new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: <?php echo json_encode($dates); ?>, 
                datasets: [
                    {
                        label: 'Likes',
                        data: <?php echo json_encode($likes); ?>, 
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Dislikes',
                        data: <?php echo json_encode($dislikes); ?>, 
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => {
                section.style.display = 'none';
            });

            const selectedSection = document.getElementById(sectionId + '-content');
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSection('profile');
        });
        
    function createPost() {
        $('#createPostModal').modal('show'); 
    }

    function closePostModal() {
        $('#createPostModal').modal('hide'); 
    }
    function filterPosts() {
    const searchQuery = document.getElementById('searchInput').value.toLowerCase();
    const posts = document.querySelectorAll('.post-card');
    let visiblePosts = 0;

    posts.forEach(post => {
        const title = post.querySelector('.card-title').textContent.toLowerCase();
        if (title.includes(searchQuery)) {
            post.style.display = 'block';
            visiblePosts++;
        } else {
            post.style.display = 'none';
        }
    });

    const noResultsMessage = document.getElementById('noResultsMessage');
    if (visiblePosts === 0 && searchQuery !== '') {
        noResultsMessage.style.display = 'block';
    } else {
        noResultsMessage.style.display = 'none';
    }
}
function validateForm() {
    let isValid = true;

    // Get form fields
    const title = document.getElementById('title').value.trim();
    const content = document.getElementById('content').value.trim();
    const video = document.getElementById('video').files[0];

    // Error elements
    const titleError = document.getElementById('titleError');
    const contentError = document.getElementById('contentError');
    const videoError = document.getElementById('videoError');

    // Reset errors
    titleError.classList.add('d-none');
    contentError.classList.add('d-none');
    videoError.classList.add('d-none');

    // Title validation
    if (title.length < 5) {
        titleError.classList.remove('d-none');
        isValid = false;
    }

    // Content validation
    if (content.length < 20) {
        contentError.classList.remove('d-none');
        isValid = false;
    }

    // Video validation
    if (!video) {
        videoError.textContent = "Please upload a video.";
        videoError.classList.remove('d-none');
        isValid = false;
    } else if (!['video/mp4', 'video/webm', 'video/ogg'].includes(video.type)) {
        videoError.textContent = "Only MP4, WebM, and OGG formats are allowed.";
        videoError.classList.remove('d-none');
        isValid = false;
    }

    // Prevent modal from closing if invalid
    return isValid;
}

let recognition;

if ('webkitSpeechRecognition' in window) {
    recognition = new webkitSpeechRecognition(); // Webkit-specific for Chrome/Edge
    recognition.continuous = false;  
    recognition.interimResults = false;  
    recognition.lang = 'en-US';  

    // When speech is recognized, set the search input to the recognized text
    recognition.onresult = function(event) {
        const transcript = event.results[0][0].transcript;
        const cleanedTranscript = transcript.replace(/\.$/, '');
        document.getElementById('searchInput').value = cleanedTranscript;
        filterPosts();  // Trigger the filter function with the spoken input
    };

    recognition.onerror = function(event) {
        console.error("Speech recognition error:", event.error);
    };

    // Start recognition when the button is clicked
    document.getElementById('voiceSearchButton').addEventListener('click', function() {
        recognition.start();
    });
} else {
    console.log("Speech recognition not supported in this browser.");
}

</script>
   
</body>
</html>
