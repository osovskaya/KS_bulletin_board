<?php require_once(__DIR__ . '/../layouts/header.php');?>

<div class="content">
    <h2>Add new advertisement</h2>

    <div class="ad">
        <form action="/ad/save" method="post" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" name="title" required  maxlength="50"><br>

            <label for="occupation">Category</label>
            <select name="category" required>
                <option value="1">general</option>
                <option value="2">education</option>
                <option value="3">vacation</option>
                <option value="4">work</option>
            </select><br>

            <label for="short_description">Short description</label>
            <textarea name="short_description" rows="3" cols="30" required maxlength="50">Ad short description</textarea><br>

            <label for="description">Description</label>
            <textarea name="description" rows="6" cols="30" required maxlength="255">Ad description</textarea><br>

            <label for="phone">Phone</label>
            <input type="text" name="phone" required  maxlength="12"><br>

            <label for="image">Your photo</label>
            <input type="file" name="image" accept="image/*" required><br>

            <input type="hidden" name="author" value="
            <?php
                if(!empty($_SESSION['userid'])) echo $_SESSION['userid'];
            ?>
            "><br>

            <input class="submit" type="submit" value="Submit">

        </form>
        </div>
</div>

<?php require_once(__DIR__ . '/../layouts/footer.php');?>
