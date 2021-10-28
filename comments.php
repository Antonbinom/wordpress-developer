<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments my-4">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
			<h3 class="mb-5">Комментарии:</h3>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list p-0">
			<?php
			wp_list_comments(
				array(
					'walker'     	=> new Bootsrap_Walker_Comment(),
					'max=depth'  	=> '2',
					'style'      	=> 'ol',
					'type'			 	=> 'all',
					'reply_text' 	=> __('Ответить <i class="fa fa-reply"></i>'),
					'per_page'	 	=> '10',
					'avatar_size'	=> '80',
					'format'			=> 'html5',
					'echo' 				=> 'true',
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wp_dev' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->

<div class="comments my-4">
</div>

<div class="mt-5 mb-3">
		<h3 class="mt-5 mb-2">Оставьте комментарий</h3>
		<p class="mb-4">Ваш E-mail защищен от спама</p>
		<form action="#" class="row">
				<div class="col-lg-12">
						<div class="form-group mb-3">
								<textarea cols="30" rows="6" class="form-control"  placeholder="Комментарий"></textarea>
						</div>
				</div>
				<div class="col-lg-6">
						<div class="form-group mb-3">
								<input type="text" class="form-control" placeholder="Имя">
						</div>
				</div>

				<div class="col-lg-6">
						<div class="form-group mb-4">
								<input type="email" class="form-control" placeholder="Email">
						</div>
				</div>

				<div class="col-lg-12">
						<a href="#" class="btn btn-hero btn-circled">Оставить комментарий</a>
				</div>
		</form>
</div>