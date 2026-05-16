<div class = "container home-container">
    <div class="questions-list">
        <h1 class="heading"> Questions </h1>
        <?php
            include './server/db.php';
            include './client/timeAgo.php';

            if(isset($_GET["c-id"])){
                $sql = "SELECT * FROM questions WHERE category_id = $c_id ORDER BY id";
            }
            else if(isset($_GET["u-id"])){
                $sql = "SELECT * FROM questions WHERE user_id = $u_id ORDER BY id";
            }
            else if(isset($_GET["latest"])){
                $sql = "SELECT * FROM questions ORDER BY id DESC";
            }
            else if(isset($_GET["search"])){
                $sql = "SELECT * FROM questions 
                        WHERE title LIKE '%$search%' 
                        OR description LIKE '%$search%'
                        ORDER BY id DESC";
            }
            else{
                $sql = "SELECT * FROM questions ORDER BY id";
            }
            
            $result = $conn->query($sql);
            if($result->num_rows == 0){
                echo "
                <div class='question-container'>
                    <p>No matching questions found.</p>
                </div>
                ";
            }
            foreach($result as $row){
                $userid = $row['user_id'];
                $sql2 = "SELECT username FROM users WHERE id = $userid";
                $result2 = $conn->query($sql2);

                $username = $result2->fetch_assoc()['username'];
                $created_at = timeAgo($row['created_at']);
                $title = $row['title'];
                $q_id = $row['id'];
                echo "
                <div class='question-container'>
                    <div class='question-header'>
                        <div class='user'>$username</div>
                        <div class='question-footer'>";

                        //LIKE COUNT
                        $like_query = "SELECT COUNT(*) as total_likes FROM likes WHERE question_id = $q_id";
                        $like_result = $conn->query($like_query);
                        $likes = $like_result->fetch_assoc()['total_likes'];

                        //COMMENT COUNT
                        $comment_query = "SELECT COUNT(*) as total_comments FROM answers WHERE question_id = $q_id";
                        $comment_result = $conn->query($comment_query);
                        $comments = $comment_result->fetch_assoc()['total_comments'];

                        //CHECK IF USER LIKED
                        $userLiked = false;

                        if(isset($_SESSION['user'])){
                            $uid = $_SESSION['user']['user_id'];
                            $liked_query = "SELECT * FROM likes WHERE question_id = $q_id AND user_id = $uid";
                            $liked_result = $conn->query($liked_query);
                            $userLiked = $liked_result->num_rows > 0;
                        }

                        $heartColor = $userLiked ? 'liked-heart' : '';

                    echo "  <div class='question-actions'>

                                <a href='./server/requests.php?like=$q_id' class='like-btn'>
                                    <i class='fa-solid fa-heart $heartColor'></i>
                                    <span>$likes</span>
                                </a>

                                <a href='?q-id=$q_id#commentsSection' class='comment-btn'>
                                    <i class='fa-solid fa-comment'></i>
                                    <span>$comments</span>
                                </a>

                            </div>

                        </div>
                        ";

                    echo "
                    </div>
                    <div class='user'> $created_at </div>
                    <div class='question'>
                        <div class = 'question-title'> <a href='?q-id=" . $row['id'] . "'>$title </a> </div>";
                        
                echo isset($u_id) ? "<div class='delete'> 
                <button 
                    class='delete-btn'
                    data-bs-toggle='modal'
                    data-bs-target='#deleteModal$q_id'>

                    Delete

                </button></div>" : "";
                echo "</div> </div>";
                if(isset($u_id)){
                    include './client/delete-dialogbox.php';
                }
            }
            
        ?>
    </div>

    <div class="categories-list">
        <?php include 'categories.php'; ?>
    </div>
</div>