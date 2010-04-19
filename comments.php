<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">Cet article est priv&eacute;. Saisissez le mot de passe pour voir les commentaires.</p>

			<?php
			return;
		}
	}

?>

<!-- You can start editing here. -->


<?php if ($comments) : ?>
	<h3 id="comments"><?php comments_number('Pas de commentaires', 'Un commentaire', '% commentaires');?> <a href="#respond" title="<?php _e("Laisser un commentaire"); ?>">&raquo;</a></h3>
<ul class="commentlist">

	<?php foreach ($comments as $comment) : ?>
	
<?php
$isByAuthor = false;
if($comment->comment_author_email == get_the_author_email()) {
$isByAuthor = true;
}?>
		<div class="commentlist">

		<li id="comment-<?php comment_ID() ?>" <?php if($isByAuthor ) { echo 'class="my_comment"';} ?>>

		<div class="clearfloat">

		<?php echo get_avatar( $comment, $size = '55' ); ?>
	

			<div class="commenttext">
			<cite><strong><a href="<?php comment_author_url(); ?>" target="_blank"> <?php comment_author(); ?></a></strong> a dit: </cite>

			<?php if ($comment->comment_approved == '0') : ?>
			<em>Votre commentaire est en attente de mod&eacute;ration.</em>
			<?php endif; ?>
			<?php comment_text() ?>
			</div>	

	
		</div>
		
		<div class="commentmetadata">Post&eacute; le <?php comment_date('j F Y') ?> &agrave; <?php comment_time('H:m') ?> </div>
		</li>


	<?php endforeach; /* end for each comment */ ?>
</ul>
	

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Les commentaires sont ferm&eacute;.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>


<h3 id="respond">Laissez un commentaire</h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>Vous devez etre <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">connect&eacute;</a> pour laisser un commentaire.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Connect&eacute; en tant que <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Se d&eacute;connecter">Se d&eacute;connecter &raquo;</a></p>

<?php else : ?>

<p>Ajoutez votre commentaire ci-dessous, ou cr&eacute;ez un <a href="<?php trackback_url(true); ?>" rel="trackback">r&eacute;trolien</a> depuis votre site. Vous pouvez &eacute;galement <?php comments_rss_link('souscrire &agrave; ces commentaires'); ?> par RSS.</p>

<p>Merci de vous conformer &agrave la netetiquette.</p>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" class="field" />
<label for="author"><small>Nom <?php if ($req) echo "(requis)"; ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" class="field" />
<label for="email"><small>Courriel (ne sera pas visible) <?php if ($req) echo "(requis)"; ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" class="field" />
<label for="url"><small>Site web (optionnel)</small></label></p>

<?php endif; ?>

<p><textarea name="comment" id="comment" cols="100%" rows="15" tabindex="4"></textarea></p>
<p>Vous pouvez utiliser ces balises :<br/><code><?php echo allowed_tags(); ?></code></p>


<p><input name="submit" class="searchbutton" type="submit" id="submit" tabindex="5" value="Envoyer" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; ?>


