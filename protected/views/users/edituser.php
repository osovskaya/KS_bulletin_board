<?php require_once(__DIR__ . '/../layouts/header.php');?>

<div class="content">
    <h2>Edit my profile</h2>

    <div class="cabinet">
        <form action="/cabinet/save" method="post" enctype="application/x-www-form-urlencoded">
            <label for="firstname">First name</label>
            <input type="text" name="firstname" value="<?php echo $user['firstname']; ?>" required  maxlength="20"><br>

            <label for="lastname">Last name</label>
            <input type="text" name="lastname" value="<?php echo $user['lastname']; ?>" required  maxlength="20"><br>

            <label for="email">Email</label>
            <input type="text" name="email" value="<?php echo $user['email']; ?>" required  maxlength="50"><br>

            <input type="hidden" name="id" value="<?php echo $user['id']; ?>"><br>

            <input class="submit" type="submit" value="Submit">
        </form>
    </div>
</div>

<?php require_once(__DIR__ . '/../layouts/footer.php');?>
