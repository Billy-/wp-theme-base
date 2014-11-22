<?php
/* Template Name: Contact page */
$name_invalid 		= '<p class="error notification">Please enter a valid name.</p>';
$email_invalid		= '<p class="error notification">Please enter a valid email address.</p>';
$message_invalid	= '<p class="error notification">Please enter a message.</p>';
$message_unsent		= '<p class="error notification">Sorry, your message was not sent. Please try Again.</p>';
$message_sent		= '<p class="success notification">Thanks! Your message has been sent.</p>';
$submitted	= $_POST['form_submitted'];
$name		= $_POST['message_name'];
$email		= filter_var( $_POST['message_email'], FILTER_VALIDATE_EMAIL );
$message	= $_POST['message_text'];
$responses	= Array();
if ( !!$submitted ){
    if ( empty( $name ) ) $responses[] = $fname_invalid;
    if ( $email === false ) $responses[] = $email_invalid;
    if ( empty( $message ) ) $responses[] = $message_invalid;

    if ( empty( $responses ) ) {
        $body = 'Message from: ' . $fname . $lname . '\r\n';
        $body .= strip_tags($message);
        $to 		= get_option('admin_email');
        $subject 	= "Someone sent a message from ".get_bloginfo('name');
        $headers 	= 'From: '. $email_filtered . "\r\n" . 'Reply-To: ' . $email_filtered . "\r\n";
        $sent = wp_mail($to, $subject, $body, $headers);
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
        <input placeholder="Name" type="text" class="text-box" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>"></label>
        <input placeholder="Email" type="text" class="text-box" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>"></label>
        <textarea placeholder="Message"type="text" class="text-box" name="message_text" rows="6"><?php echo esc_textarea($_POST['message_text']); ?></textarea></label>
        <input type="hidden" name="form_submitted" value="1">
        <input type="submit" class="button">
    </form>
</article>

<?php get_footer(); ?>