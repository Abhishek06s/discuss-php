<div class="container">
    <h1 class="text-center">Signup</h1>
    <form action="./server/requests.php" method="post">
        <div class="col-6 offset-3 -3 margin-bottom-15">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required placeholder="Enter your username">
        </div>
        <div class="col-6 offset-3 sm-3 margin-bottom-15">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
        </div>
        <div class="col-6 offset-3 sm-3 margin-bottom-15">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
        </div>
        <div class="col-6 offset-3 sm-3 margin-bottom-15">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required placeholder="Enter your address">
        </div>
        <button type="submit" class="btn btn-primary offset-3" name="signup" value="signup">Sign Up</button>
    </form>
</div>