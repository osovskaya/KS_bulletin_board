<?php require_once(__DIR__ . '/../layouts/header.php');?>

<div class="content">
    <h2>Enter information about you</h2>

    <div class="cabinet">
        <form action="/adduser" method="post" enctype="application/x-www-form-urlencoded">
            <label for="firstname">First name</label>
            <input type="text" name="firstname" required  maxlength="20"><br>

            <label for="lastname">Last name</label>
            <input type="text" name="lastname" required  maxlength="20"><br>

            <label for="email">Email</label>
            <input type="text" name="email" required  maxlength="50"><br>

            <label for="password">Password</label>
            <input type="password" name="password" required maxlength="8"><br>

            <input class="submit" type="submit" value="Submit">
        </form>
    </div>

</div>

<?php require_once(__DIR__ . '/../layouts/footer.php');?>
