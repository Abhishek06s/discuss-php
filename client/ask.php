<div class="container">
    <h1 class="text-center">Ask a Question</h1>
    <form action="./server/requests.php" method="post">
        <div class="col-6 offset-3 sm-3 margin-bottom-15">
            <label for="title" class="form-label">Question Title</label>
            <input type="text" class="form-control" maxlength="100" id="title" name="title" required placeholder="Enter your question">
            <div class="character-wrapper">
                <span id="question-charCount">0</span>
                <span class="char-text"> / 100 characters</span>
            </div>
        </div>

        <div class="col-6 offset-3 sm-3 margin-bottom-15">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" maxlength="1000" id="description" name="description" rows="5" placeholder="Provide more details about your question"></textarea>
            <div class="character-wrapper">
                <span id="description-charCount">0</span>
                <span class="char-text"> / 1000 characters</span>
            </div>
        </div>

        <div class="col-6 offset-3 sm-3 margin-bottom-15">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select">
                <?php
                    include './server/db.php';

                    $query = "SELECT * FROM category";
                    $result = $conn->query($query);

                    foreach($result as $row){

                        $name = $row['name'];
                        $id = $row['id'];

                        $selected = ($name == "Others") ? "selected" : "";

                        echo "<option value='$id' $selected>$name</option>";
                    }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary offset-3" name="ask" value="ask">Submit Question</button>
    </form>
</div>