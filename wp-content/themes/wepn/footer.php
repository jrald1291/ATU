	</div>
	<footer class="l-footer">
		<?php if (of_get_option('rsvp_text', '') and of_get_option('rsvp_link', '')): ?>
			<div class="section-rsvp section-dark section-l0">
				<div class="container">
					<span class="t-sm mr-10"><?php echo of_get_option('rsvp_text', ''); ?></span> <a href="<?php echo of_get_option('rsvp_link', ''); ?>" target="_blank" class="btn btn-md btn-secondary">Meeting RSVP</a>
				</div>
			</div>
		<?php endif ?>
		<div class="section section-l4">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-12">
						<div class="footer-logo">
						<?php if(!of_get_option('footer_logo', '')){?>
			               <img src="<?php echo get_template_directory_uri() ?>/images/logo-footer.png" alt="">
			              <?php }else{ ?>
							<img src="<?php echo of_get_option('footer_logo', ''); ?>" alt="">
			              <?php } ?>
			              </div>
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
							<?php if (of_get_option('address', '')): ?>
								<div class="widget-header">Address</div>
								<div class="widget-core">
									<p><?php echo of_get_option('address', ''); ?></p> 
								</div>
							<?php endif ?>
						</div>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="widget widget-footer">
							<div class="widget-header">Contact info</div>
							<div class="widget-core">
								<ul class="widget-list">
									
									<?php if (of_get_option('email', '')) {?>
										<li>
											<a href="mailto:<?php echo of_get_option('email', ''); ?>"><span class="fa fa-envelope"></span> : <?php echo of_get_option('email', ''); ?></a>
										</li>
									<?php } ?>
										
									<?php if (of_get_option('phone', '')) {?>
										<li>
											<a href="tel:<?php echo of_get_option('phone', ''); ?>"><span class="fa fa-phone"></span> : <?php echo of_get_option('phone', ''); ?></a>
										</li>
									<?php }else{ ?>
										<li>
											<a href="tel:<?php echo of_get_option('tel', ''); ?>"><span class="fa fa-phone"></span> : <?php echo of_get_option('tel', ''); ?></a>
										</li>
									<?php } ?>
								</ul>
                                <form class="">
                                    
                                </form>
                                <?php echo do_shortcode('[contact-form-7 id="198" title="Become a Member" html_class="form form-labeled atu-membership-form"]'); ?>
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
</div>

<div class="modal fade in form-subscribe" id="EventSubscribe" tabindex="-1" role="dialog" aria-labelledby="EventSubscribe">
  <div class="modal-dialog modal-lg">
	  <div class="modal-content">
	  		  <div class="modal-header t-normal">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h3 class="modal-title t-title text-center">Subscribe to our Newsletter</h3>
	  		  </div>
			  <div class="modal-body">
		      	<div class="form form-labeled">
					<?php echo do_shortcode('[mc4wp_form]'); ?>
		        </div>
			  </div>
	   </div>
  </div>
</div>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64995349-1', 'auto');
  ga('send', 'pageview');

</script>

<?php wp_footer(); ?>
<?php 
	session_start(); 
	if (!isset($_SESSION['visisted'])) {
	  $_SESSION['visisted'] = 0;
	} else {
	  echo $_SESSION['visisted']++;
	}
?>
<script type="text/javascript">
	<?php if ($_SESSION['visisted'] == 0) { ?>
		$('#EventSubscribe').modal('show');
	<?php } ?>
</script>
</body>



</html>

