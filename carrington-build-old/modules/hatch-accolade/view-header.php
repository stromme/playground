<?php
/**
 * Description: Accolade Module - header style.
 * A module to display accolade.
 *
 * @package
 * @subpackage
 * @since
 */
?>
  <div id="<?=$id?>" class="<?=(count($chosen_accolade)>1)?'carousel-'.$id:''?> accolade-carousel slide">
    <?php if(count($chosen_accolade)>1){ ?>
    <div class="carousel-inner">
    <?php } ?>
      <?php
        $i = 0;
        foreach($chosen_accolade as $d){
          if(count($chosen_accolade)>1){
      ?>
      <div class="<?=($i==0)?'active ':''?>item">
        <?php } ?>
        <div class="row-middle center-align bumper-bottom">
        <?php if($d['image']!=''){ ?>
        <div class="middle-fixed-small bumper-right">
          <img src="<?=$d['image']?>" width="150">
        </div>
        <?php } ?>
        <div class="middle">
          <h2><?=$d['title']?></h2>
        </div>
        </div>
      <?php if(count($chosen_accolade)>1){ ?>
      </div>
      <?php
          }
          $i++;
        }
      ?>
    <?php if(count($chosen_accolade)>1){ ?>
    </div>
    <?php } ?>
    <?php if(count($chosen_accolade)>1){ ?>
    <a class="carousel-control left" href="#<?=$id?>" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#<?=$id?>" data-slide="next">&rsaquo;</a>
    <?php } ?>
  </div>

<div class="pen-stroke"></div>
<?=$js_init?>