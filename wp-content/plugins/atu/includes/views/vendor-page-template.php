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

                                        <?php while( have_rows( 'gallery', 'user_'. $user->ID ) ): the_row(); ?>

                                            <li>
                                                <?php
                                                /**
                                                 * Get gallery image
                                                 */
                                                echo wp_get_attachment_image( get_sub_field( 'gallery_image' ), array( 800, 292 ), array( 'alt' => 'image' ) );
                                                ?>
                                            </li>

                                        <?php endwhile; ?>

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
                                                <li>
                                                    <figure>
                                                        <figcaption>
                                                            <h3>Letterpress asymmetrical</h3>
                                                            <p>Kale chips lomo biodiesel stumptown Godard Tumblr, mustache sriracha tattooed cray aute slow-carb placeat delectus. Letterpress asymmetrical fanny pack art party est pour-over skateboard anim quis, ullamco craft beer.</p>
                                                        </figcaption>
                                                        <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery1.jpg" alt="img01"/>
                                                    </figure>
                                                </li>
                                                <li>
                                                    <figure>
                                                        <figcaption>
                                                            <h3>Vice velit chia</h3>
                                                            <p>Chillwave Echo Park Etsy organic Cosby sweater seitan authentic pour-over. Occupy wolf selvage bespoke tattooed, cred sustainable Odd Future hashtag butcher.</p>
                                                        </figcaption>
                                                        <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery2.jpg" alt="img02"/>
                                                    </figure>
                                                </li>
                                                <li>
                                                    <figure>
                                                        <figcaption>
                                                            <h3>Brunch semiotics</h3>
                                                            <p>IPhone PBR polaroid before they sold out meh you probably haven't heard of them leggings tattooed tote bag, butcher paleo next level single-origin coffee photo booth.</p>
                                                        </figcaption>
                                                        <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery3.jpg" alt="img03"/>
                                                    </figure>
                                                </li>
                                                <li>
                                                    <figure>
                                                        <figcaption>
                                                            <h3>Chillwave nihil occupy</h3>
                                                            <p>Vice cliche locavore mumblecore vegan wayfarers asymmetrical letterpress hoodie mustache. Shabby chic lomo polaroid, scenester 8-bit Portland Pitchfork VHS tote bag.</p>
                                                        </figcaption>
                                                        <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery4.jpg" alt="img04"/>
                                                    </figure>
                                                </li>
                                                <li>
                                                    <figure>
                                                        <figcaption>
                                                            <h3>Kale chips lomo biodiesel</h3>
                                                            <p>Chambray Schlitz pug YOLO, PBR Tumblr semiotics. Flexitarian YOLO ennui Blue Bottle, forage dreamcatcher chillwave put a bird on it craft beer Etsy.</p>
                                                        </figcaption>
                                                        <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery5.jpg" alt="img05"/>
                                                    </figure>
                                                </li>
                                                <li>
                                                    <figure>
                                                        <figcaption>
                                                            <h3>Exercitation occaecat</h3>
                                                            <p>Cosby sweater hella lomo Thundercats VHS occupy High Life. Synth pop-up readymade single-origin coffee, fanny pack tousled retro. Fingerstache mlkshk ugh hashtag, church-key ethnic street art pug yr.</p>
                                                        </figcaption>
                                                        <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery6.jpg" alt="img06"/>
                                                    </figure>
                                                </li>
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
                        <div class="ven-avatar">

                            <?php echo wp_get_attachment_image( $user_info->profile_image, 'venue-listing' ); ?>
                            <div class="ven-name" data-color="#ff73b2"><?php the_title(); ?></div>
                        </div>
                    </div>
                    <div class="widget widget-aside widget-list">
                        <div class="widget-list_logo">
                            <?php echo wp_get_attachment_image( $user_info->company_logo,  'venue-listing' ); ?>
                        </div>
                        <div class="widget-header">Florist and Stylist</div>
                        <ul class="list">
                            <li><a href="tel:<?php echo $user_info->mobile; ?>">Mobile: <?php echo $user_info->mobile; ?></a></li>
                            <li><a href="tel:<?php echo $user_info->phone; ?>">Phone: <?php echo $user_info->phone; ?></a></li>
                            <li><a href="mailto:<?php echo $user_info->email; ?>"><?php echo $user_info->email; ?></a></li>
                            <li><a href="<?php echo $user_info->website; ?>" target="_blank"><?php echo $user_info->website; ?></a></li>
                        </ul>

                    </div>
                    <div class="widget widget-aside">
                        <a href="" class="btn btn-block btn-md btn-primary"><span class="fa icon-l fa-envelope"></span>Contact Vendor</a>
                    </div>
                    <div class="widget widget-aside">
                        <a href="<?php echo $user_info->website; ?>" target="_blank" class="btn btn-sm btn-block btn-secondary"><span class="fa icon-l-sm fa-globe"></span>Visit website</a>
                    </div>
                    <div class="widget widget-aside">
                        <div class="call-to-action">
                            <span class="icon icon-tel"></span>
                            <p>Any questions?</p>
                            <p>Call US Now</p>
                            <p><a href="">0405 421 387</a></p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="pagination-single">
        <ul>
            <li class="prev">
                <a href="">
                    <span class="label"><i class="fa fa-angle-left icon-l"></i>Previous</span>
                    <span>Gledswood wedding</span>
                </a>
            </li>
            <li class="back">
                <a href="#">back to vendors listing</a>
            </li>
            <li class="next">
                <a href="">
                    <span class="label">Next<i class="fa fa-angle-right icon-r"></i></span>
                    <span>Gledswood wedding</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php get_footer(); ?>
<script>
    new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>