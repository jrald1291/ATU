<?php $banner = of_get_option('banner', '');   ?>

<?php if (!$banner): ?>
	<?php $banner = get_bloginfo('stylesheet_directory')."/images/placeholders/banner.jpg"; ?>
<?php endif ?>

<div class="banner" style="background: url('<?php echo $banner;?>') no-repeat;background-size: cover;">
  <div class="container">
  	  <div class="section section-l2">
		  <div class="banner-content">  	
		    <form role="search" method="get" class="search-form search-prop" action="<?php echo home_url( '/' ); ?>">
		  	    <input type="search" class="form-control search-keyword" placeholder="<?php echo esc_attr_x( 'Search Properties', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
		  	    <input type="hidden" name="post_type" value="property" />
		  		  <input type="submit" class="btn btn-primary pull-left" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
		        <a href="<?php echo get_permalink( get_page_by_path( 'contact-us' ) );?>" class="btn btn-primary pull-right">Inquire now</a>
		  	</form>
		  </div>
	  </div>
	</div>
</div>