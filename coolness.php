<?php
/*
Plugin Name: Coolness
Plugin URI: https://carstensmartin.wordpress.com/
Description: A plugin that keeps track of post views
Version: 1.0
Author: Martin Carstens
Author URI: https://carstensmartin.wordpress.com/
License: UNLICENSED
*/

// When a user views the page, update views
function coolness_new_view(){
    // only interested in single posts here
    if (!is_single()) return null;
    global $post; // post in question
    $views = get_post_meta($post->ID, 'coolness_views', true);
    if (!$views) // if $views is undefined
        $views = 0;
    
    $views++;

    update_post_meta($post->ID, 'coolness_views', $views);
    return $views;
}

// This event triggers whenever a frontend page is loaded. 
// Function runs when the page loaded is of a single post.
add_action('wp_head', 'coolness_new_view');


// When author saves a new blog and there is no views, make views 0, else do nothing. 
function coolness_new_view_save($post_id, $post ){

    // If post is Not a page( test by post_id) Then action
    if ( !is_page($post_id)){
        //global $post; // post in question
        $views = get_post_meta($post->ID, 'coolness_views', true);
        
        // if $views is undefined
        if (!$views){
            // Update views to 0 if not defined
            $views = 0;
            update_post_meta($post_id, 'coolness_views', $views);
        }
        return $views;
    }
}

// When a new post is saved by author, the coolness_new_view_save function should run which will give the post 0 views
add_action('save_post', 'coolness_new_view_save',10,2); 


// Display the views on blogs
function coolness_views(){
    global $post;
    $views = get_post_meta($post->ID, 'coolness_views', true);
    if (!$views)
    $views = 0;

    if($views == 1){
        return "This post has ".$views." view";
    } else{
        return "This post has ".$views." views";
    }
}

// Summary of the top 10 blog views
function coolness_list(){
    $searchParams = [
        'posts_per_page'=>10,
        'post_type'=>'post',
        'post_status'=>'publish',
        'meta_key'=>'coolness_views',
        'orderby'=>'meta_value_num',
        'order'=>'DESC'
    ];

    $list = new WP_Query($searchParams);
    if ($list->have_posts()){
        global $post;
        echo '<ol>';

        while($list->have_posts()){
            $list->the_post();
            // Use the coolness_views function to display amount of views
            echo '<li>'.coolness_views().'<a href="'.get_permalink($post->ID).'">';
            the_title();
            echo '</a> </li>';
        }

        echo '</ol>';
    }
}