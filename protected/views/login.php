<?php require_once(__DIR__ . '/layouts/header.php');?>

<div class="content">
    <h2>Login</h2>

    <div class="cabinet">
        <form action="/authorize" method="post" enctype="multipart/form-data">
            <label for="email">Email</label>
            <input type="text" name="email" required  maxlength="50"><br>

            <label for="password">Password</label>
            <input type="password" name="password" required maxlength="8"><br>

            <input class="submit" type="submit" value="Login">
        </form>
    </div>

    <p>First time here? <a href="/register">Register</a></p>
</div>

<script src="/static/js/login.js"></script>

<?php require_once(__DIR__ . '/layouts/footer.php');?>
