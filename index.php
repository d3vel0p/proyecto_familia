<?php get_header(); ?>

<?php if( $cover = gridlove_get_cover_layout() ) : ?>
    <?php get_template_part( 'template-parts/cover/layout-' . absint( $cover ) ); ?>
<?php endif; ?>

<?php get_template_part('template-parts/ads/below-header'); ?>

    <div id="content" class="gridlove-site-content container">

        <div class="gridlove-module module-type-posts <?php echo (!gridlove_has_combo_layout() && gridlove_get_archive_layout_type() == 'masonry') ? "gridlove-module-layout-" . gridlove_get_archive_layout_type() : '';?>">
            <?php echo gridlove_get_archive_heading(); ?>

            <div class="row gridlove-posts">

                <?php if( have_posts() ): ?>

                    <?php $grid = gridlove_get_archive_layout(); ?>
                    <?php $inject_ad_position = gridlove_get_archive_ad(); ?>

                    <?php 

                    $i = 0; 
                    $j = 0; 
                    $base = 0; 
                    $loop_position = 1; 
                        
                    while( have_posts() ) : the_post(); ?>

                        <?php echo gridlove_open_masonery_wrapper($j) ? '<div class="gridlove-masonry-wrapper">' : ''; ?>

                        <?php if( $i == count( $grid ) ) { $i = $base; } ?>

                        <?php if ( $inject_ad_position == $loop_position ) : ?>
                        <?php $post_col = $grid[$i]['col']; ?>
                            <div class="<?php echo esc_attr( gridlove_get_bootstrap_columns( $post_col )); ?> layout-<?php echo esc_attr(gridlove_get_archive_layout_type());?>">
                                <?php $post_col .= gridlove_get_archive_layout_type() === 'masonry' ? '-orig' : ''; ?>
                                <?php include( locate_template('template-parts/ads/archive.php') ); ?>
                            </div>
                            <?php $i++; ?>
                            <?php if( $i == count( $grid ) ) { $i = 0; } ?>
					    <?php endif; ?>

                        <?php $post_col = $grid[$i]['col']; ?>
                        <div class="<?php echo esc_attr( gridlove_get_bootstrap_columns( $post_col ) ); ?> layout-<?php echo esc_attr(gridlove_get_archive_layout_type());?>">
                            <?php $post_col .= gridlove_get_archive_layout_type() === 'masonry' ? '-orig' : ''; ?>
                            <?php include( locate_template('template-parts/layouts/content-'. $grid[$i]['layout'].'.php') ); ?>
                        </div>
                        <?php if( isset( $grid[$i]['base'] ) ) { $base = $i; } ?>

                        <?php  $i++; $j++; $loop_position++; ?>

                    <?php endwhile;  ?>

                    <?php if ( $inject_ad_position == $loop_position && !empty( $grid[$i]['col'] ) ) : ?>
                        <?php $post_col = $grid[$i]['col']; ?>
                        <div class="<?php echo esc_attr( gridlove_get_bootstrap_columns( $post_col )); ?> layout-<?php echo esc_attr(gridlove_get_archive_layout_type());?>">
                            <?php $post_col .= gridlove_get_archive_layout_type() === 'masonry' ? '-orig' : ''; ?>
                            <?php include( locate_template('template-parts/ads/archive.php') ); ?>
                        </div>
                        <?php $i++; ?>
                        <?php if( $i == count( $grid ) ) { $i = 0; } ?>
					<?php endif; ?>

                    <?php echo gridlove_close_masonery_wrapper() ? '</div>' : ''; ?>

                <?php else: ?>

                    <?php get_template_part('template-parts/layouts/content-none'); ?>

                <?php endif; ?>

            </div>

        </div>

        <?php get_template_part( 'template-parts/pagination/'. gridlove_get_current_pagination() ); ?>

    </div>

<?php get_footer(); ?>