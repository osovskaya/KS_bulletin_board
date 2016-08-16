<?php require_once(__DIR__ . '/../layouts/header.php');?>

<div class="content">
    <h2>My advertisements</h2>

    <?php if (empty($ads)): ?>
        <p class="alert">You don't have any ads yet</p>
    <?php else: ?>
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
                        <p class="ad_category"><?php echo $ad['name']; ?></p>
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
    <?php endif; ?>
</div>

<?php require_once(__DIR__ . '/../layouts/footer.php');?>
