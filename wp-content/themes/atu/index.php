<?php
/**
 * Template Name: Contact
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>


<div class="l-content-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="l-content-container">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6">
								<button class="btn btn-secondary btn-block" data-toggle="modal" data-target=".form-venue">Search Venue</button>
							</div>
							<div class="col-md-6">
								<button class="btn btn-secondary btn-block" data-toggle="modal" data-target=".form-vendor">Search Vendor</button>
							</div>
						</div>	
					</div>
					<div class="page-content">
						<div class="post-inline post-blog post-member mb-20">
							<article class="post-item">
								<div class="post-img well-img">
									<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb1.jpg" alt="">
								</div>
								<div class="post-core">
									<div class="post-title t-normal"><a href="#" class="link">Aliquip ex ea commodo </a></div>
									<div class="post-meta"><div class="meta date">Posted: May 12,2015</div><div class="meta author">By: Anne Lorem ipsum</div></div>
									<div class="post-content">
										<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse consequat, vel illum dolore eu feugiat nulla facilisis at. Mirum est notare quam, quam nunc putamus parum . <a href="">read more</a></p>
									</div>
								</div>
							</article>
							<article class="post-item">
								<div class="post-img well-img">
									<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb2.jpg" alt="">
								</div>
								<div class="post-core">
									<div class="post-title t-normal"><a href="#" class="link">Aliquip ex ea commodo </a></div>
									<div class="post-meta"><div class="meta date">Posted: May 12,2015</div><div class="meta author">By: Anne Lorem ipsum</div></div>
									<div class="post-content">
										<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse consequat, vel illum dolore eu feugiat nulla facilisis at. Mirum est notare quam, quam nunc putamus parum . <a href="">read more</a></p>
									</div>
								</div>
							</article>
							<article class="post-item">
								<div class="post-img well-img">
									<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb3.jpg" alt="">
								</div>
								<div class="post-core">
									<div class="post-title t-normal"><a href="#" class="link">Aliquip ex ea commodo </a></div>
									<div class="post-meta"><div class="meta date">Posted: May 12,2015</div><div class="meta author">By: Anne Lorem ipsum</div></div>
									<div class="post-content">
										<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse consequat, vel illum dolore eu feugiat nulla facilisis at. Mirum est notare quam, quam nunc putamus parum . <a href="">read more</a></p>
									</div>
								</div>
							</article>
							<article class="post-item">
								<div class="post-img well-img">
									<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb4.jpg" alt="">
								</div>
								<div class="post-core">
									<div class="post-title t-normal"><a href="#" class="link">Aliquip ex ea commodo </a></div>
									<div class="post-meta"><div class="meta date">Posted: May 12,2015</div><div class="meta author">By: Anne Lorem ipsum</div></div>
									<div class="post-content">
										<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse consequat, vel illum dolore eu feugiat nulla facilisis at. Mirum est notare quam, quam nunc putamus parum . <a href="">read more</a></p>
									</div>
								</div>
							</article>
							<article class="post-item">
								<div class="post-core">
									<div class="post-title t-normal"><a href="#" class="link">Aliquip ex ea commodo </a></div>
									<div class="post-meta"><div class="meta date">Posted: May 12,2015</div><div class="meta author">By: Anne Lorem ipsum</div></div>
									<div class="post-content">
										<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse consequat, vel illum dolore eu feugiat nulla facilisis at. Mirum est notare quam, quam nunc putamus parum . <a href="">read more</a></p>
									</div>
								</div>
							</article>
						</div>
						<div class="pagination">
							<label for="">Pagination :</label>
							<div class="wp-pagenavi"> <span class="pages">Page 1 of 2</span><span class="current">1</span><a class="page larger" href="http://www.cebudreamhomes.com/properties/page/2/">2</a><a class="nextpostslink" rel="next" href="http://www.cebudreamhomes.com/properties/page/2/">Next</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<?php get_template_part('sidebar','secondary') ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
<script>
	 new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>