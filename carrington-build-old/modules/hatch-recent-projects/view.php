<?php if(count($recent_projects)>0){ ?>
<div class="row-fluid bumper-top-medium bumper-bottom-medium">
	<div class="span12">
		<<?=$heading?> class="blue center"><?=$title?></<?=$heading?>>
	</div>
</div>
<div class="row-fluid">
	<ul class="thumbnails">
    <?php
      $projects_url = get_home_url().'/projects/';
      foreach($recent_projects as $rel_prj){
    ?>
		<li class="span4 bg-white">
			<div class="thumbnail recent-projects">
         <div class="thumbnail-placeholder">
				  <img src="<?=$rel_prj->favorite_media->image_small[0]?>" />
         </div>
        <?php if(isset($rel_prj->reviews) && count($rel_prj->reviews)>0){ ?>
        <div class="customer-review">
          <h3>Customer reviewed</h3>
          <p>"<?=$rel_prj->reviews[0]->content?>"
          </p>
          <div class="author">
            <p><cite><?=$rel_prj->reviews[0]->name?></cite> &nbsp;<span class="review-rating" data-score="<?=$rel_prj->reviews[0]->rating?>"></span></p>
          </div>
        </div>
        <?php } ?>
				<div class="caption">
					<p><?=(strlen($rel_prj->content)>120)?(substr($rel_prj->content, 0, 120).'...'):($rel_prj->content)?></p>
					<a class="btn btn-primary btn-small" href="<?=$projects_url.$rel_prj->slug?>" target="_blank">Visit Showroom</a>
				</div>
			</div>
		</li>
     <?php  } ?>
	</ul>
</div>
<?php } ?>