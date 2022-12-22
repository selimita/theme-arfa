<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                &copy; LWHH - All Rights Reserved
            </div>
            <div class="col-md-6">
                <?php 
                    wp_nav_menu(array(
                        'theme_location'=> 'socialmenu',
                        'menu_id'=> 'social-menu',
                        'menu_class'=>'list-inline text-right',
                    ))
                ?>
            </div>
        </div>
    </div>
</div>
<?php wp_footer();?>
</body>
</html>