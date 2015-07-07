<?php

get_header();

if ( have_posts() ):

    while ( have_posts() ): the_post();
        /**
         * Get the page background meta
         * @var  $page_background */
        $page_background = wp_get_attachment_image_src( get_field( 'page_background', get_the_ID() ), 'large' );
        /**
         * Get option banner
         * @var  $bg */
        $bg = of_get_option('banner', '');
        if ( empty( $page_background ) && empty( $bg ) ) {
            $page_background = get_template_directory_uri()."/assets/images/banner.jpg";
        } elseif ( ! empty( $bg ) ) {
            $page_background = $bg;
        }
?>



<div class="l-content-bg" style="background: url('<?php echo $page_background; ?>') no-repeat">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="l-content-container">
                    <div class="page-header">
                        <form action="<?php echo home_url( '/' ); ?>" class="form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="s" class="form-control input-block" placeholder="Keyword...">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">Venue Category</div>
                                        <?php wp_dropdown_categories( array(
                                            'taxonomy'  => 'venue-category',
                                            'hide_empty'         => 0,
                                            'name'               => 'venue-category',
                                            'class'              => 'form-control',
                                            'show_option_none'   => '',
                                            'option_none_value'  => '-1',
                                        ) ); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" name="post_type" value="venue">
                                    <button class="btn btn-secondary btn-block" ><span class="fa fa-search icon-l"></span>Search Venue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="page-content">
                        <div class="page-title ">
                            <h2 class="t-lg"><?php the_field( 'company_name' ) ?></h2>
                        </div>
                        <div class="slider mb-20">
                            <div class="slider-single slider-capt flexslider mb-0">
                                <?php if ( have_rows( 'gallery' ) ): ?>
                                    <ul class="slides">

                                        <?php while( have_rows( 'gallery' ) ): the_row(); ?>

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
                                <li role="presentation" class="active"><a href="#description" aria-controls="home" role="tab" data-toggle="tab"><?php _e( 'Description', 'atu'); ?></a></li>
                                <li role="presentation"><a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab"><?php _e( 'Gallery', 'atu'); ?></a></li>
                                <li role="presentation"><a href="#youtube" aria-controls="youtube" role="tab" data-toggle="tab"><?php _e( 'Youtube Video', 'atu'); ?></a></li>
                                <li role="presentation"><a href="#offers" aria-controls="offers" role="tab" data-toggle="tab"><?php _e( 'Special Offer', 'atu'); ?></a></li>
                                <li role="presentation"><a href="#map" aria-controls="map" role="tab" data-toggle="tab"><?php _e( 'Map', 'atu'); ?></a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active copy" id="description">
                                    <?php the_content() ?>
                                    <p>Address: <?php the_field( 'address' ); ?></p>
                                    <p>Postcode: <?php the_field( 'post_code' ); ?></p>
                                    <p>Service Area: <?php the_field( 'service_area' ); ?></p>
                                    <p>Business Hours: <?php the_field( 'business_hours' ); ?></p>
                                    <p>Capacity: <?php the_field( 'capacity' ); ?></p>

                                </div>
                                <div role="tabpanel" class="tab-pane" id="gallery">
                                    <div id="grid-gallery" class="grid-gallery">
                                        <section class="grid-wrap">
                                            <?php if ( have_rows( 'gallery' ) ): ?>
                                            <ul class="grid">
                                                <li class="grid-sizer"></li><!-- for Masonry column width -->

                                                <?php while( have_rows( 'gallery' ) ): the_row();?>

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
                                    <?php the_field( 'youtube_iframe' ); ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="offers">
                                    <?php if ( have_rows( 'special_offer' ) ): ?>
                                    <ul class="post-inline post-member mb-20">
                                        <?php while( have_rows( 'special_offer' ) ):the_row();  ?>
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
                                <div role="tabpanel" class="tab-pane" id="map">
                                    <?php

                                    $location = get_field('map');

                                    if( !empty($location) ):
                                    ?>
                                    <div class="acf-map">
                                        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
                                    </div>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                        <div class="social-links list-labeled-inline bt-0">
                            <label for="">Follow us in social :</label>
                            <ul>
                                <li><a href="<?php the_field( 'instagram' ); ?>"><span class="fa fa-instagram"></span></a></li>
                                <li><a href="<?php the_field( 'youtube' ); ?>"><span class="fa fa-youtube"></span></a></li>
                                <li><a href="<?php the_field( 'google_+' ); ?>"><span class="fa fa-google-plus"></span></a></li>
                                <li><a href="<?php the_field( 'pinterest' ); ?>"><span class="fa fa-pinterest"></span></a></li>
                                <li><a href="<?php the_field( 'twitter' ); ?>"><span class="fa fa-twitter"></span></a></li>
                                <li><a href="<?php the_field( 'linkedin' ); ?>"><span class="fa fa-linkedin"></span></a></li>
                                <li><a href="<?php the_field( 'facebook' ); ?>"><span class="fa fa-facebook"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
    <div class="pagination-single">
        <ul>
            <li class="prev">
                <?php previous_post_link( '%link', '<span class="label"><i class="fa fa-angle-left icon-l"></i>Previous</span>
                    <span>%title</span>' ); ?>
            </li>
            <li class="back">
                <a href="<?php echo get_post_type_archive_link( 'venue' ); ?>">back to vendors listing</a>
            </li>
            <li class="next">
                <?php next_post_link( '%link', '<span class="label">Next<i class="fa fa-angle-right icon-r"></i></span>
                    <span>%title</span>' ); ?>
            </li>
        </ul>
    </div>
</div>
    <?php endwhile; ?>

<?php endif; ?>

<script>
   // new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>
<?php get_footer(); ?>
