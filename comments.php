<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		<p class="nocomments">This topic is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}

if ( have_comments() ) : 
	$order = get_option('comment_order');
	update_option('comment_order', 'asc');
	wp_list_comments( ); 
	update_option('comment_order', $order);
endif; ?>
</ol>

<?php if ( have_comments() ) : ?>
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
<?php endif; ?>


<?php if ( comments_open() ) : ?>
<div class="comments">
	
  <div id="respond" style="width:600px;text-align:left;position:relative;margin:0 auto;"> 
    <h3>
      <?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?>
    </h3>
    <div class="cancel-comment-reply"> <small>
      <?php cancel_comment_reply_link(); ?>
      </small> </div>
    <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
    <p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged 
      in</a> to post a comment.</p>
    <?php else : ?>
	
	
    <div style="width:500px;"> 
      <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="contact-form">
        <div style="width:100%;padding:10px;height:200px;">
         <strong><b>Enter Your Comment:</b> 
          <textarea name="comment" rows="" cols="" check="validate['required','length[10,-1]']"></textarea>
          </strong> 
          
    	<?php if ( !is_user_logged_in() ) : ?>
          <label><div>Enter Your Name:</div> 
          <input name="author" type="text" value="" check="validate['required','length[2,-1]','alpha']"/>
          </label>
          <label><div>Enter Your E-mail:</div> 
          <input name="email" type="text" value="" check="validate['required','email']" />
          </label>
          <label><div>Enter Your Website:</div> 
          <input name="url" type="text" value="" check="validate['url']" />
          </label>
        <?php endif; ?>
          <?php comment_id_fields(); ?>
          <?php do_action('comment_form', $post->ID); ?>
          <div class="clear"></div>
          <div style="width:100%;padding:10px;"> 
	          <strong><strong><a href="javascript: $('contact-form').submit();" id="submitbutton" check="validate['submit']">Submit</a></strong></strong> 
	          <strong><a href="#" id="resetbutton" onclick="document.getElementById('contact-form').reset()">Reset</a></strong> 
          </div>
          
		<?php if ( is_user_logged_in() ) : ?>
			<div style="width:100%;padding:10px;">
				<div class="clear"></div>
				<strong><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a></strong>
				<strong><a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></strong>
			</div>
		<?php endif; ?>
        </div>
      </form>
    </div>
  </div>


	<?php endif; // If registration required and not logged in ?>
	</div>

<?php endif; // if you delete this the sky will fall on your head ?>
