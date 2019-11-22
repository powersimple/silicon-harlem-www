<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Metrika
 */
?>
<?php $metrika_options = get_option('metrika_theme_options'); ?>
<?php if ($metrika_options['menu_type'] == 'no') : ?>
    <footer class="default-footer">
        <div class="container">
          <?php
          echo '<p>' . $metrika_options['copyright'] . ', ' . date('Y') . '</p>';
          ?>
        </div>
    </footer>
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>