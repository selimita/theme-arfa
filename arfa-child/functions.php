<?php 
// Arfa Child Theme

// Parent Theme Style Sheet Load
function arfa_child_assets(){
    wp_enqueue_style("parent-style", get_parent_theme_file_uri("/style.css"));
    //wp_enqueue_style("arfa-style", get_parent_theme_file_uri("/style.css"));
}
add_action("wp_enqueue_scripts","arfa_child_assets");

    // Child Assets Dequeue & Deregister
    function arfa_dequeue_deregister(){
        wp_dequeue_style("arfa-style-css");
        wp_deregister_style("arfa-style-css");
        wp_enqueue_style("arfa-style-css",get_theme_file_uri("/assets/css/style.css"));
    }
    add_action("wp_enqueue_scripts","arfa_dequeue_deregister");

// Parent Function Overright
function arfa_highlights($text){
    if(is_search()){
        $pattern = '/('. join('|', explode(' ', get_search_query())).')/i';
        $text = preg_replace($pattern, '<span class="arfa-highlights">\0</span>', $text);
    }
    return $text;
}
add_filter('the_content', 'arfa_highlights');
add_filter('the_excerpt', 'arfa_highlights');
add_filter('the_title', 'arfa_highlights');

// Child Todays Date
function arfa_date(){
	echo date('m/d/y');
}