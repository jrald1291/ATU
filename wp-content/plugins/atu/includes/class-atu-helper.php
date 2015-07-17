<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'ATU_Helper' ) ) {
    class ATU_Helper {
        public static function str_limit( $string, $limit, $echo = true ) {
            $string = strip_tags( $string );
        }
        public static function get_prev_user( $user_id ) {
            global $wpdb;

            $sql = "SELECT ID, user_login FROM {$wpdb->users} a JOIN {$wpdb->usermeta} b on a.ID = b.user_id WHERE a.ID < {$user_id} AND b.meta_key = 'wp_capabilities' AND b.meta_value like '%vendor%' ORDER BY a.ID DESC LIMIT 1";
            $username = $wpdb->get_row($sql);

            return $username;
        }

        public static function get_next_user( $user_id ) {
            global $wpdb;

            $sql = "SELECT ID, user_login FROM {$wpdb->users} a JOIN {$wpdb->usermeta} b on a.ID = b.user_id WHERE a.ID > {$user_id} AND b.meta_key = 'wp_capabilities' AND b.meta_value like '%vendor%' ORDER BY a.ID ASC LIMIT 1";
            $username = $wpdb->get_row($sql);

            return $username;
        }


        public static function get_city_by_region( $region_index = 0, $selected = '' ) {
            $selected = isset( $_REQUEST['city'] ) ? $_REQUEST['city'] : $selected;
            $total_cities = intval( get_option( 'options_regions_'. $region_index .'_cities' ) );

            if ( $total_cities > 0 ) {

                for ( $i = 0; $i < $total_cities; $i++ ) {
                    $label = get_option( 'options_regions_'. $region_index .'_cities_'. $i .'_city_name' );

                    echo '<option value="'. $label .'" '. selected( $label, $selected, false ) .'>'. $label .'</option>';
                }

            }

        }

        public static function pagination( $total_pages, $page ) {

            $current_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; //add_query_arg( $wp->query_string, '', home_url( $wp->request ) );


            $next = $page < $total_pages ? $page + 1 : $page;

            echo '<div class="pagination">';
            echo '<label for="">Pagination :</label>';
            echo '<div class="wp-pagenavi">';
            echo '<span class="pages">Page '. $page .' of '. $total_pages .'</span>';

            if ($page>1) {
               echo '<a class="nextpostslink" rel="prev" href="'. get_home_url() . '/vendors/page/' . ($page-1) .'/">«</a>';
            }

            for( $i = 1; $i <= $total_pages; $i++ ) {
                if ($total_pages!=1) {
                    if ( $i == $page) {
                    echo '<span class="current">'. $page .'</span>';

                    } else {


                    echo '<a class="page larger" href="'. esc_url( add_query_arg( array( 'page' => $i ), $current_url ) )  .'/">'. $i .'</a>';

                }
                
            }
        }

            if ($total_pages!=1 and $page!=$total_pages) {
                echo '<a class="nextpostslink" rel="next" href="'. esc_url( add_query_arg( array( 'page' => $next ), $current_url ) )  .'/">»</a>';
            }
            echo '</div>';
            echo '</div>';

           



        }

        public static function background_image( $attachment_id, $default_image = null, $echo = true ) {

            $default_image = $default_image == null ? ATU_ASSSETS_DIR . 'images/banner.jpg' : $default_image;

            $page_background = wp_get_attachment_image_src( $attachment_id, 'full' );

            $page_background = isset( $page_background[0] ) ?  $page_background[0] : '';


            $option_bg = of_get_option('banner', '');


            if ( empty( $page_background ) && empty( $option_bg ) ) {

                $page_background = $default_image;

            } elseif ( empty( $page_background ) && ! empty( $option_bg ) ) {

                $page_background = $option_bg;
            }

            if ( ! $echo )return $page_background;

            echo $page_background;
        }


        public static function dropwdown_region(  ) {

            $selected = isset( $_REQUEST['region'] ) ? $_REQUEST['region'] : '';
            if ( have_rows( 'regions', 'option' ) ) {
                echo '<select name="region" class="form-control">';
                echo '<option value="" '. selected( '', $selected, false ) .'>-- Region --</option>';
                while ( have_rows( 'regions', 'option' ) ) {
                    the_row();
                    $name = sanitize_title(get_sub_field('region_name'));
                    $label = esc_html(get_sub_field('region_label'));

                    echo '<option value="'. $name .'" '. selected( $name, $selected, false ) .'>'. $label .'</option>';
                }
                echo '<select>';
            }



        }

        public static function dropwdown_vendor_category( $args = array() ) {

            $selected = isset( $_REQUEST['category'] ) ? $_REQUEST['category'] : '';
            if ( have_rows( 'vendors_categories', 'option' ) ) {
                echo '<select name="category" class="form-control">';
                echo '<option value="" '. selected( '', $selected, false ) .'>-- Category --</option>';
                while ( have_rows( 'vendors_categories', 'option' ) ) {
                    the_row();
                    $label = esc_html(get_sub_field('category_name'));

                    echo '<option value="'. sanitize_title( $label ) .'" '. selected( sanitize_title( $label ), $selected, false ) .'>'. $label .'</option>';
                }
                echo '</select>';
            }



        }


        public static function list_vendor_category( $args = array() ) {
            $options = wp_parse_args( $args, array(
                'taxonomy' => 'sydney',
                'echo' => true,
            ) );

            extract( $options );

            $selected = isset( $_REQUEST['category'] ) ? $_REQUEST['category'] : '';
            $return_string = '';
            if ( have_rows( 'vendors_categories', 'option' ) ) {
                $return_string .= '<ul class="list">';
                while ( have_rows( 'vendors_categories', 'option' ) ) {
                    the_row();
                    $label = esc_html(get_sub_field('category_name'));

                    $term_link = get_term_link( sanitize_title( $label ), $taxonomy );

                    if ( is_wp_error( $term_link ) ) {
                        $term_link = '#';
                    }
                    $return_string .= '<li class="'. selected( sanitize_title( $label ), sanitize_title( $selected ), false ) .'">';
                    $return_string .= '<a href="'. $term_link .'">';
                    $return_string .= $label .'</a></li>';
                }
                $return_string .= '</ul>';
            }



            if ( ! $echo )
                return $return_string;

            echo $return_string;
        }



        public static function list_venue_category( $args = array() ) {
            $options = wp_parse_args( $args, array(
                'taxonomy' => 'sydney',
                'echo' => true,
            ) );

            extract( $options );

            $selected = isset( $_REQUEST['category'] ) ? $_REQUEST['category'] : '';
            $return_string = '';
            if ( have_rows( 'venue_categories', 'option' ) ) {
                $return_string .= '<ul class="list">';
                while ( have_rows( 'venue_categories', 'option' ) ) {
                    the_row();
                    $label = esc_html(get_sub_field('category_name'));

                    $term_link = get_term_link( sanitize_title( $label ), $taxonomy );

                    if ( is_wp_error( $term_link ) ) {
                        $term_link = '#';
                    }
                    $return_string .= '<li class="'. selected( sanitize_title( $label ), sanitize_title( $selected ), false ) .'">';
                    $return_string .= '<a href="'. $term_link .'">';
                    $return_string .= $label .'</a></li>';
                }
                $return_string .= '</ul>';
            }



            if ( ! $echo )
                return $return_string;

            echo $return_string;
        }


    }
}