<div class="container discussion-layout">

    <!-- LEFT SIDE -->
    <div class="left-panel">
        <div class="container questions-container">
            <h1 class="heading">Question Details</h1>

            <?php
                include './server/db.php';

                $sql = "SELECT * FROM questions WHERE id = $q_id";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $c_id = $row['category_id'];

                $userid = $row['user_id'];

                $sql2 = "SELECT username FROM users WHERE id = $userid";
                $result2 = $conn->query($sql2);

                $username = $result2->fetch_assoc()['username'];
                $created_at = date("d M Y", strtotime($row['created_at']));
                echo "
                <div class='question-container'> 
                    <div class='user'>$username</div>
                    <div class='user'> $created_at </div>
                    <h5>" . $row['title'] . "</h5>
                    <p>" . $row['description'] . "</p>
                </div>";
            ?>

            <!-- ANSWER FORM -->
            <form action="./server/requests.php" method="post">
                <input type="hidden" name="question_id" value="<?php echo $q_id; ?>">
                <textarea class="form-control" name="answer" rows="5" placeholder="Write your comment here..."></textarea>
                <button type="submit" class="btn btn-primary mt-3" name="submit-answer" value="submit-answer">Submit Answer</button>
            </form>
        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="right-panel">
        <h1 class="heading">Related Questions: </h1>
        <?php
            $sql = "SELECT * from questions WHERE category_id = $c_id and id != $q_id";
            $result = $conn->query($sql);
            if($result->num_rows == 0){
                echo "<p style='color: #666; padding: 15px;'>No Related questions yet!</p>";
            }
            foreach($result as $row){
                $userid = $row['user_id'];
                $sql2 = "SELECT username FROM users WHERE id = $userid";
                $result2 = $conn->query($sql2);

                $username = $result2->fetch_assoc()['username'];
                $title = $row['title'];
                $created_at = date("d M Y", strtotime($row['created_at']));
                
                echo "
                    <div class='question-container'>
                        <div class='question'>
                            <a href='?q-id=" . $row['id'] . "'>$title</a>
                        </div>
                    </div>
                    ";
            }
        ?>
    </div>
</div>

<div class="container comments-container">
        <?php include './client/answers.php'; ?>
</div>
