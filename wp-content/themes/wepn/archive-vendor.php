<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header();?>


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
                        <div class="widget-header">Supplier Types</div>
                        <?php ATU_Helper::list_vendor_category(); ?>
                    </div>
                    <div class="widget widget-aside well-widget">
                        <div class="form form-labeled">
                            <?php echo do_shortcode('[mc4wp_form]'); ?>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>



<?php get_footer(); ?>
