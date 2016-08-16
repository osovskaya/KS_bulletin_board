<?php require_once(__DIR__ . '/../layouts/header.php');?>

<div class="content">

    <div class="flexbox">
        <div class="ad">
                <div class="ad_title">
                    <h2><?php echo $ad['title']; ?></h2>
                </div>
                    <table>
                        <tr>
                            <td class="ad_table_key">Category</td>
                            <td class="ad_table_value"><?php echo $ad['name']; ?></td>
                        </tr>
                        <tr>
                            <td class="ad_table_key">Description</td>
                            <td class="ad_table_value"><?php echo $ad['description']; ?></td>
                        </tr>
                        <tr>
                            <td class="ad_table_key">Author</td>
                            <td class="ad_table_value"><?php echo $ad['firstname'] . ' '; echo $ad['lastname'];?></td>
                        </tr>
                        <tr>
                            <td class="ad_table_key">Contact phone</td>
                            <td class="ad_table_value"><?php echo $ad['phone']; ?></td>
                        </tr>
                        <tr>
                            <td class="ad_table_key">Created at</td>
                            <td class="ad_table_value"><?php echo substr($ad['created_at'], 0, 10); ?></td>
                        </tr>
                    </table>
                    <img src="<?php echo $ad['image']; ?>"/>
            </div>
    </div>

    <form action="/ad/edit" method="POST">
        <input type="hidden" name="id" value="<?php echo $ad['id']; ?>">
        <input type="hidden" name="author" value="<?php echo $ad['author']; ?>">
        <input class="submit" type="submit" value="Edit">
    </form>

    <form action="/ad/delete" method="POST">
        <input type="hidden" name="id" value="<?php echo $ad['id']; ?>">
        <input type="hidden" name="author" value="<?php echo $ad['author']; ?>">
        <input class="submit" type="submit" value="Delete">
    </form>
</div>

<?php require_once(__DIR__ . '/../layouts/footer.php');?>
