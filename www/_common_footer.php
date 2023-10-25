<footer>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="logo">
                    <a href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>index.php"><img src="<?php echo $setting_logo; ?>" alt="<?php echo CONFIG_NAME_SITE; ?>" width="216"></a>
                </div>
            </div>
            <div class="col col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="social">
                    <ul class="list-inline social-buttons">
                        <?php if (!empty($setting_url_pinterest)) { ?>
                            <li><a href="<?php echo $setting_url_pinterest; ?>" target="_blank"><i class="fa fa-pinterest"></a></i>
                            <?php } ?>
                            <?php if (!empty($setting_url_facebook)) { ?>
                            <li><a href="<?php echo $setting_url_facebook; ?>" target="_blank"><i class="fa fa-facebook"></a></i>
                            <?php } ?>
                            <?php if (!empty($setting_url_instagram)) { ?>
                            <li><a href="<?php echo $setting_url_instagram; ?>" target="_blank"><i class="fa fa-instagram"></a></i>
                            <?php } ?>
                            <?php if (!empty($setting_url_tiktok)) { ?>
                            <li><a href="<?php echo $setting_url_tiktok; ?>" target="_blank"><i class="fa fa-tiktok">
                                        <div class="tiktok-image"></div></a></i>
                            <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col col-xl-4 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="copyright">
                    <p class="text-end">
                        Copyright © <?php echo CONFIG_NAME_SITE; ?> <?php echo date('Y'); ?> All rights reserved.</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>