<?php
    session_start();
    include './db.php';

    function setMessage($type, $message){
        $_SESSION[$type] = $message;
    }

    function redirectBack(){
        $redirect = $_SERVER['HTTP_REFERER'] ?? '/discuss';
        header("Location: " . $redirect);
        exit();
    }

    //SIGNUP REQUEST
    if(isset($_POST['signup'])){

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $user_id = 0;

        $filter_user = filter_var($username, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9]{3,}$/")));
        $filter_pass = filter_var($password, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d_-]{8,}$/")));
        $filter_email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if(!$filter_user){
            setMessage("error", "Username must be at least 3 characters long and can only contain letters and numbers.");
            redirectBack();
        }

        if(!$filter_pass){
            setMessage("error", "Password must be at least 8 characters long and contain at least one letter and one number.");
            redirectBack();
        }

        if(!$filter_email){
            setMessage("error", "Invalid email format.");
            redirectBack();
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $user = $conn->prepare("INSERT INTO users (`id`, `username`, `email`, `password`, `address`) VALUES (NULL, ?, ?, ?, ?)");
        $user->bind_param("ssss", $username, $email, $hash, $address);

        try {

            $user->execute();

            if($user->affected_rows > 0){

                $_SESSION["user"] = [
                    "username" => $username,
                    "email" => $email,
                    "user_id" => $user->insert_id,
                ];

                setMessage("success", "Account created successfully.");

                header("Location: /discuss");
                exit();
            }

        }

        catch(mysqli_sql_exception $e){

            if($e->getCode() == 1062){

                if(str_contains($e->getMessage(), 'unique_username')){
                    setMessage("error", "Username already exists.");
                    redirectBack();
                }

                if(str_contains($e->getMessage(), 'unique_email')){
                    setMessage("error", "Email already exists.");
                    redirectBack();
                }

                setMessage("error", "Duplicate entry detected.");
                redirectBack();
            }

            setMessage("error", "Database error occurred.");
            redirectBack();
        }
    }

    //LOGIN REQUEST
    else if(isset($_POST['login'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_id = 0;

        $filter_user = filter_var($username, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9]{3,}$/")));
        $filter_pass = filter_var($password, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d_-]{8,}$/")));

        if(!$filter_user){
            setMessage("error", "Invalid username format. Username must be at least 3 characters long and can only contain letters and numbers.");
            redirectBack();
        }

        if(!$filter_pass){
            setMessage("error", "Invalid password format. Password must be at least 8 characters long and contain at least one letter and one number.");
            redirectBack();
        }

        $user = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $user->bind_param("s", $username);
        $user->execute();

        $result = $user->get_result();

        if($result->num_rows == 1){

            $row = $result->fetch_assoc();

            if(password_verify($password, $row['password'])){

                $_SESSION["user"] = [
                    "username" => $row['username'],
                    "email" => $row['email'],
                    "user_id" => $row['id'],
                ];

                setMessage("success", "Logged in successfully.");

                header("Location: /discuss");
                exit();
            } 
            else {

                setMessage("error", "Incorrect password.");
                redirectBack();
            }
        } 
        else {

            setMessage("error", "User not found.");
            redirectBack();
        }
    }

    //LOGOUT REQUEST
    else if(isset($_GET['logout'])){
        session_destroy();

        header("Location: /discuss");
        exit();
    }

    //ASK QUESTION REQUEST
    else if(isset($_POST['ask'])){

        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        $user_id = $_SESSION['user']['user_id'];

        $filter_title = filter_var($title, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^.{5,}$/s")));

        if(!$filter_title){

            setMessage("error", "Title must be at least 5 characters long.");
            redirectBack();
        }

        $question = $conn->prepare("INSERT INTO questions (`id`, `title`, `description`, `category_id`, `user_id`) VALUES (NULL, ?, ?, ?, ?)");

        $question->bind_param("ssii", $title, $description, $category_id, $user_id);

        try {

            $question->execute();

            if($question->affected_rows > 0){

                setMessage("success", "Question posted successfully.");

                header("Location: /discuss");
                exit();
            }

        }

        catch(mysqli_sql_exception $e){

            setMessage("error", "Database error occurred.");
            redirectBack();
        }
    }

    //SUBMIT ANSWER REQUEST
    else if(isset($_POST['submit-answer'])){

        if(!isset($_SESSION['user'])){

            setMessage("error", "You must be logged in to submit an answer.");
            redirectBack();
        }

        $answer = $_POST['answer'];
        $question_id = $_POST['question_id'];
        $user_id = $_SESSION['user']['user_id'];

        $filter_answer = filter_var($answer, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^.{5,}$/s")));

        if(!$filter_answer){

            setMessage("error", "Answer must be atleast 5 characters.");
            redirectBack();
        }

        $stmt = $conn->prepare("INSERT INTO answers (`id`, `answer`, `question_id`, `user_id`) VALUES (NULL, ?, ?, ?)");

        $stmt->bind_param("sii", $answer, $question_id, $user_id);

        try {

            $stmt->execute();

            if($stmt->affected_rows > 0){

                setMessage("success", "Answer submitted successfully.");

                header("Location: /discuss?q-id=" . $question_id);
                exit();
            }
            else {

                setMessage("error", "Failed to submit answer. Please try again.");
                redirectBack();
            }

        }

        catch(mysqli_sql_exception $e){

            setMessage("error", "Database error occurred.");
            redirectBack();
        }
    }

    //LIKE QUESTION REQUEST
    else if(isset($_GET['like'])){
        if(!isset($_SESSION['user'])){

            setMessage("error", "You must be logged in to like a question.");
            redirectBack();
        }

        $question_id = $_GET['like'];
        $user_id = $_SESSION['user']['user_id'];

        //CHECK IF USER ALREADY LIKED
        $check = $conn->prepare(
            "SELECT * FROM likes WHERE question_id = ? AND user_id = ?"
        );

        $check->bind_param("ii", $question_id, $user_id);
        $check->execute();

        $result = $check->get_result();

        //IF ALREADY LIKED -> REMOVE LIKE
        if($result->num_rows > 0){

            $delete = $conn->prepare(
                "DELETE FROM likes WHERE question_id = ? AND user_id = ?"
            );

            $delete->bind_param("ii", $question_id, $user_id);
            $delete->execute();
        }

        //ELSE ADD LIKE
        else{

            $insert = $conn->prepare(
                "INSERT INTO likes(question_id, user_id) VALUES(?, ?)"
            );

            $insert->bind_param("ii", $question_id, $user_id);
            $insert->execute();
        }

        redirectBack();
    }

    else if(isset($_GET["delete"])){
        $q_id = $_GET["delete"];
        $sql1 = "DELETE from questions WHERE id = $q_id";
        $sql2 = "DELETE from answers WHERE question_id = $q_id";
        $result1 = $conn->query($sql1);
        $result2 = $conn->query($sql2);
        setMessage("success", "Question deleted successfully.");
        header("Location: /discuss");
    }
?>