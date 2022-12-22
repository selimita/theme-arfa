<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php wp_head();?>
</head>
<body <?php body_class(array("class-1", "class-2"));?>>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="tagline"><?php echo "<strong>Child</strong> "; ?><?php bloginfo( "description" );?></h3>
                <h1 class="align-self-center display-1 text-center heading">
                    <a href="<?php site_url();?>"><?php bloginfo( "name" );?></a>
                    <?php arfa_date(); ?>
                </h1>
            </div>
        </div>
    </div>
</div>
    <?php 
    $arfa_sidebar = "col-md-8";
    $arfa_tc = "";
    if(!is_active_sidebar("sidebar-1")){
        $arfa_sidebar = "col-md-10 offset-md-1";
        $arfa_tc = "text-center";
    }
    ?>
<div class="container">
    <div class="row">
        <div class="<?php echo $arfa_sidebar; ?>">
            <div class="posts">
                <?php
                while ( have_posts() ) {
                    the_post();
                    ?>
                        <div <?php post_class();?>>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="post-title <?php echo $arfa_tc; ?>"><?php the_title();?></h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 <?php echo $arfa_tc; ?>">
                                            <p>
                                                <strong><?php the_author_posts_link();?></strong><br/>
                                                <?php the_date();?>
                                                </p>
                                                <ul class="list-unstyled">
                                                    <li>dhaka</li>
                                                </ul>
                                                <?php 
                                                    echo get_the_tag_list("<ul class='list-unstyled'>","</li><li>","</li></ul>"); 
                                                ?>
                                            
                                        </div>
                                        <div class="col-md-12 <?php echo $arfa_tc; ?>">
    <div class="slider">
        <?php
        if ( class_exists( 'Attachments' ) ) {
            $attachments = new Attachments('slider');
            if($attachments->exist()){
                while($attachment = $attachments->get()){
                    ?>
                    <div>
                        <?php echo $attachments->image('large'); ?>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
    <div>
    <?php
    if ( !class_exists( 'Attachments' ) ) {
        if(has_post_thumbnail()){
            $thumbnail_url= get_the_post_thumbnail_url(null,"large");
            // echo '<a href="'.$thumbnail_url.'" data-featherlight="image">';
            echo '<a class="popup" href="#" data-featherlight="image">';
            the_post_thumbnail("large",array("class"=>"img-fluid"));
            echo '</a>';
        }
    }
    ?>
    <?php 
    echo "</br>";
    the_post_thumbnail("arfa_square");
    ?>
    </div>
                                            <?php
                                            the_content();
                                            wp_link_pages(array(
                                                'before'           => '<p class="post-nav-links">' . __( 'SP-Pages:' ),
                                                'after'            => '</p>',
                                                'link_before'      => '',
                                                'link_after'       => '',
                                                'aria_current'     => 'page',
                                                'next_or_number'   => 'number',
                                                'separator'        => ' ',
                                                'nextpagelink'     => __( 'Next page' ),
                                                'previouspagelink' => __( 'Previous page' ),
                                            ));
                                            ?>
                                        </div>
<?php if(!post_password_required()): ?>
    <div class="comments">
        <?php 
        comments_template(); 
        ?>
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
        </div>
    <?php if(is_active_sidebar("sidebar-1")): ?>
    <div class="col-md-4 single-sidebar">
        <?php 
            if(is_active_sidebar("sidebar-1")){
                dynamic_sidebar("sidebar-1");
            }
        ?>
    </div>
    <?php endif; ?>
    </div>
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