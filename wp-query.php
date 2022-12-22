<?php
/**
 * Template Name: WP Query
**/
get_header();
?>
<div class="posts">
    <h1 class="text-center">
        <?php echo _e("WP Query Audio","arfa"); ?>
    </h1>
<?php
$paged = get_query_var("paged") ? get_query_var("paged") : 1;
$posts_per_page = 2;
$_posts = new WP_Query(array(
    'posts_per_page'=> $posts_per_page,
    'paged'=> $paged,
    'meta_query'=>array(
        'relation'=> 'AND',
        array(
            'key'=> 'featured',
            'value'=> 24,
            'compare'=> '='
        ),
        array(
            'key'=> 'homepage',
            'value'=> 25,
            'compare'=> '='
        ),
    ),
));
while ( $_posts-> have_posts() ) {
    $_posts-> the_post();
    ?>
    <h2 class="text-center">
    <a href="<?php the_permalink(); ?>">
    <?php the_title(); ?>
    </a>
    </h2>
    <br>
    <?php
}
wp_reset_query(); // MUST
?>

</div>
<div class="cq-pagination text-center">
    <h3>
    <?php
    echo paginate_links(array(
        'total'=> $_posts-> max_num_pages,
        'current'=> $paged,
        'prev_next'=>false,
    ));
    ?>
    </h3>
</div>
<?php get_footer(); ?>