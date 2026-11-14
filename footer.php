</main>

<?php get_template_part('template-parts/footer-bottom-area-main', null, $args); ?>

<div class="desktop">
    <?php get_template_part('template-parts/footer-bottom-bar', null, $args); ?>
</div>

<div class="mobile">
    <?php get_template_part('template-parts/footer-bottom-bar-mobile', null, $args); ?>
</div>

<div class="mobile-s">
    <?php get_template_part('template-parts/footer-bottom-bar-mobile', null, $args); ?>
</div>

<?php wp_footer(); ?>
</body>
</html>