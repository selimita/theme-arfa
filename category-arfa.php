<?php
get_header();
?>
<br />
<div class="container">
    <div class="row">
        <div class="col-md-12 term-meta text-center">
        <?php 
        echo "Category Name: ";
        single_cat_title();
        echo '<br />';
        echo '<br />';
        // Current Term
        $arfa_current_term = get_queried_object();
        $arfa_thumbnail = get_field("thumbnail",$arfa_current_term);
        if($arfa_thumbnail){
            ?>
            <img src="<?php echo $arfa_thumbnail['sizes']['arfa_square']; ?>" alt="">
            <?php
        }
        ?>
        </div>
    </div>
</div>
<br />
<?php
get_footer();
?>
