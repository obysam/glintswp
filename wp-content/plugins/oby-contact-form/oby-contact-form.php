<?php
/*
Plugin Name: Oby Contact Form
Description: A simple contact form plugin for practical test purposes.
Version: 1.0
Author: Syam Oby
Author URI: https://github.com/obysyam
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function oby_contact_form_shortcode() {
    $current_url = esc_url( get_permalink() );
    $success_message = isset($_GET['success_message']) ? sanitize_text_field($_GET['success_message']) : '';
    $error_message = isset($_GET['error_message']) ? sanitize_text_field($_GET['error_message']) : '';
    ob_start();
    ?>
    <h5 class="card-title">Contact Form</h5>
    
    <?php if ($success_message) : ?>
        <div class="alert alert-success">
            <?php echo esc_html($success_message); ?>
        </div>
    <?php endif; ?>

    <?php if ($error_message) : ?>
        <div class="alert alert-danger">
            <?php echo esc_html($error_message); ?>
        </div>
    <?php endif; ?>
    
    <form method="post" action="<?php echo $current_url; ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label for="email">Email*</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
        </div>
        <div class="form-group">
            <label for="subject">Subject*</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="I need a Pro design!" required>
        </div>
        <div class="form-group">
            <label for="message">Message*</label>
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="We're happy to help! Describe your inquiry and we will reach out soon."></textarea>
        </div>
        <input type="hidden" name="oby_contact_form_submitted" value="1">
        <button type="submit" class="btn btn-normal float-end">Send Message</button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode( 'oby_contact_form', 'oby_contact_form_shortcode' );


function oby_contact_form_process() {
    if ( isset( $_POST['oby_contact_form_submitted'] ) && $_POST['oby_contact_form_submitted'] == '1' ) {

        // Basic validation
        if ( empty( $_POST['subject'] ) || empty( $_POST['email'] ) || empty( $_POST['message'] ) ) {
            wp_redirect( add_query_arg( 'error_message', 'Your message is empty, please let us know', esc_url( get_permalink() ) ) );
            exit;
        }

        $to = 'oby.samuel@gmail.com';
        $subject = 'Contact Form Submission: ' . sanitize_text_field( $_POST['subject'] );
        $message = "Name: " . sanitize_text_field( $_POST['name'] ) . "\nEmail: " . sanitize_email( $_POST['email'] ) . "\nMessage: " . sanitize_textarea_field( $_POST['message'] );
        $headers = "From: " . sanitize_text_field( $_POST['name'] ) . " <" . sanitize_email( $_POST['email'] ) . ">";

        if ( wp_mail( $to, $subject, $message, $headers ) ) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'contact_form_submissions';

            $wpdb->insert(
                $table_name,
                array(
                    'name' => sanitize_text_field( $_POST['name'] ),
                    'email' => sanitize_email( $_POST['email'] ),
                    'subject' => sanitize_text_field( $_POST['subject'] ),
                    'message' => sanitize_textarea_field( $_POST['message'] )
                )
            );

            wp_redirect( add_query_arg( 'success_message', 'Your message has been sent successfully!', esc_url( get_permalink() ) ) );
            exit;
        } else {
            wp_redirect( add_query_arg( 'error_message', 'Something wrong! please report to support admin@help.com', esc_url( get_permalink() ) ) );
        }
    }
}
add_action( 'template_redirect', 'oby_contact_form_process' );


function create_contact_form_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form_submissions';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        subject varchar(255) NOT NULL,
        message text NOT NULL,
        submit_date datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'create_contact_form_table' );

function oby_contact_form_admin_menu() {
    add_menu_page(
        'Contact Form Submissions',
        'Contact Form',
        'manage_options',
        'oby-contact-form',
        'oby_contact_form_admin_page',
        'dashicons-email-alt',
        6                             
    );
}
add_action( 'admin_menu', 'oby_contact_form_admin_menu' );

function oby_contact_form_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form_submissions';
    $submissions = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY submit_date DESC" );

    echo '<div class="wrap">';
    echo '<h1>Contact Form Submissions</h1>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Date</th></tr></thead>';
    echo '<tbody>';
    
    if ( !empty( $submissions ) ) {
        foreach ( $submissions as $submission ) {
            echo '<tr>';
            echo '<td>' . esc_html( $submission->name ) . '</td>';
            echo '<td>' . esc_html( $submission->email ) . '</td>';
            echo '<td>' . esc_html( $submission->subject ) . '</td>';
            echo '<td>' . esc_html( $submission->message ) . '</td>';
            echo '<td>' . esc_html( date( 'Y-m-d H:i:s', strtotime( $submission->submit_date ) ) ) . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="5">No submissions found.</td></tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}