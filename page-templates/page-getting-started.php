<?php
//Template for "Getting Started" page (not listed)

if(!is_user_logged_in()){
  wp_redirect(home_url());
  exit;
}
if(!get_option('tb_getting_started')){
  wp_redirect(TOOLBOX_URL, 301);
  exit;
}
$gs = new TB_Getting_Started;
$count_steps = $gs->count_steps();
$current_step = $gs->get_current_step();
$current_step_name = $gs->get_current_step_name($current_step);
$step_data = $gs->get_steps_data($current_step);

?>
<!DOCTYPE html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php wp_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <!-- W3TC-include-css -->
  <!-- W3TC-include-js-head -->
	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
</head>

<body itemscope itemtype="http://schema.org/ProfessionalService" id="getting-started">

<div id="alert" class="container alert-fixed-top"></div>

<header>
  <span class="stepper">
    <span class="icon">
      <img src="<?=TOOLBOX_IMAGES.'/hatch-apple-touch-icon.jpg'?>" />
    </span>
    <span class="step"><?=$count_steps-$current_step+1?></span>
    <span class="clearfix"></span>
  </span>
  <span class="title">quick step<span class="plural">s</span> to go</span>
</header>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
      <div class="content-header">
        <div class="background">
          <h1 class="title"><?=($current_step==1)?'Welcome to Hatch':$step_data['title']?></h1>
          <p class="subtitle"><?=$step_data['subtitle']?></p>
        </div>
        <div class="triangle"><img src="<?=TOOLBOX_IMAGES?>/getting-started-triangle.jpg" /></div>
      </div>
      <div id="gs-<?=str_replace('_', '-', $current_step_name)?>" class="content-body">
        <div class="content">
          <?php get_template_part('templates/gs', str_replace('_', '-', $current_step_name)); ?>
        </div>
        <div class="content-footer rounded">
          <?php if(isset($step_data['skip']) && $step_data['skip']){ ?><a href="" id="go-skip" class="link pull-left" data-nonce="<?=wp_create_nonce('getting-started-'.date('Ymd'))?>">Skip</a><?php } ?>
          <a href="" id="go-next-step" data-step="<?=$current_step?>" data-nonce="<?=wp_create_nonce('getting-started-'.date('Ymd'))?>" class="btn btn-flat btn-green chevron pull-right disabled"><span class="text"><?=($current_step<$count_steps)?'Next':'Finish'?></span> <b class="tux-icon chevron"></b></a>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>


