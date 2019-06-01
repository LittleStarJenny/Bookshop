<!DOCTYPE html>
<html>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
  <style type="text/css">
  </style>
  <?php wp_head(); ?>
</head>
<body <?php body_class(""); ?>>
  <div class='contain-to-grid sticky transparent'>
    <div class='title-area'>
      <h1>
        <a href='<?php echo home_url() ?>'>
          <?php
            $logo = get_option( 'site_logo', null );
            // blahlab_dump(get_option( 'site_logo' ));
          ?>
          <?php if (blahlab_value($logo, 'url')): ?>
            <img src="<?php echo blahlab_value($logo, 'url'); ?>" alt="">
          <?php else: ?>
            <?php echo get_bloginfo('name'); ?>
          <?php endif ?>
        </a>
      </h1>
    </div>
  </div>

  <nav class='big-nav' data-options='sticky_on: large' data-topbar=''>
    <?php
      wp_nav_menu(array(
        'theme_location' => 'header-menu',
        'menu_class' => '',
        'fallback_cb' => false,
        'container' => '',
        'depth' => 1,
        'walker' => new FadeInLeft_Menu_Walker()
      ));
    ?>
  </nav>



  <?php 
if(is_page(1)) {
 get_header('front');
}
else {
 get_header();
}
 wp_head(); ?>
<?php the_post(); ?>

<div class="full no-padding white">
  <div class="post single">
    <div class="top-section" style="background-image: url(<?php echo blahlab_value($bg) ?>)">
      <div class="row">
        //<div class="large-10 large-centered columns">
         // <p class='info wow slideInUp' data-wow-delay="0.3s">
          //  <span><?php echo get_the_date('M j, Y'); ?></span>
            /
            <span>
              by
             // <a href="#"><?php echo get_the_author() ?></a>
            </span>
<!--               /
            <span>
              In
              <?php echo get_the_category_list(', '); ?>
            </span>
            /
            <span>
            //  <?php comments_popup_link(__('Leave a comment', 'blahlab'), __('1 Comment', 'blahlab'), __('Comments %', 'blahlab')); ?>
            </span> -->
          </p>
          <h2 class="wow slideInUp" data-wow-delay="0.3s"><?php echo get_the_title(); ?></h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="large-10 large-centered columns">
        <?php the_content(); ?>
        <div class="tags">
          <?php echo the_tags(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if (comments_open() && get_comments_number() != 0): ?>
  <div class="full dark light">
    <div class="row">
      <div class="large-10 large-centered columns">
        <?php comments_template('', true); ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="full red">
  <div class="row">
    <?php if (comments_open()): ?>
      <div class="large-10 large-centered columns">
        <div class='four spacing'></div>
        <div id='comments-form'>
          <h2>Your comment</h2>
          <?php
            comment_form(
              array(
                'fields' => array(
                  'author' => '<p class="name"><input type="text" placeholder="Name" name="author" class="input-text required"></p>',
                  'email' => '<p class="email"><input type="text" placeholder="Email" name="email" class="input-text required"></p>',
                ),
                'comment_notes_before' => '',
                'comment_notes_after' => '',
                'comment_field' => '<p class="message"><textarea placeholder="Message" cols="80" rows="5" name="comment" class="required"></textarea><div class="spacing"></div>',
                'label_submit' => __('Send Message', 'blahlab'),
                'title_reply' => '',
                // 'title_reply_to' => ''
              )
            );
          ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>
