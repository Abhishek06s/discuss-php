<div class="container answers-container">
    <div class = "comments-header">
        <h1 class="heading">Comments:</h1>
        <button 
            class="comments-toggle-btn"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#commentsSection">

            Show / Hide Comments

        </button>
    </div>

    <div class="collapse show" id="commentsSection">
    <?php
        include './client/timeAgo.php';
        $query = "SELECT * FROM answers WHERE question_id = $q_id";
        $result = $conn->query($query);

        if($result->num_rows == 0){
            echo "<p style='color: #666; padding: 15px;'>No comments yet. Be the first to comment!</p>";
        }

        foreach($result as $row){
            $answer = $row['answer'];
            $userid = $row['user_id'];
            $sql2 = "SELECT username FROM users WHERE id = $userid";
            $result2 = $conn->query($sql2);

            $username = $result2->fetch_assoc()['username'];
            $created_at = timeAgo($row['created_at']);

            echo "
            <div class='answer-container'>
                <div class='user'>$username</div>
                <div class='user'> $created_at </div>
                <div class='answer'>
                    <p>" . $answer . "</p>
                </div>
            </div>
            ";
        }
    ?>
    <div>
</div>