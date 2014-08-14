<?php
$o_w = intval($_GET['w']);
$o_h = intval($_GET['h']);
$w = $h = 1;
if($o_w>$o_h){
  $w = round($o_w/$o_h, 3);
}
else {
  $h = round($o_h/$o_w, 3);
}
$smallest = false;
for($i=1;$i<=100 && !$smallest;$i++){
  $wi = $w*$i;
  $hi = $h*$i;
  $fwi = floor($wi);
  $fhi = floor($hi);
  if($wi<=($fwi+0.01) && $hi<=($fhi+0.01)){
    $smallest = $i;
    $w = $fwi;
    $h = $fhi;
    //if($o_w>$o_h && $fhi>=50){$h-=1;}// && $fhi>30 && $wi>($fwi+0.00)) $h-=2;
  }
}
if(!$smallest){
  $w = $o_w;
  $h = $o_h;
}
$im = imagecreatetruecolor($w, $h);
$fg = imagecolorallocate($im, 0, 0, 0);
imagecolortransparent($im, $fg);
header('Content-Type: image/gif');
header('Content-Disposition: inline; filename=spacer.gif');
imagegif($im);
imagedestroy($im);