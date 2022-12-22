<?php
/**
 * Template Name: Arfa Pricing
 */
get_header();
?>
<?php
?>
<div class="container">
    <div class="row">
        <?php
        $pricing  = get_post_meta( get_the_ID(), "_arfapt_pricing_table", true );
        foreach ( $pricing as $ptc ):
            ?>
            <div class="col-md-4">
                <h2><?php echo esc_html( $ptc['_arfapt_pricing_caption'] ) ?></h2>
                <ul>
                <?php
                $option_values = $ptc['_arfapt_pricing_option'];
                foreach ( $option_values as $option_value ):
                    ?>
                    <li><?php echo esc_html( $option_value ); ?></li>
                <?php
                endforeach;
                ?>
                </ul>
                <h3><?php echo esc_html( $ptc['_arfapt_price'] ) ?></h3>
            </div>

        <?php
        endforeach;
        ?>
    </div>
    <div class="row mt10">
<?php
$services  = get_post_meta( get_the_ID(), "_arfa_service", true );
foreach ( $services as $service ):
    $arfa_icon = $service['_arfa_icon'];
    ?>
    <div class="col-md-4">
        <h3><?php echo esc_html( $service['_arfa_icon'] ); ?></h3>
        <i class="fa <?php echo esc_attr( $arfa_icon ); ?>"></i>
        <h2><?php echo esc_html( $service['_arfa_title'] ); ?></h2>
        <?php echo apply_filters( "the_content", $service['_arfa_content'] ); ?>
    </div>
<?php
endforeach;
?>
    </div>
</div>
<?php
get_footer();