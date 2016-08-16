<?php require_once(__DIR__ . '/../layouts/header.php');?>

<div class="content">

    <div class="flexbox">
       <?php foreach($ads as $ad): ?>
        <div class="ad">
            <div class="ad_header">
                <div class="ad_title">
                    <a href="/ad?id=<?php echo $ad['id']; ?>">
                    <?php echo $ad['title']; ?></a>
                </div>
                <div class="ad_date"><?php echo substr($ad['created_at'], 0, 10); ?></div>
            </div>
            <div class="ad_body">
                <a href="/ads?category=<?php echo $ad['category']; ?>"><p class="ad_category"><?php echo $ad['name']; ?></p></a>
                <p class="ad_description"><?php echo $ad['short_description']; ?>...</p>
                <img class="ad_image" src="<?php echo $ad['image']; ?>"/>
            </div>
            <div class="ad_contact">
                <div class="ad_author"><?php echo $ad['firstname'] . ' '; echo $ad['lastname'];?></div>
                <div class="ad_phone">+<?php echo $ad['phone']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <p class="pagination"><a href="/ads?next=<?php echo $_SESSION['page'] - 1; ?>">prev</a> | <a href="/ads?next=<?php echo $_SESSION['page'] + 1; ?>">next</a></p>
</div>

<?php require_once(__DIR__ . '/../layouts/footer.php');?>
