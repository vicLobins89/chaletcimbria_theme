<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								
							<?php // HERO AREA ?>
							<?php if( has_post_thumbnail() && is_page() ) : ?>
							<div class="featured-image">
								<?php the_post_thumbnail('full'); ?>
							</div>
							<?php endif; ?>

							<?php // MAIN CONTENT ?>
							<?php if( get_the_content() ) : ?>
								<section class="row entry-content cf top<?php if( get_field('wrap') ) { echo ' wrap'; } ?>" itemprop="articleBody">
									<div class="cf"><div class="col-12">
										<?php the_content(); ?>
									</div></div>
								</section>
							<?php endif; ?>
								
								
							<?php // IMAGE LINKS ?>
							<?php
							function image_links() { ?>
								<section class="row entry-content image-links-wrapper cf"
										 <?php echo (get_field('img_links_background') ? ' style="background:'.get_field('img_links_background').'"' : ''); ?>>
									<div class="cf">
									<?php
										if( get_field('img_links_title') ) {
											echo '<h2>'.get_field('img_links_title').'</h2>';
										}
									?>
									<?php while( have_rows('image_links') ): the_row(); ?>
										<div class="col-3"<?php echo ' style="width: calc(100% / '.get_field('img_links_col').')"' ; ?>>
											<a href="<?php the_sub_field('link'); ?>" class="image-links">
												<img src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('text'); ?>">
												<p><?php the_sub_field('text'); ?></p>
											</a>
										</div>
									<?php endwhile; ?>
									</div>
								</section>
							<?php
						   	} ?>
								
							<?php if( have_rows('image_links') ) : ?>
								<?php image_links(); ?>
							<?php endif; ?>
							

							<?php // COLUMNS CONTENT ?>
							<?php if( have_rows('rows') ): $rowNum = 0; ?>
								<?php while( have_rows('rows') ): the_row(); ?>

									<?php
									$rowNum ++;
									$layout = get_sub_field('layout');
									$padding = get_sub_field('padding');
									$bgColour = get_sub_field('bg_colour');
									$addClasses = array();
									$addStyles = array();
									$styles;
									if( $padding ) {
										if( $padding[padding_top] ) { array_push($addStyles, "padding-top: $padding[padding_top];"); }
										if( $padding[padding_right] ) { array_push($addStyles, "padding-right: $padding[padding_right];"); }
										if( $padding[padding_bottom] ) { array_push($addStyles, "padding-bottom: $padding[padding_bottom];"); }
										if( $padding[padding_left] ) { array_push($addStyles, "padding-left: $padding[padding_left];"); }
									}
									array_push($addClasses, "row-$rowNum");
									if( get_sub_field('bg_colour') ) {
										array_push($addClasses, "bg-colour");
										array_push($addClasses, "bg-colour$rowNum");
										array_push($addStyles, "background: $bgColour");
									}
									if( get_sub_field('border_bottom') ) {
										array_push($addClasses, "border-bottom");
									}
									if( isset($addClasses) || isset($addStyles) ) {
										$styles = ' style="';
										$styles .= implode(" ", $addStyles);
										$styles .= '"';
									}

									if( $layout === 'hide' ) {
										echo '<section class="row entry-content cf" style="display: none;">';
										echo '<div class="cf">';
									} else if( $layout === 'wrap' ) {
										echo '<section class="row entry-content wrap cf '.implode(" ", $addClasses).'"'.$styles.'>';
										echo '<div class="cf">';
									} else if( $layout === 'full' ) {
										echo '<section class="row entry-content full cf '.implode(" ", $addClasses).'"'.$styles.'>';
										echo '<div class="cf">';
									} else {
										echo '<section class="row entry-content cf '.implode(" ", $addClasses).'"'.$styles.'>';
										echo '<div class="cf">';
									}
									?>

									<?php if( get_sub_field('title') ) : ?>
										<h2 class="row-title"><?php echo get_sub_field('title'); ?></h2>
									<?php endif; ?>

									<?php if( get_sub_field('column_size') === '1col' ) : ?>

										<div class="col-12"><?php the_sub_field('col1'); ?></div>

									<?php elseif( get_sub_field('column_size') === '2col' ) : ?>

										<div class="cf col-6">
											<?php the_sub_field('col2_a'); ?>
										</div>

										<div class="cf col-6">
											<?php the_sub_field('col2_b'); ?>
										</div>

									<?php elseif( get_sub_field('column_size') === '3col' ) : ?>

										<div class="col-4">
											<?php the_sub_field('col3_a'); ?>
										</div>

										<div class="col-4">
											<?php the_sub_field('col3_b'); ?>
										</div>

										<div class="col-4">
											<?php the_sub_field('col3_c'); ?>
										</div>

									<?php elseif( get_sub_field('column_size') === '4col' ) : ?>

										<div class="col-3">
											<?php the_sub_field('col4_a'); ?>
										</div>

										<div class="col-3">
											<?php the_sub_field('col4_b'); ?>
										</div>

										<div class="col-3">
											<?php the_sub_field('col4_c'); ?>
										</div>

										<div class="col-3">
											<?php the_sub_field('col4_d'); ?>
										</div>

									<?php endif; ?>

									</section>

								<?php endwhile; ?>
							<?php endif; ?>
							

							<?php // PRE-FOOTER ?>
							<?php if( get_field('pre_footer') ) : ?>
								<section class="pre-footer row cf">
									<div class="max-width cf wrap">
										<?php if( get_field('pre_footer_media') ) : ?>
											<div class="col-6"><?php the_field('pre_footer_media') ?></div>
											<div class="col-6"><?php the_field('pre_footer') ?></div>
										<?php else : ?>
											<div class="col-12"><?php the_field('pre_footer') ?></div>
										<?php endif; ?>
									</div>
								</section>
							<?php endif; ?>

							</article>

							<?php endwhile; endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>