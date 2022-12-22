<?php get_header(); ?>
<div class="posts">
    <h1 class="text-center">
        <?php echo _e("Author:","arfa"); ?>
        <?php echo get_the_author_meta("display_name"); ?>
    </h1>
    <div class="container">
        <div class="avatar">
            <div class="row">
                <div class="col-md-2">
                    <?php 
                    echo get_avatar(get_the_author_meta("ID"));
                    ?>
                </div>
                <div class="col-md-10">
                    <?php 
                    echo get_the_author_meta("nicename");
                    ?>
                    <p><?php echo get_the_author_meta("description"); ?></p>
                </div>
                <div class="col-md-12">
                    <div class="user-meta">
    <?php
    if(function_exists("the_field")):
        if($arfa_facebook):
            _e('Facebook: ','arfa');
            the_field("facebook","user_".get_the_author_meta("ID"));
        endif;
        echo "<br />";
        if($arfa_twitter):
            _e('Twitter: ','arfa');
            the_field("twitter","user_".get_the_author_meta("ID"));
        endif;
    endif;
    ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
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