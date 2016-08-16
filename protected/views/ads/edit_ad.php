<?php require_once(__DIR__ . '/../layouts/header.php');?>

<div class="content">
    <h2>Edit advertisement</h2>

    <div class="ad">
        <form action="/ad/update" method="post" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" name="title" value="<?php echo $ad['title']; ?>" required  maxlength="50"><br>

            <label for="category">Category</label>
            <select name="category" value="<?php echo $ad['category']; ?>" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="short_description">Short description</label>
            <textarea name="short_description" value="<?php echo $ad['short_description']; ?>"
                      rows="3" cols="30" required maxlength="50">Ad short description</textarea><br>

            <label for="description">Description</label>
            <textarea name="description" value="<?php echo $ad['description']; ?>"
                      rows="6" cols="30" required maxlength="255">Ad description</textarea><br>

            <label for="phone">Phone</label>
            <input type="text" name="phone" value="<?php echo $ad['phone']; ?>" required  maxlength="12"><br>

            <input type="hidden" name="author" value="<?php echo $ad['author']; ?>"><br>

            <input type="hidden" name="id" value="<?php echo $ad['id']; ?>">

            <input class="submit" type="submit" value="Submit">

        </form>
    </div>
</div>

<?php require_once(__DIR__ . '/../layouts/footer.php');?>
