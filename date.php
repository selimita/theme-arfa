<?php get_header(); ?>
<div class="posts">
    <h1 class="text-center">
        <?php echo _e("Posts Under:","arfa"); ?>
    <?php 
    if(is_month()){
        $month = get_query_var("monthnum");
        $monthobj = DateTime::createFromFormat("!m",$month);
        echo $monthobj->format("F");
    } else if(is_year()){
        echo esc_html(get_query_var("year"));
    } else if(is_day()){
        $monthn = get_query_var("monthnum");
        $monthen = DateTime::createFromFormat("!m",$monthn);
        $month = esc_html($monthen->format("F"));
        $year = esc_html(get_query_var("year"));
        $day = esc_html(get_query_var("day"));
        //echo $month," ".$day,", ".$year;
        printf("%s %s, %s",$month,$day,$year);
    }   
    ?>
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