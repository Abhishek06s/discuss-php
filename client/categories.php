<div>
    <h1 class="cat-heading heading">Categories: </h1>
    <?php
        include './server/db.php';
        $query = "SELECT * from category";
        $result = $conn->query($query);
        
        foreach($result as $row){
            $id = $row['id'];
            $name = $row['name'];
            echo "<div class='row category'><a href='?c-id=$id'>".
            $name."<br></a></div>";
        }
    ?>
</div>