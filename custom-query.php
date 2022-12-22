<?php
/**
 * Template Name: Custom Query
**/
get_header();
?>
<div class="posts">
    <h1 class="text-center">
        <?php echo _e("Custom Query","arfa"); ?>
    </h1>
<?php
$paged = get_query_var("paged") ? get_query_var("paged") : 1;
$posts_per_page = 2;
$total = 9;

$_posts = get_posts(array(
    'posts_per_page'=> $posts_per_page,
    'author__in'=> array(1),
    'totalnum'=> $total,
    'orderby'=> 'post__in',
    'paged'=> $paged
));
foreach ( $_posts as $nopdata ) {
    // setup_postdata($post);
    echo "<pre>";
    print_r($nopdata);
    echo "</pre>";
    ?>
    <h2 class="text-center">
    <a href="<?php echo esc_url($nopdata->guid); ?>">
    <?php echo apply_filters("the_title",$nopdata->post_title); ?></a>
    </h2>
    <br>
    <?php
}
// wp_reset_postdata();
?>
</div>
<div class="cq-pagination text-center">
    <h3>
    <?php
    echo paginate_links(array(
        'total'=>ceil($total/$posts_per_page),
    ));
    ?>
    </h3>
</div>
<?php get_footer(); ?>
