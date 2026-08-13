<?php get_header(); ?>

<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<input type="hidden" name="action" value="cabinet_contact_submit">
	<?php wp_nonce_field( 'cabinet_contact_action', 'cabinet_contact_nonce' ); ?>
	<input type="text" name="name" placeholder="Your Name" required>
	<input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" placeholder="Your Message" required></textarea>
	<button type="submit">Envoyer</button>
</form>

<?php if ( isset( $_GET['contact'] ) ) : ?>
    <?php if ( $_GET['contact'] === 'success' ) : ?>
        <p>Votre message a bien été envoyé.</p>
    <?php else : ?>
        <p>Une erreur est survenue, merci de réessayer.</p>
    <?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>
