<?php get_header(); ?>

<div style="border:1px solid #ccc; background:#f9f9f9; padding:10px; margin:15px 0; font-size:1rem; color:hotpink;">
  This template is index.php
</div>

<?php if (have_posts()): ?>
  <?php while (have_posts()): the_post(); ?>
    <article <?php post_class('article'); ?>>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

      <p class="meta">
        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
        <?php if (has_category()): ?> / <?php the_category(', '); ?><?php endif; ?>
      </p>

      <div class="entry-content">
        <?php the_excerpt(); ?>
      </div>
    </article>
  <?php endwhile; ?>

  <nav class="pagination">
    <?php next_posts_link(__('&larr; Older Posts', 'amarga-bone')); ?>
    <?php previous_posts_link(__('Newer Posts &rarr;', 'amarga-bone')); ?>
  </nav>

<?php else: ?>
  <p><?php _e('No posts found.', 'amarga-bone'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>
