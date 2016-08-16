<?php require_once(__DIR__ . '/../layouts/header.php');?>

<div class="content">
    <h2>My profile</h2>

    <?php if (empty($user)): ?>
        <p class="alert">You haven't add information yet</p>
    <?php else: ?>

        <div class="cabinet">
                <table>
                    <tr>
                        <td class="ad_table_key">First name</td>
                        <td class="ad_table_value"><?php echo $user['firstname']; ?></td>
                    </tr>
                    <tr>
                        <td class="ad_table_key">Last name</td>
                        <td class="ad_table_value"><?php echo $user['lastname']; ?></td>
                    </tr>
                    <tr>
                        <td class="ad_table_key">Email</td>
                        <td class="ad_table_value"><?php echo $user['email']; ?></td>
                    </tr>
                </table>
            </div>

        <form action="/cabinet/edit" method="GET">
            <input class="submit" type="submit" value="Edit profile">
        </form>

        <form action="/cabinet/ads" method="GET">
            <input class="submit" type="submit" value="My ads">
        </form>

    <?php endif; ?>
</div>

<?php require_once(__DIR__ . '/../layouts/footer.php');?>
