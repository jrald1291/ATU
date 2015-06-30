<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( !class_exists('ATU_Registration') ) {
    class ATU_Registration {
        var $errors = null;

        function __construct() {
            $this->init_hooks();
        }

        private function init_hooks() {
            add_shortcode( 'atu_registration', array( $this, 'render' ) );
            add_action( 'init', array( $this, 'validate' ) );
            // Membership actions
            add_action( 'atu_membership_form', array( $this, 'membership_form' ) );
            add_action( 'wp_ajax_nopriv_post-membership', array( $this, 'post_membership' ) );
            add_action( 'wp_ajax_priv_post-membership', array( $this, 'post_membership' ) );
        }

        public function post_membership() {

            if ( ! isset( $_POST['atu_membership_nonce_field'] )
                || ! wp_verify_nonce( $_POST['atu_membership_nonce_field'], 'atu_membership' ) ) {
                exit( json_encode( array( 'status' => 'error', 'message' =>  __( 'Nonce is invalid', ATU_TEXT_DOMAIN ) ) ) );
            }

            $input = $_POST;
            $rules = array( 'email' => 'required|email' );

            $validator = new ATU_Validator();
            $validator = $validator->make($input, $rules);


            if ( $validator->fails() ) {
                $err_msg = array();
                foreach ( $validator->errors() as $key => $messages ) {

                    if ( is_array( $messages ) ) {
                        foreach ( $messages as $message ) {
                            $err_msg[] = ucfirst( $key ) . ' ' . $message;
                        }
                    }
                }

                exit( json_encode( array( 'status' => 'error', 'message' => $err_msg ) ) );
            }


            ob_start();
            $data['email'] = $_POST['email'];
            include_once ( 'emails/admin-membership-email.php' );
            $contents = ob_get_clean();



            $to = get_option( 'atu_email_recipient', get_option( 'admin_email' ) );
            $subject = 'New Membership';
            $body = $contents;

            add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

            if ( wp_mail( $to, $subject, $body ) ) {
                exit( json_encode( array( 'status' => 'success', 'message' => __( 'Thank you, we will get back to you shortly.', ATU_TEXT_DOMAIN ) ) ) );
            } else {
                exit( json_encode( array( 'status' => 'error', 'message' => __( 'Error: can\`t send email right now.', ATU_TEXT_DOMAIN ) ) ) );
            }

            remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
        }

        public function membership_form() {
            ?>
            <form class="form form-labeled atu-membership-form">
                <div class="form-group field-wrap">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <button class="btn btn-primary btn-block" type="submit"><span class="fa fa-user icon-l"></span>Become a member</button>
                <?php wp_nonce_field( 'atu_membership', 'atu_membership_nonce_field' ); ?>
            </form>

            <?php
        }

        public static function generate_registration_code() {
            global $wpdb;

            $characters = "abcdefghijklmnopqrstuvwxyz";
            $rand_string = '';
            $i = 0;
            do {
                $i++;
                $index = rand(0, strlen($characters));

                $rand_string .= $characters[$index];
            } while ( $i <= 10 );
            $code = $rand_string . time();
           // $reg_code_tbl_name = $wpdb->prefix . ATU_TBL_PREFIX . 'registration_code';
            return $code;
        }

        public function validate() {
            if ( ! isset( $_POST['atu_registration_nonce_field'] )
                || ! wp_verify_nonce( $_POST['atu_registration_nonce_field'], 'atu_registration' )
                || is_admin() ) {
                return false;
            }

            global $wpdb;

            $input = $_POST;
            $rules = array(
                'username' => 'required|unique:'. $wpdb->prefix .'users,user_login|min:4',//,ID,1
                'password' => 'required|min:5',
                'email' => 'required|email',
                'phone' => 'required',
                'website' => 'url',
                'first_name' => 'required',
                'last_name' => 'required'
            );

            $validator = new ATU_Validator();
            $validator = $validator->make($input, $rules);



            if ( $validator->fails() ) {
                $this->errors = $validator->errors();
            } else {



                $this->add_new_user( $input );
            }

        }

        private function add_new_user($post) {

            $new_user_id = wp_insert_user(array(
                    'user_login'		=> $post['username'],
                    'user_pass'	 		=> $post['password'],
                    'user_email'		=> $post['email'],
                    'first_name'		=> $post['first_name'],
                    'last_name'			=> $post['last_name'],
                    'user_url'          => $post['website'],
                    'description'       => $post['description'],
                    'user_registered'	=> date('Y-m-d H:i:s'),
                    'role'				=> get_option('atu_default_user_role', get_option('default_role'))
                )
            );


            if ( !is_wp_error($new_user_id) ) {
                // add_user_meta( $new_user_id, $meta_key, $meta_value, true );
            }
        }

        public function render() {
            global $wpdb;
            //Check if user is already loggedin
            if ( is_user_logged_in() ) return;

            // check to make sure user registration is enabled
            $registration_enabled = get_option('users_can_register');
            if ( !$registration_enabled ) {

                return __('User registration is not enabled', ATU_TEXT_DOMAIN);
            }

            //Check if registration code confirmation is enabled
            $registration_code_enabled = get_option('atu_confirm_registration_code');

            if ( $registration_code_enabled ) {
                if ( ! isset( $_REQUEST['reg_code'] ) ) return __('Registration code is required', ATU_TEXT_DOMAIN);
                $code = $_REQUEST['reg_code'];
                //  check registration code is exists and active
                if ( !$wpdb->get_var("SELECT count(*) FROM {$wpdb->prefix}{ATU_TBL_PREFIX}registration_code WHERE code = '$code' AND is_active = 1") ) {
                    return __('Registration code does not exists', ATU_TEXT_DOMAIN);
                }

            }

            ob_start();
            $post = $_POST;

            if ( ! is_null( $this->errors ) ) {
                $errors = $this->errors;
            }


            ?>

            <form action="#" method="post">
                <div class="form-group">
                    <label for="username">Username <strong>*</strong></label>
                    <input type="text" name="username" min="4" value="<?php _isset($post['username']); ?>"/>
                    <?php atu_render_errors($errors, 'username'); ?>
                </div>
                <div class="form-group">
                    <label for="password">Password <strong>*</strong></label>
                    <input type="text" name="password" min="6" value="<?php _isset($post['password']); ?>"/>
                    <?php atu_render_errors($errors, 'password'); ?>
                </div>
                <div class="form-group">
                    <label for="email">Email <strong>*</strong></label>
                    <input type="email" name="email" value="<?php _isset($post['email']); ?>"/>
                    <?php atu_render_errors($errors, 'email'); ?>
                </div>
                <div class="form-group">
                    <label for="phone">Phone <strong>*</strong></label>
                    <input type="text" name="phone" value="<?php _isset($post['phone']); ?>"/>
                    <?php atu_render_errors($errors, 'phone'); ?>
                </div>
                <div class="form-group">
                    <label for="website">Website <strong>*</strong></label>
                    <input type="text" name="website" value="<?php _isset($post['website']); ?>"/>
                    <?php atu_render_errors($errors, 'website'); ?>
                </div>

                <div class="form-group">
                    <label for="first_name">First Name <strong>*</strong></label>
                    <input type="text" name="first_name" value="<?php _isset($post['first_name']); ?>"/>
                    <?php atu_render_errors($errors, 'first_name'); ?>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name <strong>*</strong></label>
                    <input type="text" name="last_name" value="<?php _isset($post['last_name']); ?>"/>
                    <?php atu_render_errors($errors, 'last_name'); ?>
                </div>

                <button type="submit">Register</button>
                <?php wp_nonce_field( 'atu_registration', 'atu_registration_nonce_field' ); ?>
            </form>
            <?php

            return ob_get_clean();
        }
    }


    $registration = new ATU_Registration();
}


