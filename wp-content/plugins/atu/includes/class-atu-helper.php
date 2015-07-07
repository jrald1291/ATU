<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'ATU_Helper' ) ) {
    class ATU_Helper {
        public static function str_limit( $string, $limit, $echo = true ) {
            $string = strip_tags( $string );
        }


        public static function pagination( $current_url, $total_pages, $page ) {
            /*global $wp;
            $current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
            print_r( $current_url );

            $next = $page < $total_pages ? $page + 1 : $page;

            echo '<div class="pagination">';
            echo '<label for="">Pagination :</label>';
            echo '<div class="wp-pagenavi">';
            echo '<span class="pages">Page '. $page .' of '. $total_pages .'</span>';

            for( $i = 1; $i <= $total_pages; $i++ ) {
                if ( $i == $page ) {
                    echo '<span class="current">'. $page .'</span>';

                } else {

                    echo '<a class="page larger" href="'. $current_url . '?page=' . $i .'/">'. $i .'</a>';
                }
            }


            echo '<a class="nextpostslink" rel="next" href="'. $current_url . '?page=' . $next .'/">Next</a>';
            echo '</div>';
            echo '</div>';

            */


            global $wp_query;
            $big = 999999999; // need an unlikely integer
            paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, $page ),
                'total' => $total_pages,
                'prev_next' => false,
                'type'  => 'array',
                'prev_next'   => TRUE,
                'prev_text'    => __('«'),
                'next_text'    => __('»'),
            ) );
//            if( is_array( $pages ) ) {
//                $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
//                echo '<ul class="pagination">';
//                foreach ( $pages as $page ) {
//                    echo "<li>$page</li>";
//                }
//                echo '</ul>';
//            }
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


        public static function dropwdown_vendor_category( $args = array() ) {

            $options = wp_parse_args( $args, array(
                'echo' => true,
                'selected' => ''
            ) );

            extract( $options );



            $terms = get_terms( 'profession', array( 'hide_empty' => false ) );

            $return_string = '';
            if ( ! empty( $terms ) ) {

                $return_string .= '<select name="profession" class="form-control">';
                $return_string .= '<option value="">' . __( '-- Select --', 'atu' ) . '</option>';
                foreach ( $terms as $term ) {

                    $return_string .= '<option value="'. $term->slug .'" '. selected( $selected, $term->slug, false ) .'>' . $term->name . '</option>';
                }
                $return_string .= '</select>';
            }

            if ( ! $echo )
                return $return_string;

            echo $return_string;
        }

        public static function list_vendor_category( $args = array() ) {
            $options = wp_parse_args( $args, array(
                'echo' => true,
            ) );

            extract( $options );

            $terms = get_terms( 'profession', array( 'hide_empty' => false ) );

            $return_string = '';
            if ( ! empty( $terms ) ) {


                $return_string .= '<ul class="list">';
                foreach ( $terms as $term ) {

                    $return_string .= '<li><a href="'. get_term_link( $term->slug, 'profession' ) .'">' . $term->name . '</a></li>';

                    //$return_string .= '<option value="'. $term->slug .'">' . $term->name . '</option>';
                }

                $return_string .= '</ul>';
            }

            if ( ! $echo )
                return $return_string;

            echo $return_string;
        }
    }
}