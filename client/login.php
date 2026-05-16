<div class="container">
    <h1 class="text-center">Login</h1>
    <form action="./server/requests.php" method="post">
        <div class="col-6 offset-3 sm-3 margin-bottom-15">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required placeholder="Enter your username">
        </div>
        <div class="col-6 offset-3 sm-3 margin-bottom-15">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
        </div>
        <button type="submit" class="btn btn-primary offset-3" name="login" value="login">Log In</button>
    </form>
</div>