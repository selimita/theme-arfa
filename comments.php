<div class="comments">
    <h2 class="comments-title">
        <?php
        $arfa_comments = get_comments_number();
        if(1==$arfa_comments){
            _e("1 Comment","arfa");
        } else {
            echo $arfa_comments." ".__("Comments","arfa");
        }
        ?>
    </h2>
    <div class="comments-list">
        <?php 
        wp_list_comments();
        if(!comments_open()){
        ?>
            <h2>
            <?php _e("Comments are Closed !","arfa"); ?>
            </h2>
        <?php
        }
        ?>
    </div>
<div class="comments-pagination">
    <?php
    if ( get_comment_pages_count() > 1 && get_option('page_comments')):
        ?>
        <h2><?php _e("Comments Navigation","arfa"); ?></h2>
        <?php
        the_comments_pagination(array(
            'prev_text'=> __( '&rarr; Old Comments', 'arfa'),
            'next_text'=> __( 'New Comments &rarr;', 'arfa'),
            'screen_reader_text'=> " ",
        ));
    endif; 
    ?>
</div>
    <div class="comments-form">
        <?php comment_form(); ?>
    </div>
</div>