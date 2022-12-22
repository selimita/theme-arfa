<?php get_header(); ?>

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

<?php get_footer(); ?>