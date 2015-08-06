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






while(have_posts()): the_post();

$user_id = get_post_meta( get_the_ID(), 'vendor', true );



$user_info = get_userdata( $user_id );



$cat_name = get_the_title();

$main_cat = get_post_meta( get_the_ID(), 'category', true );

$taxonomy = get_user_meta($user_id, 'city', true);

$cat = get_term_by( 'slug', $main_cat, $taxonomy );



if (!empty($cat) && !is_wp_error($cat)) $cat_name = $cat->name;





?>



<div class="l-content-bg" style="background: url('<?php WEPN_Helper::background_image( $user_info->background_image ); ?>') no-repeat">

    <div class="container">

        <div class="row">

            <div class="col-md-9">

                <div class="l-content-container">

                    <div class="page-header">

                        <?php do_action( 'wepn_vendor_search_form' ); ?>

                    </div>
                    <div class="pagination-single pagination-single-sm">
                        <ul>
                            <li class="next">
                                <?php $nepo = get_next_post();
                                if ($nepo) {
                                    $nepoid = $nepo->ID;
                                    $next_user_id = get_post_meta( $nepoid, 'vendor', true );?>
                                    <a href="<?php echo get_permalink( $nepoid ); ?>">
                                        <span class="label"><i class="fa fa-angle-left icon-l"></i>Previous Supplier</span>
                                    </a>
                                <?php } else {?>
                                    <div class="disabled">
                                        <span class="label"><i class="fa fa-angle-left icon-l"></i>No Previous Supplier</span>
                                    </div>
                                <?php } ?>
                            </li>
                            <li class="back">
                                <a href="<?php echo home_url( '/suppliers/' );  ?>"><span class="label">back to Suppliers Listing</span></a>
                            </li>
                            <li class="prev">
                                <?php $prepo = get_previous_post();

                                if ( $prepo ) {
                                    $prepoid = $prepo->ID;
                                    $prev_user_id = get_post_meta( $prepoid, 'vendor', true );
                                    ?>
                                    <a href="<?php echo get_permalink( $prepoid ); ?>">
                                        <span class="label">Next Supplier<i class="fa fa-angle-right icon-r"></i></span>
                                    </a>

                                <?php }else{?>

                                    <div class="disabled">
                                        <span class="label">No Next Supplier<i class="fa fa-angle-right icon-r"></i></span>
                                    </div>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                    <div class="page-content">

                        <div class="page-title ">

                            <h2 class="t-lg"><?php the_title(); ?></h2>

                        </div>

                        <div class="slider mb-20">

                            <div class="slider-single slider-capt flexslider mb-0">

                                <?php if ( have_rows( 'gallery', 'user_'. $user_id ) ): ?>

                                    <ul class="slides">



                                        <?php

                                        $i = 1;

                                        while( have_rows( 'gallery', 'user_'. $user_id ) ): the_row(); ?>



                                            <li>

                                                <?php

                                                /**

                                                 * Get gallery image

                                                 */

                                                echo wp_get_attachment_image( get_sub_field( 'gallery_image' ), 'slide-wide', array( 'alt' => 'image' ) );

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

                                <li role="presentation"><a href="#youtube" aria-controls="youtube" role="tab" data-toggle="tab">Videos</a></li>

                                <li role="presentation"><a href="#offers" aria-controls="offers" role="tab" data-toggle="tab">Special Offer</a></li>

                                <li role="presentation"><a href="#ratings" aria-controls="ratings" role="tab" data-toggle="tab">Rating</a></li>

                                <li role="presentation"><a href="#video" aria-controls="video" role="tab" data-toggle="tab"><?php _e( 'WEPN Difference', 'atu'); ?></a></li>

                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" id="ratings" class="tab-pane">
                                    <?php echo do_shortcode('[cbratingsystem form_id="1"]'); ?>
                                </div>
                                <div role="tabpanel" class="tab-pane active copy" id="description">

                                    <?php echo wpautop($user_info->description); ?>

                                </div>

                                <div role="tabpanel" class="tab-pane" id="gallery">
                                    <div id="grid-gallery" class="grid-gallery">

                                        <section class="grid-wrap">

                                            <?php if ( have_rows( 'gallery', 'user_'. $user_id ) ): ?>

                                                <ul class="grid">

                                                    <li class="grid-sizer"></li><!-- for Masonry column width -->



                                                    <?php while( have_rows( 'gallery', 'user_'. $user_id ) ): the_row();?>



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

                                                <?php while( have_rows( 'gallery', 'user_'. $user_id ) ): the_row();?>



                                                    <li>

                                                        <figure>

                                                            <?php if (get_sub_field( 'gallery_title' ) && get_sub_field( 'gallery_description' ) ) {?>

                                                                 <figcaption>

                                                                    <h3><?php the_sub_field( 'gallery_title' ); ?></h3>

                                                                    <p><?php the_sub_field( 'gallery_description' ); ?></p>

                                                                </figcaption>

                                                            <?php } ?>

                                                            <?php echo wp_get_attachment_image( get_sub_field( 'gallery_image' ), 'large', array( 'alt' => 'image' ) ); ?>

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

                                    <?php if ( have_rows( 'special_offer', 'user_'. $user_id ) ): ?>

                                        <ul class="post-inline post-member mb-20">

                                            <?php while( have_rows( 'special_offer', 'user_'. $user_id ) ):the_row();  ?>

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

                                <div role="tabpanel" class="tab-pane" id="video">

                                    <?php if (of_get_option('video_diff', '')) {?>
                                       <?php echo of_get_option('video_diff', ''); ?>
                                    <?php } ?>



                                </div>

                            </div>

                        </div>

                        <div class="social-links list-labeled-inline bt-0">

                            <label for="">Follow us in social :</label>

                            <ul>

                                <?php if(!empty($user_info->instagram)){ ?>

                                <li><a href="<?php echo $user_info->instagram; ?>" target="_blank"><span class="fa fa-instagram"></span></a></li>

                                <?php } ?> 

                                <?php if(!empty($user_info->youtube)){ ?>

                                <li><a href="<?php echo $user_info->youtube; ?>" target="_blank"><span class="fa fa-youtube"></span></a></li>

                                <?php } ?>

                                <?php if(!empty($user_info->google_plus)){ ?>

                                <li><a href="<?php echo $user_info->google_plus; ?>" target="_blank"><span class="fa fa-google-plus"></span></a></li>

                                <?php } ?>

                                <?php if(!empty($user_info->pinterest)){ ?>

                                <li><a href="<?php echo $user_info->pinterest; ?>" target="_blank"><span class="fa fa-pinterest"></span></a></li>

                                <?php } ?>

                                <?php if(!empty($user_info->twitter)){ ?>

                                <li><a href="<?php echo $user_info->twitter; ?>" target="_blank"><span class="fa fa-twitter"></span></a></li>

                                <?php } ?>

                                <?php if(!empty($user_info->linkedin)){ ?>

                                <li><a href="<?php echo $user_info->linkedin; ?>" target="_blank"><span class="fa fa-linkedin"></span></a></li>

                                <?php } ?>

                                <?php if(!empty($user_info->facebook)){ ?>

                                <li><a href="<?php echo $user_info->facebook; ?>" target="_blank"><span class="fa fa-facebook"></span></a></li>

                                <?php }?>

                            </ul>

                        </div>
                        <div class="section section-reviews">
                            
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <aside class="l-sidebar">

                    <?php if (!is_user_logged_in() ) { ?> 

                      <div class="widget">

                          <a href="<?php echo wp_login_url();?>" class="btn btn-primary btn-block">Member Login</a>

                          <a href="<?php echo get_permalink( get_page_by_title( 'Become a Member' ));?>" class="btn btn-primary btn-block mb-20">Become a Member</a>

                      </div>

                    <?php } ?>

                    <div class="widget widget-aside">

                        <div class="ven-avatar" style="border: 2px solid <?php echo hex2rgba($user_info->color); ?>">

                            <img src="<?php echo WEPN_Helper::supplier_avatar($user_info->profile_image, 'img-avatar'); ?>" />

                            <div class="ven-name"style="background-color:<?php echo hex2rgba(($user_info->color),0.5); ?>"><?php echo $user_info->first_name; ?></div>

                        </div>

                    </div>

                    <div class="widget widget-aside widget-list">

                        <div class="widget-list_logo">

                            <?php echo wp_get_attachment_image( $user_info->company_logo,  'medium' ); ?>

                        </div>

                        <div class="widget-header"><?php echo $cat_name; ?></div>

                        <ul class="list">

                            <?php if (trim(($user_info->mobile),' ')!="") {?>
                                <li><a href="tel:<?php echo $user_info->mobile; ?>">Mobile: <?php echo $user_info->mobile; ?></a></li>
                            <?php } ?>
                            <?php if (trim(($user_info->phone),' ')!="") {?>
                                <li><a href="tel:<?php echo $user_info->phone; ?>">Phone: <?php echo $user_info->phone; ?></a></li>
                            <?php } ?>
                            <?php if (trim(($user_info->user_email),' ')!="") {?>
                                <li><a href="mailto:<?php echo $user_info->user_email;?>"><?php echo $user_info->user_email; ?></a></li>
                            <?php } ?>
                            <?php if (trim(($user_info->user_url),' ')!="") {?>
                                <li><a href="<?php echo $user_info->user_url; ?>" target="_blank"><?php echo $user_info->user_url; ?></a></li>
                            <?php } ?>

                        </ul>



                    </div>

                    <div class="widget widget-aside">

                        <a href="<?php echo get_permalink(32)."?contact_id=".$user_id. "&category=" .  $cat_name;?>" class="btn btn-block btn-md btn-primary"><span class="fa icon-l fa-envelope"></span>Contact Supplier</a>

                    </div>
                    <?php if (trim(($user_info->user_url),' ')!="") {?>
                        <div class="widget widget-aside">
                            <a href="<?php echo $user_info->user_url; ?>" target="_blank" class="btn btn-sm btn-block btn-secondary"><span class="fa icon-l-sm fa-globe"></span>Visit website</a>
                        </div>
                    <?php } ?>
                    <div class="widget widget-aside">

                        <div class="call-to-action" style="background-color:<?php echo hex2rgba($user_info->color); ?>">

                            <span class="icon icon-tel"></span>

                            <p>Any questions?</p>

                            <p>Call US Now</p>

                            <p>
                                <?php if (trim(($user_info->phone),' ')!="") {?>
                                    <a href="tel:<?php echo $user_info->phone; ?>"><?php echo $user_info->phone; ?></a>
                                <?php }else{ ?>
                                    <a href="tel:<?php echo $user_info->mobile; ?>"><?php echo $user_info->mobile; ?></a>
                                <?php } ?>
                            </p>

                        </div>

                    </div>

                </aside>

            </div>

        </div>

    </div>

    <div class="pagination-single">

        <ul>

            <li class="next">

                <?php

                $nepo=get_next_post();

                if ($nepo) {

                    $nepoid=$nepo->ID;

                    $ne_post_url = get_permalink($nepoid);?>

                    <a href="<?php echo $ne_post_url; ?>">

                        <span class="label"><i class="fa fa-angle-left icon-l"></i>Previous</span>

                        <span><?php the_title(); ?></span>

                    </a>

                <?php }else{?>

                    <div class="disabled">

                        <span class="label"><i class="fa fa-angle-left icon-l"></i>Previous</span>

                        <span>No previous Venue</span>

                    </div>

                <?php } ?>

            </li>

            <li class="back">

                <a href="<?php echo home_url( '/venue/' ) ?>">back to Venue Listing</a>

            </li>

            <li class="prev">

                <?php $prepo = get_previous_post();


                if ($prepo) {

                    $prepoid=$prepo->ID;

                    $pre_post_url = get_permalink($prepoid);?>

                    <a href="<?php echo $pre_post_url; ?>">

                        <span class="label">Next<i class="fa fa-angle-right icon-r"></i></span>

                        <span><?php the_title(); ?></span>

                    </a>

                <?php }else{?>

                    <div class="disabled">

                        <span class="label">Next<i class="fa fa-angle-right icon-r"></i></span>

                        <span>No Next Venue</span>

                    </div>

                <?php } ?>



            </li>

        </ul>

    </div>

</div>

<?php

endwhile;

get_footer(); ?>

