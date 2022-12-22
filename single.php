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
                <h3 class="tagline"><?php bloginfo( "description" );?></h3>
                <h1 class="align-self-center display-1 text-center heading">
                    <a href="<?php site_url();?>"><?php bloginfo( "name" );?></a>
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
    echo "</br>";
    the_post_thumbnail("arfa_portrait");
    echo "</br>";
    the_post_thumbnail("arfa_landscarpe");
    ?>
</div>
<?php
the_content();
if(get_post_format()=='image' && function_exists("the_field")):
    $img_size = get_field('image_size');
?>
<div class="acf-meta">
    <h2>Camera Model: <?php the_field('camera_mod'); ?></h2>
<?php if(get_field('licensed')): ?>
<strong><?php _e('Image Size: ','arfa'); ?></strong> 
<?php echo apply_filters("the_content",get_field('image_size')); ?>
<?php endif; ?>
<br />
<h2>ACF File: </h2>
    <?php
    $acf_file = get_field('my_file');
    $file_url = wp_get_attachment_url($acf_file);
    $thumb_id = get_field('download_file_thumbnail');
    $thumb_url = wp_get_attachment_image_url($thumb_id);
    $thumb_src = wp_get_attachment_image_src($thumb_id);
    echo '<pre>';
    print_r($thumb_url);
    echo '<br />';
    print_r($thumb_src[0]);
    echo '</pre>';
?>
<a href="<?php echo $file_url; ?>"><img src="<?php echo $thumb_url; ?>" alt=""></a>
</div>
    <?php
    endif;
    if(function_exists("the_field")):
    ?>
    <div class="related-posts">
        <?php
        // Current Post
        $arfa_cp = get_queried_object();
        $araf_rp = get_field("related_posts",$arfa_cp);
        // $araf_rp = get_post_meta(get_the_ID(),"related_posts",true);
        if($araf_rp):
            ?>
            <h2>
            <?php _e("Related Posts","arfa"); ?>
            </h2>
            <?php
            $arfa_wpq = new WP_Query(array(
                'post__in'=> $araf_rp,
                'orderby' => 'post__in',
            ));
            while($arfa_wpq->have_posts()){
                $arfa_wpq->the_post();
                ?>
                <h4><?php the_title(); ?></h4>
                <?php
            }
            wp_reset_query(); // MUST Reset Query
        endif;
        ?>
    </div>
    <?php
    endif;


    // CMB2 Metabox GET/USE
    if(get_post_format()=='image' && class_exists("CMB2")):
        ?>
        <div class="cmb2-meta">
            <h2>
            <?php
            _e("Image Details: ","arfa");
            the_title();
            ?>
            </h2>

            <div class="image-info">
                <?php
                $arfa_cm = get_post_meta(get_the_ID(),"_arfa_camera_model",true);
                $arfa_lc = get_post_meta(get_the_ID(),"_arfa_location",true);
                $arfa_dt = get_post_meta(get_the_ID(),"_arfa_date",true);
                $arfa_ld = get_post_meta(get_the_ID(),"_arfa_licensed",true);
                $arfa_li = get_post_meta(get_the_ID(),"_arfa_licensed_info",true);
                if($arfa_cm){
                    echo esc_html($arfa_cm,'arfa')."<br />";
                }
                if($arfa_lc){
                    echo esc_html($arfa_lc,'arfa')."<br />";
                }
                if($arfa_dt){
                    echo esc_html($arfa_dt,'arfa')."<br />";
                }
                if($arfa_ld){
                    echo apply_filters("the_content",$arfa_li)."<br />";
                }else{
                    echo "OFF";
                }
    // GET/USE CMB2 Image Value
    $arfa_cmb2_img = get_post_meta(get_the_ID(),"_arfa_cmb2_image_id",true);
    $arfa_url = wp_get_attachment_image_src($arfa_cmb2_img,"large");
    if($arfa_cmb2_img){
        echo "<img src='". esc_html($arfa_url[0])."' />";
    }
    $arfa_resume = get_post_meta(get_the_ID(),"_arfa_resume",true);
    if($arfa_resume){
        ?>
        <a href="<?php echo esc_url($arfa_resume); ?>">
        <?php _e('Download Resume','arfa') ?>
        </a>
        <?php
    }
    
                
                ?>
            </div>
        </div>
        <?php
    endif;
    // End CMB2 Metabox
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