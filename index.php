<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discuss Project</title>
    <?php include 'client/commonFiles.php'; ?>

</head>
<button id="scrollTopBtn">
    ↑
</button>
<body>
    <?php
        session_start();
        include 'client/header.php'; ?>
        
        <?php if(isset($_SESSION['error'])): ?>

            <div class="error-message alert-message">
                <?= $_SESSION['error']; ?>
            </div>

        <?php unset($_SESSION['error']); endif; ?>

        <?php if(isset($_SESSION['success'])): ?>

            <div class="success-message alert-message">
                <?= $_SESSION['success']; ?>
            </div>

        <?php unset($_SESSION['success']); endif; ?>

    <?php
        if(isset($_GET['signup']) && !isset($_SESSION['user'])){
            include 'client/signup.php';    
        }
        else if(isset($_GET['login']) && !isset($_SESSION['user'])){
            include 'client/login.php';    
        }
        else if(isset($_GET['ask']) && isset($_SESSION['user'])){
            include 'client/ask.php';    
        }
        else if(isset($_GET['q-id'])){
            $q_id = $_GET['q-id'];
            include 'client/question-details.php';    
        }
        else if(isset($_GET['c-id'])){
            $c_id = $_GET['c-id'];
            include 'client/questions.php';    
        }
        else if(isset($_GET['u-id'])){
            $u_id = $_GET['u-id'];
            include 'client/questions.php';    
        }
        else if(isset($_GET['latest'])){
            include 'client/questions.php';    
        }
        else if(isset($_GET['search'])){
            $search = $_GET['search'];
            include 'client/questions.php';    
        }
        else{
            include 'client/questions.php';    
        }
    ?>
    
    <script src="./public/script.js"></script>
    
</body>
</html>