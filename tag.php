<?php get_header(); ?>
<div class="posts">
    <h1 class="text-center">
        <?php echo _e("Post Under:","arfa"); ?>
        <?php single_tag_title(); ?>
    </h1>
<?php
while ( have_posts() ) {
    the_post();
    ?>
    <h2 class="text-center">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
    <br>
    <?php
}
?>
</div>
<?php get_footer(); ?>