<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( !class_exists('ATU_Admin_Users') ) {
    class ATU_Admin_Users {
        public function __construct() {
            $this->init_hooks();
        }

        private function init_hooks() {
            add_action( 'init', array( $this, 'my_register_user_taxonomy' ) );
            /* Create custom columns for the manage profession page. */
            add_filter( 'manage_edit-profession_columns', array( $this, 'my_manage_profession_user_column' ) );
            /* Customize the output of the custom column on the manage professions page. */
            add_action( 'manage_profession_custom_column', array( $this, 'my_manage_profession_column' ), 10, 3 );

            /* Add section to the edit user page in the admin to select profession. */
            add_action( 'show_user_profile', array( $this, 'my_edit_user_profession_section' ), 20 );
            add_action( 'edit_user_profile', array( $this, 'my_edit_user_profession_section' ), 20 );
            /* Update the profession terms when the edit user page is updated. */
            add_action( 'personal_options_update', array( $this, 'my_save_user_profession_terms' ) );
            add_action( 'edit_user_profile_update', array( $this, 'my_save_user_profession_terms' ) );

            add_action( 'personal_options', array ( $this, 'start' ) );
        }

        /**
         * Called on 'personal_options'.
         *
         * @return void
         */
        public function start()
        {
            $action = ( IS_PROFILE_PAGE ? 'show' : 'edit' ) . '_user_profile';
            add_action( $action, array ( $this, 'stop' ) );
            ob_start();
        }

        /**
         * Strips the bio box from the buffered content.
         *
         * @return void
         */
        public static function stop()
        {
            $html = ob_get_contents();
            ob_end_clean();

            // remove the headline
            $headline = __( IS_PROFILE_PAGE ? 'About Yourself' : 'About the user' );
            $html = str_replace( '<h3>' . $headline . '</h3>', '', $html );

            // remove the table row
            $html = preg_replace( '~<tr class="user-description-wrap">\s*<th><label for="description".*</tr>~imsUu', '', $html );
            print $html;
        }

        /**
         * Saves the term selected on the edit user/profile page in the admin. This function is triggered when the page
         * is updated.  We just grab the posted data and use wp_set_object_terms() to save it.
         *
         * @param int $user_id The ID of the user to save the terms for.
         */
        public function my_save_user_profession_terms( $user_id ) {

            $tax = get_taxonomy( 'profession' );

            /* Make sure the current user can edit the user and assign terms before proceeding. */
//            if ( !current_user_can( 'edit_user', $user_id ) && current_user_can( $tax->cap->assign_terms ) )
//                return false;

            $term = esc_attr( $_POST['profession'] );

            /* Sets the terms (we're just using a single term) for the user. */
            wp_set_object_terms( $user_id, array( $term ), 'profession', false);
            update_user_meta( $user_id, 'profession', $term );

            clean_object_term_cache( $user_id, 'profession' );
        }


        /**
         * Adds an additional settings section on the edit user/profile page in the admin.  This section allows users to
         * select a profession from a checkbox of terms from the profession taxonomy.  This is just one example of
         * many ways this can be handled.
         *
         * @param object $user The user object currently being edited.
         */
        public function my_edit_user_profession_section( $user ) {

//            $tax = get_taxonomy( 'profession' );

            /* Make sure the user can assign terms of the profession taxonomy before proceeding. */
//            if ( !current_user_can( $tax->cap->assign_terms ) )
//                return;

            /* Get the terms of the 'profession' taxonomy. */
            $terms = get_terms( 'profession', array( 'hide_empty' => false ) ); ?>

            <h3><?php _e( 'Profession' ); ?></h3>

            <table class="form-table">

                <tr>
                    <th><label for="profession"><?php _e( 'Select Profession' ); ?></label></th>

                    <td><?php

                        /* If there are any profession terms, loop through them and display checkboxes. */
                        if ( !empty( $terms ) ) {
                            ?>
                            <select  name="profession">
                            <?php
                            foreach ( $terms as $term ) { ?>
                                <option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( true, is_object_in_term( $user->ID, 'profession', $term ) ); ?>><?php echo $term->name; ?></option>
                            <?php } ?>
                            </select>
                                <?php
                        }

                        /* If there are no profession terms, display a message. */
                        else {
                            _e( 'There are no professions available.' );
                        }

                        ?></td>
                </tr>

            </table>
        <?php }


        /**
         * Displays content for custom columns on the manage professions page in the admin.
         *
         * @param string $display WP just passes an empty string here.
         * @param string $column The name of the custom column.
         * @param int $term_id The ID of the term being displayed in the table.
         */
        public function my_manage_profession_column( $display, $column, $term_id ) {

            if ( 'users' === $column ) {
                $term = get_term( $term_id, 'profession' );
                echo $term->count;
            }
        }



        /**
         * Function for updating the 'profession' taxonomy count.  What this does is update the count of a specific term
         * by the number of users that have been given the term.  We're not doing any checks for users specifically here.
         * We're just updating the count with no specifics for simplicity.
         *
         * See the _update_post_term_count() function in WordPress for more info.
         *
         * @param array $terms List of Term taxonomy IDs
         * @param object $taxonomy Current taxonomy object of terms
         */
        public function my_update_profession_count( $terms, $taxonomy ) {
            global $wpdb;

            foreach ( (array) $terms as $term ) {

                $count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );

                do_action( 'edit_term_taxonomy', $term, $taxonomy );
                $wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
                do_action( 'edited_term_taxonomy', $term, $taxonomy );
            }
        }


        /**
         * Unsets the 'posts' column and adds a 'users' column on the manage profession admin page.
         *
         * @param array $columns An array of columns to be shown in the manage terms table.
         */
        public function my_manage_profession_user_column( $columns ) {

            unset( $columns['posts'] );

            $columns['users'] = __( 'Users' );

            return $columns;
        }

        /**
         * Registers the 'profession' taxonomy for users.  This is a taxonomy for the 'user' object type rather than a
         * post being the object type.
         */
        public function my_register_user_taxonomy() {

            register_taxonomy(
                'profession',
                'user',
                array(
                    'public' => true,
                    'labels' => array(
                        'name' => __( 'Professions' ),
                        'singular_name' => __( 'Profession' ),
                        'menu_name' => __( 'Professions' ),
                        'search_items' => __( 'Search Professions' ),
                        'popular_items' => __( 'Popular Professions' ),
                        'all_items' => __( 'All Professions' ),
                        'edit_item' => __( 'Edit Profession' ),
                        'update_item' => __( 'Update Profession' ),
                        'add_new_item' => __( 'Add New Profession' ),
                        'new_item_name' => __( 'New Profession Name' ),
                        'separate_items_with_commas' => __( 'Separate professions with commas' ),
                        'add_or_remove_items' => __( 'Add or remove professions' ),
                        'choose_from_most_used' => __( 'Choose from the most popular professions' ),
                    ),
                    'hierarchical'          => false,
                    'show_ui'               => true,
                    'show_admin_column'     => true,
                    'query_var'             => true,

                    'rewrite' => array(
                        'with_front' => true,
                        'slug' => 'eventvendors' // Use 'author' (default WP user slug).
                    ),
                    'update_count_callback' => array( $this, 'my_update_profession_count' ) // Use a custom function to update the count.
                )
            );
        }
    }


}

return new ATU_Admin_Users();