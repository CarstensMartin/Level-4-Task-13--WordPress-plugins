# Level 4 Task 13 -WordPress plugins

## Task 1

Make sure you did everything the guide described. Submit the following:

● A screenshot of a post with its non-zero view count.

● A screenshot of your top posts page, with post links ordered by view count.

## Task 2

Add the following features to your site by extending the coolness plugin:

● Alter the view count text to have a dynamic plural. It should read “This post has x views.”, but if there is 1 view, the text should end in a singular noun.

● Explicitly set new posts’ view counts to 0.

○ Hint: the WP action tag save_post executes whenever a post or page is altered by an author. Ensure that your function only runs on posts (not pages), and does not change the view count of pre-existing posts (that already have view counts).

● Have the top posts listing display the relevant view count next to each post link.

Submit your modified version of coolness.php.