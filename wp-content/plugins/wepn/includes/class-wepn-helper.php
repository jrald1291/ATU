<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists('WEPN_Helper') ) {
    class WEPN_Helper {
        /**
         * Checks if a particular user has a role.
         * Returns true if a match was found.
         *
         * @param string $role Role name.
         * @param int $user_id (Optional) The ID of a user. Defaults to the current user.
         * @return bool
         */
        public static function check_user_role( $role, $user_id = null ) {

            if ( is_numeric( $user_id ) )
                $user = get_userdata( $user_id );
            else
                $user = wp_get_current_user();

            if ( empty( $user ) )
                return false;

            return in_array( $role, (array) $user->roles );
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

            $default_image = $default_image == null ? WEPN_ASSSETS_DIR . 'images/banner.jpg' : $default_image;

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

        public static function dropwdown_regions() {
            $selected = isset( $_REQUEST['region'] ) ? $_REQUEST['region'] : '';
            if ( have_rows( 'groups', 'option' ) ) {
                echo '<select name="region" class="form-control">';
                echo '<option value="" '. selected( '', $selected, false ) .'>-- Region --</option>';
                while ( have_rows( 'groups', 'option' ) ) {
                    the_row();
                    $name = sanitize_title(get_sub_field('group_name'));
                    $label = esc_html(get_sub_field('group_label'));

                    echo '<option value="'. $name .'" '. selected( $name, $selected, false ) .'>'. $label .'</option>';
                }
                echo '<select>';
            }
        }

        public static function category_list() {
            $arr = array();

            if ( have_rows( 'vendors_categories', 'option' ) ) {
                while ( have_rows( 'vendors_categories', 'option' ) ) {
                    the_row();
                    $name = sanitize_title(get_sub_field('category_name'));
                    $label = esc_html(get_sub_field('category_name'));

                    $arr[$name] = $label;
                }
            }

            return $arr;


        }
        public static function region_lists() {
            $arr = array();

            if ( have_rows( 'groups', 'option' ) ) {
                while ( have_rows( 'groups', 'option' ) ) {
                    the_row();
                    $name = sanitize_title(get_sub_field('group_name'));
                    $label = esc_html(get_sub_field('group_label'));

                    $arr[$name.'::'.$label] = $label;
                }
            }

            return $arr;
        }


        public static function get_regions() {
            $arr = array();

            if ( have_rows( 'groups', 'option' ) ) {
                while ( have_rows( 'groups', 'option' ) ) {
                    the_row();
                    $name = sanitize_title(get_sub_field('group_name'));
                    $label = esc_html(get_sub_field('group_label'));

                    $arr[$name] = $label;
                }
            }

            return $arr;
        }


        public static function city_lists() {
            $arr = array();

            if ( have_rows( 'cities', 'option' ) ) {
                while ( have_rows( 'cities', 'option' ) ) {
                    the_row();
                    $name = sanitize_title(get_sub_field('city_name'));
                    $label = esc_html(get_sub_field('city_label'));

                    $arr[$name] = $label;
                }
            }

            return $arr;
        }

        public static function dropwdown_cities( $placeholder = '-- City --' ) {

            $selected = isset( $_REQUEST['city'] ) ? $_REQUEST['city'] : '';
            if ( have_rows( 'cities', 'option' ) ) {
                echo '<select name="city" class="form-control">';
                echo '<option value="" '. selected( '', $selected, false ) .'>'. $placeholder .'</option>';
                while ( have_rows( 'cities', 'option' ) ) {
                    the_row();
                    $name = sanitize_title(get_sub_field('city_name'));
                    $label = esc_html(get_sub_field('city_label'));

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


        public static function list_vendor_category( $echo = true ) {

            $taxonomy = isset($_SESSION['wepn']['url_segment']['city']) && !empty($_SESSION['wepn']['url_segment']['city']) ? $_SESSION['wepn']['url_segment']['city'] : 'sydney';

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


        public static function get_user_ids_by_role( $role = 'vendor' ) {
            $args1 = array(
                'role' => $role,
                'orderby' => 'ID',
                'order' => 'DESC'
            );
            $users = get_users($args1);

            $arr = array();

            foreach( $users as $user ) {
                $arr[] = $user->ID;
            }

            return $arr;
        }


        public static function wepn_pagination($total_page) {
            global $paged;

            if(empty($paged)) $paged = 1;

            if($total_page == '')
            {
                global $wp_query;
                // Get post type archive link
                //$post_type_archive_link = get_post_type_archive_link( 'venue' );
                // Get maximum number of page
                $total_page = $wp_query->max_num_pages;

                if(!$total_page)
                {
                    $total_page = 1;
                }
            }


            echo '<div class="pagination">';
            echo '<label for="">' . __( 'Pagination', 'atu') . ' :</label>';
            echo '<div class="wp-pagenavi">';
            echo '<span class="pages">Page '. $paged .' of '. $total_page .'</span>';

            for( $i = 1; $i <= $total_page; $i++ ):

                if ( $i == $paged ):

                    echo '<span class="current">'. $i .'</span>';

                else:

                    echo '<a class="page larger" href="'. get_pagenum_link($i)  .'">'. $i .'</a>';

                endif;

            endfor;
            if ($total_page!=1 && $paged!=$total_page) {
                echo '<a class="nextpostslink" rel="next" href="'. get_pagenum_link($paged + 1) .'">»</a>';
            }

            echo '</div>';
            echo '</div>';
        }





    }



}