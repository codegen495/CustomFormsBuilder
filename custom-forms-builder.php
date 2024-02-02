<?php
/*
Plugin Name: Custom Forms Builder
Description: Create and manage custom forms with ease.
Version: 1.1
Author: Shohan Perera
*/

// Add menu item to the admin dashboard
function custom_forms_menu() {
    add_menu_page('Custom Forms', 'Custom Forms', 'manage_options', 'custom_forms', 'custom_forms_page');
}

add_action('admin_menu', 'custom_forms_menu');

// Custom Forms Page
function custom_forms_page() {
    ?>
    <div class="wrap">
        <h1>Custom Forms Builder</h1>
        <!-- Add your form builder interface here -->
        <p>Use the [custom_form] shortcode to embed forms on your pages or posts.</p>
    </div>
    <?php
}

// Shortcode for embedding forms
function custom_form_shortcode($atts) {
    // Include logic for rendering the form based on attributes
    ob_start();
    ?>
    <div class="custom-form">
        <!-- Add your form HTML and logic here -->
        <form method="post" action="">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>

            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="4" required></textarea><br>

            <label>Interests:</label><br>
            <input type="checkbox" name="interests[]" value="programming"> Programming<br>
            <input type="checkbox" name="interests[]" value="design"> Design<br>
            <input type="checkbox" name="interests[]" value="writing"> Writing<br><br>

            <label>Preferred Contact Method:</label><br>
            <input type="radio" name="contact_method" value="email" checked> Email<br>
            <input type="radio" name="contact_method" value="phone"> Phone<br>
            <input type="radio" name="contact_method" value="none"> None<br><br>

            <input type="submit" name="submit_form" value="Submit">
        </form>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('custom_form', 'custom_form_shortcode');

// Function to handle form submissions
function handle_form_submission() {
    if (isset($_POST['submit_form'])) {
        // Include logic for handling form submissions and storing data in the WordPress database
        $form_data = $_POST; // Modify this based on your form structure
        save_form_submission($form_data);

        // Send email notification to site admins
        send_form_submission_email($form_data);
    }
}

add_action('init', 'handle_form_submission');

// Function to save form submissions to the database
function save_form_submission($form_data) {
    $submissions = get_option('form_submissions', array());
    $submissions[] = $form_data;
    update_option('form_submissions', $submissions);
}

// Function to send email notifications
function send_form_submission_email($form_data) {
    $admin_email = get_option('admin_email');

    $subject = 'New Form Submission';
    $message = 'A new form submission has been received.';

    // Include form data in the email if needed

    wp_mail($admin_email, $subject, $message);
}

// Additional customization for email notifications or other features can be added here
?>
