<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php wp_head();?>
</head>
<body <?php body_class();?>>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="tagline"><?php bloginfo( "description" );?></h3>
                <h1 class="align-self-center display-1 text-center heading">
                    <a href="<?php site_url();?>"><?php bloginfo( "name" );?></a>
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="posts">
    <?php
    while ( have_posts() ) {
        the_post();
        ?>
            <div class="post" <?php post_class();?>>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <h2 class="post-title text-center"><?php the_title();?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <p class="text-center">
                                <strong><?php the_author();?></strong><br/>
                                <?php the_date();?>
                                </p>
                                <ul class="list-unstyled">
                                    <li>dhaka</li>
                                </ul>
                                <?php 
                                    echo get_the_tag_list("<ul class='list-unstyled'>","</li><li>","</li></ul>"); 
                                ?>
                            </div>
                            <div class="col-md-10 offset-md-1 text-center">
                                <p>
                                <?php 
                                if(has_post_thumbnail()){
                                    $thumbnail_url= get_the_post_thumbnail_url(null,"large");
                                    // echo '<a href="'.$thumbnail_url.'" data-featherlight="image">';
                                    echo '<a class="popup" href="#" data-featherlight="image">';
                                    the_post_thumbnail("large",array("class"=>"img-fluid"));
                                    echo '</a>';
                                }
                                ?>
                                </p>
                                <?php
                                the_content();
                                ?>
                            </div>
                            <?php if(comments_open()): ?>
                                <div class="comments">
                                    <?php comments_template(); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
        <?php
    }
    the_posts_pagination(array(
        'screen_reader_text'=> '',
        'prev_text'=> 'New Posts',
        'next_text'=> 'Old Posts'
    ));
    ?>
</div>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php 
                if(is_active_sidebar("sidebar-2")){
                    dynamic_sidebar("sidebar-2");
                }
            ?>
            </div>
        </div>
    </div>
</div>
<?php wp_footer();?>
</body>
</html>