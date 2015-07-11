<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */


get_header();

$user = get_user_by( 'login', get_query_var( 'username' ) );




$user_info = get_userdata( $user->ID );

?>

<div class="l-content-bg" style="background: url('<?php ATU_Helper::background_image( $user_info->background_image ); ?>') no-repeat">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="l-content-container">
                    <div class="page-header">
                        <?php do_action( 'atu_vendor_search_form' ); ?>
                    </div>
                    <div class="page-content">
                        <div class="page-title ">
                            <h2 class="t-lg"><?php echo $user_info->company_name; ?></h2>
                        </div>
                        <div class="slider mb-20">
                            <div class="slider-single slider-capt flexslider mb-0">
                                <?php if ( have_rows( 'gallery', 'user_'. $user->ID ) ): ?>
                                    <ul class="slides">

                                        <?php
                                        $i = 1;
                                        while( have_rows( 'gallery', 'user_'. $user->ID ) ): the_row(); ?>

                                            <li>
                                                <?php
                                                /**
                                                 * Get gallery image
                                                 */
                                                echo wp_get_attachment_image( get_sub_field( 'gallery_image' ), 'img-wide', array( 'alt' => 'image' ) );
                                                ?>
                                            </li>

                                        <?php
                                            if ( $i++ == 5 )
                                                break;
                                        endwhile; reset_rows();?>

                                    </ul>

                                <?php else: ?>

                                    <?php _e( 'No Gallery found', 'atu' ); ?>

                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="section section-tabbed">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#description" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                <li role="presentation"><a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">Gallery</a></li>
                                <li role="presentation"><a href="#youtube" aria-controls="youtube" role="tab" data-toggle="tab">Youtube Video</a></li>
                                <li role="presentation"><a href="#offers" aria-controls="offers" role="tab" data-toggle="tab">Special Offer</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active copy" id="description">
                                    <p><?php echo $user_info->description ?></p>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="gallery">
                                    <div id="grid-gallery" class="grid-gallery">
                                        <section class="grid-wrap">
                                            <?php if ( have_rows( 'gallery', 'user_'. $user->ID ) ): ?>
                                                <ul class="grid">
                                                    <li class="grid-sizer"></li><!-- for Masonry column width -->

                                                    <?php while( have_rows( 'gallery', 'user_'. $user->ID ) ): the_row();?>

                                                        <li>
                                                            <figure>

                                                                <?php
                                                                /**
                                                                 * Get gallery image
                                                                 */
                                                                echo wp_get_attachment_image( get_sub_field( 'gallery_image' ), 'gallery-thumb', array( 'alt' => 'image' ) );
                                                                ?>
                                                            </figure>
                                                        </li>

                                                    <?php endwhile; ?>

                                                </ul>
                                            <?php else: ?>

                                                <?php _e( 'No Gallery found', 'atu' ); ?>

                                            <?php endif; ?>
                                        </section><!-- // grid-wrap -->
                                        <section class="slideshow">
                                            <ul>
                                                <?php while( have_rows( 'gallery', 'user_'. $user->ID ) ): the_row();?>

                                                    <li>
                                                        <figure>
                                                            <figcaption>
                                                                <h3><?php echo the_sub_field( 'gallery_title' ); ?></h3>
                                                                <p><?php echo the_sub_field( 'gallery_description' ); ?></p>
                                                            </figcaption>
                                                            <?php echo wp_get_attachment_image( get_sub_field( 'gallery_image' ), 'img-lscape', array( 'alt' => 'image' ) ); ?>
                                                        </figure>
                                                    </li>

                                                <?php endwhile; ?>
                                            </ul>
                                            <nav>
                                                <span class="icon nav-prev"></span>
                                                <span class="icon nav-next"></span>
                                                <span class="icon nav-close"></span>
                                            </nav>
                                            <div class="info-keys icon">Navigate with arrow keys</div>
                                        </section><!-- // slideshow -->
                                    </div><!-- // grid-gallery -->
                                </div>
                                <div role="tabpanel" class="tab-pane" id="youtube">
                                    <?php echo $user_info->youtube_iframe; ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="offers">
                                    <?php if ( have_rows( 'special_offer', 'user_'. $user->ID ) ): ?>
                                        <ul class="post-inline post-member mb-20">
                                            <?php while( have_rows( 'special_offer', 'user_'. $user->ID ) ):the_row();  ?>
                                                <li class="post-item">
                                                    <div class="post-img well-img">
                                                        <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/pdf.jpg" alt="">
                                                    </div>
                                                    <div class="post-core">
                                                        <a href="<?php echo get_sub_field( 'special_offer_pdf', '#' ); ?>" target="_blank" class="link"><div class="post-title t-normal"><?php the_sub_field( 'special_offer_title' ); ?> <span class="post-cat t-highlight">Download PDF</span></div></a>
                                                        <p><?php the_sub_field( 'special_offer_description' ); ?></p>
                                                    </div>
                                                </li>
                                            <?php endwhile; ?>
                                        </ul>

                                    <?php else: ?>

                                        <?php _e( 'No Special offer found', 'atu' ); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="social-links list-labeled-inline bt-0">
                            <label for="">Follow us in social :</label>
                            <ul>
                                <li><a href="<?php echo $user_info->instagram ?>"><span class="fa fa-instagram"></span></a></li>
                                <li><a href="<?php echo $user_info->youtube ?>"><span class="fa fa-youtube"></span></a></li>
                                <li><a href="<?php echo $user_info->google_plus; ?>"><span class="fa fa-google-plus"></span></a></li>
                                <li><a href="<?php echo $user_info->pinterest; ?>"><span class="fa fa-pinterest"></span></a></li>
                                <li><a href="<?php echo $user_info->twitter ?>"><span class="fa fa-twitter"></span></a></li>
                                <li><a href="<?php echo $user_info->linkedin ?>"><span class="fa fa-linkedin"></span></a></li>
                                <li><a href="<?php echo $user_info->facebook ?>"><span class="fa fa-facebook"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <aside class="l-sidebar">
                    <div class="widget widget-aside">
                        <div class="ven-avatar" style="border: 2px solid <?php echo hex2rgba($user_info->color); ?>">

                            <?php echo wp_get_attachment_image( $user_info->profile_image, 'img-avatar' ); ?>
                            <div class="ven-name"style="background-color:<?php echo hex2rgba(($user_info->color),0.5); ?>"><?php echo $user_info->first_name; ?></div>
                        </div>
                    </div>
                    <div class="widget widget-aside widget-list">
                        <div class="widget-list_logo">
                            <?php echo wp_get_attachment_image( $user_info->company_logo,  'medium' ); ?>
                        </div>
                        <div class="widget-header">Florist and Stylist</div>
                        <ul class="list">
                            <li><a href="tel:<?php echo $user_info->mobile; ?>">Mobile: <?php echo $user_info->mobile; ?></a></li>
                            <li><a href="tel:<?php echo $user_info->phone; ?>">Phone: <?php echo $user_info->phone; ?></a></li>
                            <li><a href="mailto:<?php echo $user_info->user_email;?>"><?php echo $user_info->user_email; ?></a></li>
                            <li><a href="<?php echo $user_info->user_url; ?>" target="_blank"><?php echo $user_info->user_url; ?></a></li>
                        </ul>

                    </div>
                    <div class="widget widget-aside">
                        <a href="<?php echo get_permalink( get_page_by_title( 'Contact' ))."?contact_id=".$user->ID;?>" class="btn btn-block btn-md btn-primary"><span class="fa icon-l fa-envelope"></span>Contact Vendor</a>
                    </div>
                    <div class="widget widget-aside">
                        <a href="<?php echo $user_info->user_url; ?>" target="_blank" class="btn btn-sm btn-block btn-secondary"><span class="fa icon-l-sm fa-globe"></span>Visit website</a>
                    </div>
                    <div class="widget widget-aside">
                        <div class="call-to-action" style="background-color:<?php echo hex2rgba($user_info->color); ?>">
                            <span class="icon icon-tel"></span>
                            <p>Any questions?</p>
                            <p>Call US Now</p>
                            <p><a href="tel:<?php echo $user_info->phone; ?>"><?php echo $user_info->phone; ?></a></p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <?php

    $prev_user = ATU_Helper::get_prev_user( $user->ID );
    $prev_user = $prev_user ? $prev_user : $user;

    $prev_company = get_user_meta( $prev_user->ID, 'company_name', true );

    $next_user = ATU_Helper::get_next_user( $user->ID );
    $next_user = $next_user ? $next_user : $user;

    $next_company = get_user_meta( $next_user->ID, 'company_name', true );
    ?>
    <div class="pagination-single">
        <ul>
            <li class="prev">
                <a href="<?php echo home_url('/vendor/') . $prev_user->user_login; ?>">
                    <span class="label"><i class="fa fa-angle-left icon-l"></i>Previous</span>
                    <span><?php echo get_user_meta( $prev_user->ID, 'company_name', true ); ?></span>
                </a>
            </li>
            <li class="back">
                <a href="<?php echo home_url('/vendors'); ?>">back to vendors listing</a>
            </li>
            <li class="next">
                <a href="<?php echo home_url('/vendor/') . $next_user->user_login; ?>">
                    <span class="label">Next<i class="fa fa-angle-right icon-r"></i></span>
                    <span><?php echo $next_company; ?></span>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php get_footer(); ?>
