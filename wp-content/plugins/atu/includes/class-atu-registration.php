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

            );

            $validate_registration_code = get_option('atu_validate_registration_code', 'no');

            if ( $validate_registration_code == 'yes' ) {
                $rules['registration_code'] = 'exists:' . $wpdb->prefix . ATU_TBL_PREFIX . 'registration_code,code';
            }




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


//                add_user_meta( $new_user_id, 'youtube_link', $post['youtube_link'] )
//                or update_user_meta( $new_user_id, 'youtube_link', $post['youtube_link']  );

                add_user_meta( $new_user_id, 'company_name', $post['company_name'] )
                or update_user_meta( $new_user_id, 'company_name', $post['company_name']  );

                add_user_meta( $new_user_id, 'mobile', $post['mobile'] )
                or update_user_meta( $new_user_id, 'mobile', $post['mobile']  );

                add_user_meta( $new_user_id, 'phone', $post['phone'] )
                or update_user_meta( $new_user_id, 'phone', $post['phone']  );


                $term = esc_attr( $post['profession'] );

                /* Sets the terms (we're just using a single term) for the user. */
                wp_set_object_terms( $new_user_id, array( $term ), 'profession', false);

                clean_object_term_cache( $new_user_id, 'profession' );

                // Update registration code to inactive
                ATU_Admin_Settings::set_used_reg_code( $post['registration_code'] );

                $page_id = get_option( 'atu_registration_success_page' );





                exit( wp_redirect( get_page_link( $page_id ) ) );






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

            $professions = array( '' => __( '-- Select --', 'atu' ) );
            $terms = get_terms( 'profession', array( 'hide_empty' => false ) );



            foreach ( $terms as $term ) {
                $professions[$term->slug] = $term->name;
            }




            $fields = array(
                array(
                    'type'      => 'form',
                    'action'    => '#',
                    'method'    => 'post',
                    'attributes'    => array(
                        'class' => 'form form-labeled',
                    ),
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
                    'attributes'    => array(
                        'class' => 'form-control'
                    ),
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


//                array(
//                    'title'     => __( 'Youtube Link', 'atu' ),
//                    'type'      => 'text',
//                    'id'        => 'youtube_link',
//                    'attributes'    => array(
//                        'class' => 'form-control'
//                    ),
//                    'placeholder'   => '',
//                    'required'  => true,
//                    'value'     => $this->get_post_value( 'youtube_link' ),
//                    'default'   => '',
//                ),


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
                    'title'     => __( 'Description', 'atu' ),
                    'type'      => 'textarea',
                    'id'        => 'description',
                    'attributes'    => array(
                        'class' => 'form-control',
                        'rows'  => 3,
                        'cols'  => 50
                    ),
                    'placeholder'   => '',
                    'required'  => true,
                    'value'     => $this->get_post_value( 'description' ),
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
                        'class' => 'btn btn-primary btn-block btn-lg'
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
                    'type'      => 'hidden',
                    'id'        => 'registration_code',
                    'value'     => self::get_current_code(),
                    'default'   => '',
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

                $code = ! isset( $_GET['reg_code'] ) ?  self::get_current_code() : $_GET['reg_code'];
                //  check registration code is exists and active
                if ( ATU_Admin_Settings::validate_code( esc_attr( $code ) ) == 0 ) {
                    return __( 'Registration code does not exists', 'atu' );
                } else {
                    self::add_current_code( $code );
                }

            }

            $fields = $this->get_fields();



            ATU_Notify::display();

            ATU_Form_Builder::create( $fields );

            return ob_get_clean();
        }
    }


    $registration = new ATU_Registration();
}


