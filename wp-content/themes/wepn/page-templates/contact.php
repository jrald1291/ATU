<?php

/**

 * Template Name: Contact Page

 *

 * @package WordPress

 * @subpackage Twenty_Fourteen

 * @since Twenty Fourteen 1.0

 */



get_header(); ?>





<?php



	$user_id = 1;

	$post_id =''; 

	$thanks_msg = '';
	$newline = '"<br>"';

	
	if(isset($_GET["contact_id"])){

		$user_id = $_GET["contact_id"];

	}

	if(isset($_GET["post_id"])){

		$post_id = $_GET["post_id"];

	}

	if ($user_id == 1 && $post_id =='') {
		$thanks_msg =  strval(of_get_option('message_primary', ''));
	}else{
		$thanks_msg =  strval(of_get_option('message_secondary', ''));

	}
	


	$user_info =  get_userdata($user_id);



?>



<div class="l-content-bg" style="background: url('<?php WEPN_Helper::background_image( get_field('page_background', get_the_ID()) ); ?>') no-repeat">

	<div class="container">

		<div class="row">

			<div class="col-md-9">

				<div class="l-content-container">

					<div class="page-header">

						<div class="row">

							<div class="col-md-6">

								<a href="<?php echo get_home_url().'/venue/';?>" class="btn btn-secondary btn-block">Find Venue</a>

							</div>

							<div class="col-md-6">

								<a href="<?php echo get_home_url().'/suppliers/';?>" class="btn btn-secondary btn-block">Find Supplier</a>

							</div>

						</div>	

					</div>

					<div class="page-content">
						<?php if ($user_id == 1 && $post_id == '') { ?>
						<div class="page-title ">

							<h2 class="t-md"><?php the_title(); ?></h2>

						</div>
						<?php } ?>

						<div class="section section-contact">

							<div class="contact-avatar">

								<?php if ($post_id) {?>

									<?php echo wp_get_attachment_image( get_post_thumbnail_id( $post_id ),'thumbnail'); ?>

								<?php }else{ ?>

									<?php echo wp_get_attachment_image( $user_info->profile_image, 'thumbnail' ); ?>

								<?php } ?>

							</div>

							<?php if ($post_id) {?>



								<div class="contact-name"> Welcome to <?php echo get_field('company_name',$post_id) ?></div>

								<div class="contact-company">Address: <?php echo get_field('address',$post_id) ?> <?php echo get_field('region',$post_id) ?> <?php echo get_field('post_code',$post_id) ?></div>

								<div class="contact-content">Call us if you prefer to speak to a real life person</div>

								<ul class="list list-contact list-inline">

									<?php if (get_field('mobile',$post_id)) {?>

										<li><a href="tel:<?php echo get_field('mobile',$post_id) ?>"><span class="fa fa-mobile icon-l-sm"></span><?php echo get_field('mobile',$post_id) ?></a></li>

									<?php } ?>

									<?php if (get_field('phone',$post_id)) {?>

										<li><a href="tel:<?php echo get_field('phone',$post_id) ?>"><span class="fa fa-phone icon-l-sm"></span><?php echo get_field('phone',$post_id) ?></a></li>

									<?php } ?>

									<?php if (get_field('email',$post_id)) {?>

										<li><a href="mailto:<?php echo get_field('email',$post_id) ?>"><span class="fa fa-envelope icon-l-sm"></span><?php echo get_field('email',$post_id) ?></a></li>

									<?php } ?>						

								</ul>



							<?php }else{ ?>



								<div class="contact-name"> Hi! I am <?php echo $user_info->first_name ?> <?php echo $user_info->last_name ?></div>
								<?php if ($user_id == 1) {?>
									<div class="contact-company">Wedding & Event Profesional Network</div>
								<?php }else{ ?>
									<div class="contact-company"><?php echo $user_info->company_name ?></div>
								<?php } ?>
								

								<div class="contact-content">Call me if you prefer to speak to a real life person</div>

								<ul class="list list-contact list-inline">

									<?php if ($user_info->mobile) {?>

										<li><a href="tel:<?php echo $user_info->mobile; ?>"><span class="fa fa-mobile icon-l-sm"></span><?php echo $user_info->mobile; ?></a></li>

									<?php } ?>

									<?php if ($user_info->phone) {?>

										 <li><a href="tel:<?php echo $user_info->phone; ?>"><span class="fa fa-phone icon-l-sm"></span><?php echo $user_info->phone; ?></a></li>

									<?php } ?>

									<?php if ($user_info->user_email) {?>

										<li><a href="mailto:<?php echo $user_info->user_email; ?>"><span class="fa fa-envelope icon-l-sm"></span><?php echo $user_info->user_email; ?></a></li>

									<?php } ?>

									

		                           

		                            

								</ul>



							<?php } ?>

							

						</div>				

						<?php echo do_shortcode('[contact-form-7 id="196" title="Contact ATU" html_class="form form-labeled"]'); ?>

					</div>

				</div>

			</div>

			<div class="col-md-3">

				<?php get_template_part('sidebar','secondary') ?>

			</div>

		</div>

	</div>

</div>

<script type="text/javascript">

	<?php if ($post_id) {?>

		document.getElementById("user_email").value = "<?php echo get_field('email',$post_id); ?>";

  		document.getElementById("company_name").value = "<?php echo get_field('company_name',$post_id) ;?>";

	<?php }else{ ?>

		document.getElementById("user_email").value = "<?php echo $user_info->user_email; ?>";

  		document.getElementById("company_name").value = "<?php echo $user_info->company_name; ?>";

	<?php } ?>

	document.getElementById("thanks_msg").value = "<?php echo $thanks_msg; ?>";

    (function($){

        $(document).ready(function() {


            <?php if (isset($_REQUEST['category']) ): ?>
            $('select option[value="<?php echo esc_attr($_REQUEST['category']); ?>"]').attr('selected', true);
            <?php endif; ?>

        });



    })(jQuery)

</script>

<?php get_footer(); ?>

