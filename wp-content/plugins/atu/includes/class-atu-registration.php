<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

session_start();
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
                'password_confirmation' => 'same:password',
                'email' => 'required|email',
                'phone' => 'required',
                'website' => 'url',
                'first_name' => 'required',
                'last_name' => 'required',
                'reg_code' => 'exists:'. $wpdb->prefix . ATU_TBL_PREFIX . 'registration_code,code'
            );

            $validator = new ATU_Validator();
            $validator = $validator->make($input, $rules);



            if ( $validator->success() ) {

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


            if ( ! is_wp_error( $new_user_id ) ) {
                $page_id = get_option( 'atu_registration_success_page' );

                exit( wp_redirect( get_page_link( $page_id ) ) );

                // add_user_meta( $new_user_id, $meta_key, $meta_value, true );
            } else {

                ATU_Notify::add( $new_user_id->errors, 'error' );
            }
        }

        private static function add_current_code( $code ) {


            $_SESSION['atu_registration']['code'] = $code;
        }

        private static function get_current_code() {
            return  isset( $_SESSION['atu_registration']['code'] ) ? $_SESSION['atu_registration']['code'] : '';
        }


        private function get_post_value( $key, $default = '' ) {
            if ( ! $_POST ) return $default;
            return ! isset( $_POST[$key] ) ? $default : $_POST[$key];
        }

        private function get_fields() {

            $professions = array();
            $terms = get_terms( 'profession', array( 'hide_empty' => false ) );

            foreach ( $terms as $term ) {
                $professions[$term->slug] = $term->name;
            }




            $fields = array(
                array(
                    'type'      => 'form',
                    'action'    => '#',
                    'id'        => 'registrationForm'
                ),

                array(
                    'title'     => __( 'Username', 'atu' ),
                    'type'      => 'text',
                    'id'        => 'username',
                    'placeholder'   => '',
                    'attributes'    => array(
                        'class' => 'form-control'
                    ),
                    'required'  => true,
                    'value'     => $this->get_post_value( 'username' ),
                    'default'   => '',
                ),

                array(
                    'title'     => __( 'Password', 'atu' ),
                    'type'      => 'password',
                    'id'        => 'password',
                    'attributes'    => array(
                        'class' => 'form-control'
                    ),
                    'placeholder'   => '',
                    'required'  => true,
                    'value'     => $this->get_post_value( 'password' ),
                    'default'   => '',
                ),

                array(
                    'title'     => __( 'Confirm Password' ),
                    'type'      => 'password',
                    'id'        => 'password_confirmation',
                    'placeholder'   => '',
                    'required'  => true,
                    'value'     => $this->get_post_value( 'password_confirmation' ),
                    'default'   => '',
                ),

                array(
                    'title'     => __( 'Email', 'atu' ),
                    'type'      => 'email',
                    'id'        => 'email',
                    'attributes'    => array(
                        'class' => 'form-control'
                    ),
                    'placeholder'   => '',
                    'required'  => true,
                    'value'     => $this->get_post_value( 'email' ),
                    'default'   => '',
                ),

                array(
                    'title'     => __( 'Phone', 'atu' ),
                    'type'      => 'text',
                    'id'        => 'phone',
                    'attributes'    => array(
                        'class' => 'form-control'
                    ),
                    'placeholder'   => '',
                    'value'     => $this->get_post_value( 'phone' ),
                    'default'   => '',
                ),


                array(
                    'title'     => __( 'Mobile', 'atu' ),
                    'type'      => 'text',
                    'id'        => 'mobile',
                    'attributes'    => array(
                        'class' => 'form-control'
                    ),
                    'placeholder'   => '',
                    'value'     => $this->get_post_value( 'mobile' ),
                    'default'   => '',
                ),

                array(
                    'title'     => __( 'Website', 'atu' ),
                    'type'      => 'url',
                    'id'        => 'website',
                    'attributes'    => array(
                        'class' => 'form-control'
                    ),
                    'placeholder'   => '',
                    'value'     => $this->get_post_value( 'website' ),
                    'default'   => '',
                ),


                array(
                    'title'     => __( 'Youtube Link', 'atu' ),
                    'type'      => 'text',
                    'id'        => 'youtube_link',
                    'attributes'    => array(
                        'class' => 'form-control'
                    ),
                    'placeholder'   => '',
                    'required'  => true,
                    'value'     => $this->get_post_value( 'youtube_link' ),
                    'default'   => '',
                ),


                array(
                    'title'     => __( 'Company Name', 'atu' ),
                    'type'      => 'text',
                    'id'        => 'company_name',
                    'attributes'    => array(
                        'class' => 'form-control'
                    ),
                    'placeholder'   => '',
                    'required'  => true,
                    'value'     => $this->get_post_value( 'company_name' ),
                    'default'   => '',
                ),

                array(
                    'title'     => __( 'First Name', 'atu' ),
                    'type'      => 'text',
                    'id'        => 'first_name',
                    'attributes'    => array(
                        'class' => 'form-control'
                    ),
                    'placeholder'   => '',
                    'required'  => true,
                    'value'     => $this->get_post_value( 'first_name' ),
                    'default'   => '',
                ),

                array(
                    'title'     => __( 'Last Name', 'atu' ),
                    'type'      => 'text',
                    'id'        => 'last_name',
                    'attributes'    => array(
                        'class' => 'form-control'
                    ),
                    'placeholder'   => '',
                    'required'  => true,
                    'value'     => $this->get_post_value( 'last_name' ),
                    'default'   => '',
                ),


                array(
                    'title'     => __( 'Profession', 'atu' ),
                    'type'      => 'select',
                    'id'        => 'profession',
                    'attributes'    => array(
                        'class' => 'form-control'
                    ),
                    'required'  => true,
                    'value'     => $this->get_post_value( 'profession' ),
                    'default'   => '0',
                    'options'   => $professions
                ),


                array(
                    'title'     => __( 'Register', 'atu' ),
                    'type'      => 'button',
                    'id'        => 'register',
                    'attributes'    => array(
                        'class' => 'btn btn-success'
                    ),
                    'button_type'   => 'submit',
                    'value'     => 'register'
                ),

                array(
                    'type'  => 'nonce_field',
                    'id'    => 'atu_registration_nonce_field',
                    'action'    => 'atu_registration'
                ),


                array(
                    'type'      => 'form-end',
                    'id'        => 'registrationForm'
                ),

            );

            return $fields;
        }

        public function render() {
            global $wpdb;

            ob_start();


            //Check if user is already loggedin
            if ( is_user_logged_in() ) {
                return __('You are already logged in.', ATU_TEXT_DOMAIN);
            }

            // check to make sure user registration is enabled
            $registration_enabled = get_option('users_can_register');
            if ( !$registration_enabled ) {

                return __('User registration is not enabled', ATU_TEXT_DOMAIN);
            }

            //Check if registration code confirmation is enabled
            $validate_registration_code = get_option('atu_validate_registration_code', 'no');

            if ( $validate_registration_code == 'yes' ) {
                if ( ! isset( $_REQUEST['reg_code'] ) ) return __('Registration code is required', ATU_TEXT_DOMAIN);
                $code =  self::get_current_code() == '' ? $_REQUEST['reg_code'] : self::get_current_code();
                //  check registration code is exists and active
                if ( ! $wpdb->get_var("SELECT count(*) FROM ". $wpdb->prefix . ATU_TBL_PREFIX . "registration_code WHERE code = '$code' AND is_active = 1") ) {
                    return __( 'Registration code does not exists', ATU_TEXT_DOMAIN);
                } else {
                    self::add_current_code( $code );
                }

            }

            $post = $_POST;




            ATU_Notify::display();

            ATU_Form_Builder::create( $this->get_fields() );


            ?>

            <!--<form action="#" method="post">
                <div class="form-group">
                    <label for="username">Username <strong>*</strong></label>
                    <input type="text" name="username" min="4" class="form-control" value="<?php _isset($post['username']); ?>"/>
                </div>
                <div class="form-group">
                    <label for="password">Password <strong>*</strong></label>
                    <input type="password" name="password" min="6" class="form-control" value="<?php _isset($post['password']); ?>"/>
                </div>

                <div class="form-group">
                    <label for="password">Confirm Password<strong>*</strong></label>
                    <input type="password" name="password_confirmation" min="6" class="form-control" value="<?php _isset($post['password_confirmation']); ?>"/>
                </div>

                <div class="form-group">
                    <label for="email">Email <strong>*</strong></label>
                    <input type="email" name="email" class="form-control" value="<?php _isset($post['email']); ?>"/>
                </div>
                <div class="form-group">
                    <label for="phone">Phone <strong>*</strong></label>
                    <input type="text" name="phone" class="form-control" value="<?php _isset($post['phone']); ?>"/>
                </div>

                <div class="form-group">
                    <label for="website">Website <strong>*</strong></label>
                    <input type="text" name="website" class="form-control" value="<?php _isset($post['website']); ?>"/>
                </div>

                <div class="form-group">
                    <label for="first_name">First Name <strong>*</strong></label>
                    <input type="text" name="first_name" class="form-control" value="<?php _isset($post['first_name']); ?>"/>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name <strong>*</strong></label>
                    <input type="text" name="last_name" class="form-control" value="<?php _isset($post['last_name']); ?>"/>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
                <?php if ( $validate_registration_code == 'yes' ): ?>
                    <input type="hidden" name="reg_code" value="<?php echo self::get_current_code(); ?>" />
                <?php endif; ?>
                <?php wp_nonce_field( 'atu_registration', 'atu_registration_nonce_field' ); ?>
            </form>-->
            <?php

            return ob_get_clean();
        }
    }


    $registration = new ATU_Registration();
}


