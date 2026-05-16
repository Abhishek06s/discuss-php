<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./"><img src="./public/discuss-among-us.png" alt="DISCUSS" width="60px" height="60px"></img></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./">Home</a>
        </li>
        <?php
            if(isset($_SESSION['user'])){?>
                <li class="nav-item">
                  <a class="nav-link" href="./server/requests.php?logout=true">Logout <?php echo "<span id='loggedInUser'> (" . $_SESSION['user']['username'] . ")</span>"?> </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="?ask=true">Ask A Question</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="?u-id=<?php echo $_SESSION['user']['user_id']?>">My Questions</a>
                </li>
        <?php } ?>


        <?php
            if(!isset($_SESSION['user'])){?>
                <li class="nav-item">
                    <a class="nav-link" href="?login=true">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?signup=true">Signup</a>
                </li>
        <?php } ?>
        
        <li class="nav-item">
          <a class="nav-link" href="?latest=true">Latest Questions</a>
        </li>
      </ul>
    </div>

    <form class="search-form" action="">
      <div class="search-box">

          <i class="fa-solid fa-magnifying-glass"></i>

          <input 
              class="search-input"
              type="search"
              placeholder="Search questions..."
              name="search"
              value='<?php echo isset($_GET["search"]) ? $_GET["search"] : ""; ?>'
          >

      </div>

      <button class="search-btn" type="submit">
          Search
      </button>
  </form>

  </div>
</nav>