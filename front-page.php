<?php
/*
* Template Name: Arfa FrontPage
*/
?>

<?php get_header(); ?>
<?php 
the_post_thumbnail("arfa_square");
the_post_thumbnail("arfa_portrait");
the_post_thumbnail("arfa_landscarpe");
?>
<div class="posts">
<?php
while ( have_posts() ) {
    the_post();
    ?>
    <?php  
    get_template_part("post-formats/content",get_post_format());
    ?> 
    <?php
} 
the_posts_pagination(array(
    'screen_reader_text'=> '',
    'prev_text'=> 'New Posts',
    'next_text'=> 'Old Posts'
));
?>
<div class="post-navigation text-center">
    <?php 
        previous_post_link();
        echo " | ";
        next_post_link();
    ?>
</div>
<div class="avatar">
    <div class="row">
        <div class="col-md-2">
            <?php 
            echo get_avatar(get_the_author_meta("ID"));
            ?>
        </div>
        <div class="col-md-10">
            <?php 
            echo get_the_author_meta("display_name");
            ?>
            <p><?php echo get_the_author_meta("description"); ?></p>
        </div>
    </div>
</div>
</div>
<?php if(is_front_page()){ ?>
<div class="testimonials slider">
    <?php
    if ( class_exists( 'Attachments' ) ) {
        $attachments = new Attachments('testimonials',56);
        if($attachments->exist()){
            while($attachment = $attachments->get()){
                ?>
                <div>
                    <?php echo $attachments->image('thumbnail'); ?>
                    <h1><?php echo $attachments->field('name'); ?></h1>
                    <p><?php echo $attachments->field('designation'); ?></p>
                    <strong><?php echo $attachments->field('company'); ?></strong>
                    <p><?php echo $attachments->field('testimonial'); ?></p>
                </div>
                <?php
            }
        }
    }
    ?>
</div>
<?php } ?>

<?php get_footer(); ?>