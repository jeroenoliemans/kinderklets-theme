<?php

function get_latest_question(){
    global $post;
    //args
    $args = array(
        'post_type' => 'question'
    );

    $latest_questions_query = new WP_Query($args);

    while ($latest_questions_query->have_posts()){
        $latest_questions_query->the_post();
        $itemTitle = the_title( '', '', false );
        $id = $post->ID;
        $permalink = get_permalink( $id );

        echo "<h5><a href='$permalink'>$itemTitle</a></h5>";
    }
}

add_shortcode('getlatestquestion','get_latest_question');