<?php require_once __DIR__ . '/layouts/header.tpl.php'; ?>


<div class="container mt-5">
    <div class="row">

        <div class="col-md-6 offset-md-3">

            <?php if (isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php
                    echo $_SESSION['errors'];
                    unset($_SESSION['errors']);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                    <!-- <label for="email">Email</label> -->
                </div>
                <br>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    <!-- <label for="password">Password</label> -->
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>

        </div>

    </div>


</div>

<?php require_once __DIR__ . '/layouts/footer.tpl.php'; ?>