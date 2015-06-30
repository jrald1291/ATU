	</div>
	<footer class="l-footer">
		<div class="section-rsvp section-dark section-l0">
			<div class="container">
				<span class="t-sm mr-10">Are you a wedding vendor, couple or venue? We welcome you to come as our guest on our monthly meetings! </span> <a href="" class="btn btn-md btn-secondary">Meeting RSVP</a>
			</div>
		</div>
		<div class="section section-l4">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-12">
						<div class="footer-logo"><img src="<?php echo get_template_directory_uri() ?>/images/logo-footer.png" alt=""></div>
					</div>
					<div class="col-md-2 col-sm-6">
						<div class="widget widget-footer widget-nav">
							<div class="widget-header">Quick Links</div>
							<div class="widget-header">
								<?php

									$defaults = array(
										'theme_location'  => 'secondary',
										'menu'            => '',
										'container'       => '',
										'container_class' => '',
										'container_id'    => '',
										'menu_class'      => 'nav',
										'menu_id'         => '',
										'echo'            => true,
										'fallback_cb'     => 'wp_page_menu',
										'before'          => '',
										'after'           => '',
										'link_before'     => '',
										'link_after'      => '',
										'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										'depth'           => 0,
										'walker'          => ''
									);

									wp_nav_menu( $defaults );

								?>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="widget widget-footer">
							<div class="widget-header">Address</div>
							<div class="widget-core">
								<p>Lorem St. dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>
								<p>00288 009</p>
							</div>

						</div>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="widget widget-footer">
							<div class="widget-header">Contact info</div>
							<div class="widget-core">
								<ul class="widget-list">
									<li>
										<a href=""><span class="fa fa-envelope"></span> : info.yourweddingalltiedup.com.au</a>
									</li>
									<li>
										<a href=""><span class="fa fa-phone"></span> : 1234-0000-34-00</a>
									</li>
								</ul>
								<form action="" class="form form-labeled">
									<div class="form-group field-wrap">
										<label for="">Email Address</label>
										<input type="text" class="form-control">
									</div>
									<button class="btn btn-primary btn-block"><span class="fa fa-user icon-l"></span>Become a member</button>
								</form>
							</div>

						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="footnotes">
				<div class="container">
					<div class="section">
						<span><?php echo of_get_option('copyright', '');   ?></span>
					</div>
				</div>
			</div>
	</footer>


	<!-- -----------------------------MODAL------------------------ -->


	<div class="modal fade in form-venue" tabindex="-1" role="dialog" aria-labelledby="VenueSearch">
	  <div class="modal-dialog modal-lg">
	  <div class="modal-content">
			  <div class="modal-header t-normal">Search for Venue</div>
			  <div class="modal-body">
		      	<form action="" class="form form-labeled">
					<div class="form-group field-wrap">
						<label for="">Keyword<span class="req">*</span></label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label for="" class="label-drop">Venue Category<span class="req">*</label>
						<select class="form-control" name="" id="">
							<option value="">test</option>
						</select>
					</div>
					<button class="btn btn-secondary btn-block" >Search Venue</button>
				</form>
			  </div>
	   
   			<div class="modal-footer">
	   			<button class="btn btn-primary btn-block" class="btn btn-default" data-dismiss="modal">Close</button>
	   		</div>
	   </div>
	  </div>
	</div>
	<div class="modal fade in form-vendor" tabindex="-1" role="dialog" aria-labelledby="VendorSearch">
	  <div class="modal-dialog modal-lg">
	  <div class="modal-content">
			  <div class="modal-header t-normal">Search for Vendor</div>
			  <div class="modal-body">
		      	<form action="" class="form form-labeled">
					<div class="form-group field-wrap">
						<label for="">Keyword<span class="req">*</span></label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label for="" class="label-drop">Vendor Category<span class="req">*</label>
						<select class="form-control" name="" id="">
							<option value="">test</option>
						</select>
					</div>
					<button class="btn btn-secondary btn-block" >Search Vendor</button>
				</form>
			  </div>
	   
   			<div class="modal-footer">
	   			<button class="btn btn-primary btn-block" class="btn btn-default" data-dismiss="modal">Close</button>
	   		</div>
	   </div>
	  </div>
	</div>


	<!-- -----------------------------MODAL------------------------ -->
</div>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
e=o.createElement(i);r=o.getElementsByTagName(i)[0];
e.src='//www.google-analytics.com/analytics.js';
r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
ga('create','UA-XXXXX-X');ga('send','pageview');
</script>
<?php wp_footer(); ?>
</body>

</html>
