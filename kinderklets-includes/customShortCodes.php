<?php

function get_latest_question(){
    global $post;
    //args
    $args = array(
        'post_type' => 'question'
    );

    $latest_questions_query = new WP_Query($args);

    echo '<ul class="kk-question-list">';

    while ($latest_questions_query->have_posts()){
        $latest_questions_query->the_post();
        $itemTitle = the_title( '', '', false );
        $id = $post->ID;
        $permalink = get_permalink( $id );

        echo "<li class='kk-question-list-item'><i class='icon-arrow-right'></i><a href='$permalink'>$itemTitle</a></li>";
    }

    echo '</ul>';
}

add_shortcode('getlatestquestion','get_latest_question');