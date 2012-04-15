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

<div class="row">
	<div class="span9">
		<?php if ($comments) : /* If there are comments */?>
			<h2 id="comments"><?php comments_number('Pas de commentaires', 'Un commentaire', '% commentaires');?> </h2>
			<p>
				<?php foreach ($comments as $comment) : /* Loop through comments */ ?>
					<?php 
						$isByAuthor = false;
						if($comment->comment_author_email == get_the_author_email()) {
						$isByAuthor = true;
					}?>
					<div class="row">
						<div class="span1">
							<?php echo get_avatar( $comment, $size = '55' ); ?>
						</div>
						<div class="span8">
							<blockquote>
								<?php if ($comment->comment_approved == '0') : ?>
									<span class="label label-warning pull-right">Votre commentaire est en attente de mod&eacute;ration</span>
								<?php endif; ?>
							  <p><?php comment_text() ?></p>
							  <small><a href="<?php comment_author_url(); ?>" target="_blank"><?php comment_author(); ?></a>, le 
							  	<?php comment_date('j F Y') ?> &agrave; <?php comment_time('H:m') ?></small>
							  </blockquote>
						</div>	
					</div>
				<?php endforeach; /* end for each comment */ ?>
			</p>
			<hr>
		<?php else : // this is displayed if there are no comments so far ?>
		<?php endif; /* end if comments */ ?>
		<?php if ('open' != $post->comment_status) : // comments are closed ?>
			<span class="label label-important pull-right">Les commentaires sont ferm&eacute;s</span>
	 	<?php else : // comments are opened ?>
			<div class="row">
				<div class="span9">
					<form class="well" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
						<h3>Laissez un commentaire</h3>
						<?php if ( $user_ID ) : ?>
							<p>Connect&eacute; en tant que <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Se d&eacute;connecter">Se d&eacute;connecter &raquo;</a></p>
						<?php else : ?>
							<p>Ajoutez votre commentaire ci-dessous, ou cr&eacute;ez un <a href="<?php trackback_url(true); ?>" rel="trackback">r&eacute;trolien</a> depuis votre site. Vous pouvez &eacute;galement <?php comments_rss_link('souscrire &agrave; ces commentaires'); ?> par RSS. Merci de vous conformer &agrave la netetiquette.</p>
							<label>Nom <?php if ($req) echo "(requis)"; ?></label>
							<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" class="span4" tabindex="1"/>
							<label >Courriel (ne sera pas visible) <?php if ($req) echo "(requis)"; ?></label>
							<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" class="span4" tabindex="2" />
							<label>Site web (optionnel)</label>
							<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" class="span4" tabindex="3" />
						<?php endif; ?>
						<label>Votre commentaire</label>
						<textarea name="comment" id="comment" class="span8" rows="15" tabindex="4"></textarea>
						<p>Vous pouvez utiliser ces balises :<br/><code><?php echo allowed_tags(); ?></code></p>
					  <button type="submit" id="submit" class="btn btn-primary" tabindex="5"><i class="icon-ok icon-white"></i> Envoyer</button>
						<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
						<?php do_action('comment_form', $post->ID); ?>
					</form>
				</div>
			</div>
			
		<?php endif; /* end if comments opened */ ?>
	</div>
</div>
	

	


