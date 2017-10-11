<?php get_header(); ?>
<div class="row">
	<div class="content-page col-md-12 col-sm-12">
		<div class="bread">
			<?php if(function_exists('cmp_breadcrumbs')) cmp_breadcrumbs();?>
		</div>
		<div class="row">
			<div class="col-md-4 col-sm-12 border-right">
				<?php get_sidebar(); ?>
			</div>
			<div class="col-md-7 col-sm-12 wrapper">
				<?php 
					if(function_exists('get_current_category_id')) {
						$current_cat = get_current_category_id();
					}else{
						$current_cat = 1;
					}
					$args = array(
						'cat' => $current_cat,
						'posts_per_page' => 10,
					); 
					query_posts($args);
				?>			
				<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>
				<div class="post">
					<div class="row">
						<div class="col-md-4 col-sm-12 post-thumbnail">
							<a href="<?php the_permalink(); ?>" class="thumbnail">
								<?php if(has_post_thumbnail()) : ?>
								<?php the_post_thumbnail('thumbnail'); ?>
								<?php else: ?>
								<img src="<?php echo catch_first_image(); ?>"/>
								<?php endif; ?>
							</a>
						</div><!--end of post-thumbnail-->
						<div class="col-md-7 col-sm-12 post-content">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,300,"......"); ?></p>
							<p><a href="#" class="btn btn-primary" role="button">点击查看全文</a>
						</div><!--end of post-content-->
					</div>
				</div><!--end of post-->
				<?php endwhile;  wp_reset_query(); ?>
				<div class="paging">
					<?php echo paginate_links( array(
						'prev_text'=> __('« Previous'),
						'next_text'=> __('Next »'),
					)); ?>
				</div><!--end of paging-->
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>