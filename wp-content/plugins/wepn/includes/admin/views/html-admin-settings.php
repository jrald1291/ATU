<?php
/**
 * Admin View: Settings
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

?>

<div class="wrap alltiedup">
    <form method="post" id="mainform" enctype="multipart/form-data">
        <div class="icon32 icon32-woocommerce-settings" id="icon-woocommerce"><br /></div><h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
            <?php
            foreach ( $tabs as $name => $label ) {
                echo '<a href="' . admin_url( 'admin.php?page=wepn-settings&tab=' . $name ) . '" class="nav-tab ' . ( $current_tab == $name ? 'nav-tab-active' : '' ) . '">' . $label . '</a>';
            }

            //do_action( 'wepn_settings_tabs' );
            ?>
        </h2>

        <?php
        do_action( 'wepn_sections_' . $current_tab );
        do_action( 'wepn_settings_' . $current_tab );
//        do_action( 'wepn_settings_tabs_' . $current_tab ); // @deprecated hook
        ?>

        <p class="submit">
            <?php //if ( ! isset( $GLOBALS['hide_save_button'] ) ) : ?>
                <input name="save" class="button-primary" type="submit" value="<?php _e( 'Save changes', 'woocommerce' ); ?>" />
            <?php //endif; ?>
            <input type="hidden" name="subtab" id="last_tab" />
            <?php wp_nonce_field( 'wepn-settings' ); ?>
        </p>
    </form>
</div>
