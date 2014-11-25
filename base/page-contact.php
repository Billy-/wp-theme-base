<?php
/* Template Name: Contact page */
$name_invalid 		= '<p class="error notification">Please enter a valid name.</p>';
$email_invalid		= '<p class="error notification">Please enter a valid email address.</p>';
$message_invalid	= '<p class="error notification">Please enter a message.</p>';
$message_unsent		= '<p class="error notification">Sorry, your message was not sent. Please try Again.</p>';
$message_sent		= '<p class="success notification">Thanks! Your message has been sent.</p>';
$submitted	= filter_input( INPUT_POST, 'form_submitted', FILTER_VALIDATE_BOOLEAN );
$name		= filter_input( INPUT_POST, 'message_name', FILTER_SANITIZE_STRING );
$from_email	= filter_input( INPUT_POST, 'message_email', FILTER_VALIDATE_EMAIL );
$message	= filter_input( INPUT_POST, 'message_text', FILTER_SANITIZE_STRING );
$responses	= Array();
if ( !!$submitted ){
    if ( empty( $name ) ) $responses[] = $name_invalid;
    if ( empty( $from_email ) ) $responses[] = $email_invalid;
    if ( empty( $message ) ) $responses[] = $message_invalid;

    if ( empty( $responses ) ) {
        $headers 	= 'From: '. $from_email . "\r\n" . 'Reply-To: ' . $from_email . "\r\n";
        $subject 	= "Someone sent a message from " . get_bloginfo('name');
        $body           = 'Message from: ' . $name . '\r\n' . $message;
        $to_email	= get_option('admin_email');
        $sent = wp_mail($to_email, $subject, $body, $headers);
        if ($sent){
                $responses[] = $message_sent;
        } else {
                $responses[] = $message_unsent;
        }
    }
}
?>
<?php
get_header();
get_template_part('partials/banner-top');
?>

<article class="main-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
    <form class="contact-form" action="<?php the_permalink(); ?>" method="post">
        <?php forEach( $responses as $response ){
            echo $response;
        } ?>
        <input placeholder="Name" type="text" class="text-box" name="message_name" value="<?php echo $name; ?>"></label>
        <input placeholder="Email" type="text" class="text-box" name="message_email" value="<?php echo $from_email; ?>"></label>
        <textarea placeholder="Message"type="text" class="text-box" name="message_text" rows="6"><?php echo $message; ?></textarea></label>
        <input type="hidden" name="form_submitted" value="1">
        <input type="submit" class="button">
    </form>
</article>

<?php get_footer();