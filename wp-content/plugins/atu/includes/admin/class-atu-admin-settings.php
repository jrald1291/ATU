<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( !class_exists('ATU_Admin_Settings') ) {
    class ATU_Admin_Settings {
        private static $error       = array();
        private static $message     = array();
        private static $settings    = array();

        public static function get_settings_pages() {
            if ( empty( self::$settings ) ) {
                include_once ( "settings/class-atu-settings-page.php" );

                self::$settings[] = include_once ( "settings/class-atu-settings-general.php" );
                self::$settings[] = include_once ( "settings/class-atu-settings-account.php" );
            }
        }

        public static function validate_code( $code ) {
            global $wpdb;

            return $wpdb->get_var( "SELECT count(*) FROM ". $wpdb->prefix . ATU_TBL_PREFIX . "registration_code WHERE code = '$code' AND is_active = 1" );
        }


        public static function output() {
            global $current_tab;

            self::get_settings_pages();

            $current_tab     = empty( $_GET['tab'] ) ? 'general' : sanitize_title( $_GET['tab'] );

            if ( ! empty( $_POST ) ) {
                self::save();
            }

            // Get tabs for the settings page
            $tabs = apply_filters( 'atu_settings_tab_array', array() );

            self::show_messages();
            include 'views/html-admin-settings.php';
        }


        public static function add_message( $text ) {
            self::$message[] = $text;
        }

        public static function add_error( $text ) {
            self::$error[] = $text;
        }

        public static function show_messages() {
            if ( sizeof( self::$message ) > 0 ) {
                foreach ( self::$message as $message ) {
                    echo '<div id="message" class="updated fade"><p><strong>' . esc_html( $message ) . '</strong></p></div>';
                }
            } elseif ( sizeof( self::$error ) > 0 ) {
                foreach ( self::$error as $error ) {
                    echo '<div id="message" class="error fade"><p><strong>' . esc_html( $error ) . '</strong></p></div>';
                }
            }
        }

        public static function save_fields( $options ) {
            if ( empty( $_POST ) ) {
                return;
            }
            $update_options = array();

            foreach ($options as $value) {

                $option_value = isset( $_POST[ $value['id'] ] ) ? wp_unslash( $_POST[ $value['id'] ] ) : null;
                switch( sanitize_title( $value['type'] ) ) {
                    case 'text':
                    case 'password':
                    case 'number':
                        $option_value = $option_value;
                        break;
                    case 'checkbox':
                        $option_value = is_null( $option_value ) ? 'no' : 'yes';
                        break;
                    case 'checkbox2':
                        $option_value = is_null( $option_value ) ? 0 : 1;
                        break;
                }


                if ( ! is_null( $option_value ) ) {
                    $update_options[ $value['id'] ] = $option_value;
                }
            }

            foreach( $update_options as $name => $val ) {
                update_option( $name, $val );
            }

            return true;

        }


        public static function output_fields( $options ) {
            foreach ( $options as $value ) {
                if ( ! isset( $value['type'] ) ) continue;

                if ( ! isset( $value['title'] ) ) {
                    $value['title'] = '';
                }

                if ( ! isset( $value['css'] ) ) {
                    $value['css'] = '';
                }

                if ( ! isset( $value['default'] ) ) {
                    $value['default'] = '';
                }

                if ( ! isset( $value['options'] ) ) {
                    $value['options'] = array();
                }

                if ( ! isset( $value['desc'] ) ) {
                    $value['desc'] = '';
                }

                if ( ! isset(  $value['attributes'] ) ) {
                    $value['attributes'] = array();
                    $attributes = '';
                }


                foreach ( $value['attributes'] as $name => $attribute ) {
                    if ( is_array( $attribute ) ) $attribute = implode(' ', $attribute);

                    $attributes .= $name . '="'. $attribute .'"';
                }


                $option_value = get_option( $value['id'], $value['default'] );

                switch( sanitize_title( $value['type'] ) ) {
                    case 'title':
                        if ( ! empty( $value['title'] ) ) {
                            echo '<h1>'. esc_html($value['title']) .'</h1>';
                        }

                        if ( ! empty( $value['desc'] ) ) {
                            echo wpautop( wptexturize( wp_kses_post( $value['desc'] ) ) );
                        }

                        echo '<table class="form-table">';
                        break;
                    case 'sectionend':
                        echo '</table>';
                        break;
                    case 'number':
                    case 'email':
                    case 'text':
                    case 'password':
                        ?>
                        <tr>
                            <th><label for="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></label></th>
                            <td>
                                <input type="<?php echo $value['type']; ?>"
                                       name="<?php echo $value['id']; ?>"
                                       id="<?php echo $value['id']; ?>"
                                       value="<?php echo $option_value; ?>"
                                    <?php echo $attributes; ?>
                                    />
                                <p class="description"><?php echo $value['desc']; ?></p>
                            </td>
                        </tr>
                        <?php
                        break;
                    case 'checkbox':
                        ?>
                        <tr>
                            <th><label for="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></label></th>
                            <td>
                                <input type="checkbox"
                                       name="<?php echo $value['id']; ?>"
                                       id="<?php echo $value['id']; ?>"
                                       value="1"
                                       <?php echo checked( $option_value, 'yes' ); ?>
                                    <?php echo $attributes; ?>
                                    />
                            </td>
                        </tr>
                        <?php
                        break;
                    case 'checkbox2':
                        ?>
                        <tr>
                            <th><label for="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></label></th>
                            <td>
                                <input type="checkbox"
                                       name="<?php echo $value['id']; ?>"
                                       id="<?php echo $value['id']; ?>"
                                       value="1"
                                    <?php echo checked( $option_value, 1 ); ?>
                                    <?php echo $attributes; ?>
                                    />
                            </td>
                        </tr>
                        <?php
                        break;
                    case 'select':
                        ?>
                        <tr>
                            <th><label for="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></label></th>
                            <td>
                                <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" <?php echo $attributes; ?>>
                                    <?php foreach( $value['options'] as $k => $option ): ?>

                                        <option value="<?php echo esc_html( $k ) ?>" <?php selected( $option_value, $k ); ?>>
                                            <?php echo esc_html( $option ) ?>
                                        </option>

                                    <?php endforeach; ?>
                                </select>
                                <p class="description"><?php echo $value['desc']; ?></p>
                            </td>
                        </tr>

                        <?php
                        break;


                    case 'user_role':
                        ?>
                        <tr>
                            <th><label for="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></label></th>
                            <td>
                                <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" <?php echo $attributes; ?>>
                                    <?php wp_dropdown_roles( $option_value ); ?>
                                </select>
                                <p class="description"><?php echo $value['desc']; ?></p>
                            </td>
                        </tr>

                        <?php
                        break;

                    case 'atu_reg_link_w_code':
                        ?>
                        <tr>
                            <th><label for="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></label></th>
                            <td>
                                <span class="reg-code hidden"></span>
                                <button id="generate-reg-link" class="button-secondary button" type="button" <?php echo $attributes; ?>>Generate</button>
                                <p class="description"><?php echo $value['desc']; ?></p>
                            </td>
                        </tr>

                        <?php
                        break;

                }
            }
        }


        public static function save() {

            global $current_tab;


            do_action( 'atu_settings_save_' . $current_tab );

            self::add_message( __( 'Your settings have been saved.', ATU_TEXT_DOMAIN ) );
        }


    }
}

