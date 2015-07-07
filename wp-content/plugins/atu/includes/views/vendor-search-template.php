<?php

get_header(); ?>


<div class="l-content-bg" style="background: url('<?php ATU_Helper::background_image( get_field('page_background', get_the_ID()) ); ?>') no-repeat">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="l-content-container">
                    <div class="page-header">
                        <?php do_action( 'atu_vendor_search_form' ); ?>
                    </div>
                    <div class="page-content">

                        <?php

                        /*
                         * Include the post format-specific template for the content. If you want to
                         * use this in a child theme, then include a file called called content-___.php
                         * (where ___ is the post format) and that will be used instead.
                         */
                        get_template_part( 'content', 'vendors' );


                        ?>



                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <aside class="l-sidebar">
                    <div class="widget widget-aside widget-list">
                        <div class="widget-header">Vendor Categories</div>
                        <?php ATU_Helper::list_vendor_category(); ?>
                    </div>
                    <div class="widget widget-aside well-widget">

                        <?php echo do_shortcode( '[mc4wp_form]' ); ?>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>