<?php

/***************************************

 Han-Kwang Nienhuys' PHP captcha
 Copyright June 2006
 This file may be distributed, modified, and used freely as long as
 this copyright message is preserved.
 
 Yet another captcha implementation in PHP.  This one is written with
 the current state of captcha-defeating research in mind. Apart from a
 letter distortion that is more advanced than just rotating the
 letters, the clutter is designed to make segmentation of the image
 into separate letter glyphs hard to do automatically.

 The 5-letter code is stored into the PHP session variable
 $_SESSION['captcha_string']; see the examples example.html and verify.php.
 
***************************************/


// CONFIG
$font = "include/VeraSeBd.ttf";
$fontsize = 27;
$signature = "lanaicmslanaicmslanaicmslanaicmslanaicms";
$perturbation = 1; // bigger numbers give more distortion; 1 is standard
// END CONFIG

session_start(); 

// generate  5 letter random string
$rand = "";
// some easy-to-confuse letters taken out C/G I/l Q/O h/b 
$letters = "ABDEFHKLMNOPRSTUVWXZabdeghikmnoprsuvwxyz";
for ($i = 0; $i < 5; ++$i) {
  $rand .= substr($letters, rand(0,strlen($letters)-1), 1);
 }


// create the hash for the random number and put it in the session
$_SESSION['captcha'] = strtolower($rand);

$imgwid = 160;
$imghgt = 50;
$ncols = 30; // foreground or background cols

// create the image 
$image = imagecreate($imgwid, $imghgt); 
$bgColor = imagecolorallocatealpha ($image, 255, 255, 255, 100);


function frand()
{
  return 0.0001*rand(0,9999);
}

// approximately ($i-1)/($n-1)
function prand($i, $n)
{
  if ($n <= 1)
    return frand();
  else
    return ($i-1+0.25*(frand()-0.5))/($n-1);
}

// return norm of vector. Adjust it upward for norm>0.2;
function kscale($a, $b)
{
  $norm = sqrt($a*$a + $b*$b);
  return pow($norm, 1.3);
}
   

// transformation with a distortion field consisting of a few
// sinus functions with different periods, amplitudes, and phases.
// p=perturbation (0<p<1)
function transform_image($img, $p)
{
  $sx = imagesx($img);
  $sy = imagesy($img);

  // copy into $img2
  $img2 = imagecreate($sx, $sy);
  imagepalettecopy($img2, $img);    
  imagecopy($img2, $img, 0,0 ,0,0, $sx, $sy);

  // x and y distortion: a couple of fourier components
  $kmin = 0.05;
  $kmax = 0.4*$p;
  $nfreq = 2;
  $maxamp = 0.2*$p; // relative to frequency
  for ($i = 1; $i <= $nfreq; ++$i) {
    $kxx[$i] = $kmin * exp(prand($i, $nfreq)*(log($kmax/$kmin)));
    $kxy[$i] = $kmin * exp(prand($i, $nfreq)*(log($kmax/$kmin)));
    $kyx[$i] = $kmin * exp(prand($i, $nfreq)*(log($kmax/$kmin)));
    $kyy[$i] = $kmin * exp(prand($i, $nfreq)*(log($kmax/$kmin)));
  }
  for ($i = 1; $i <= $nfreq; ++$i) {
    for ($j = 1; $j <= $nfreq; ++$j) {
      $cofsx[$i][$j] = $maxamp/kscale($kxx[$i], $kxy[$j])*(0.5*frand()+0.5);
      $cofsy[$i][$j] = $maxamp/kscale($kyx[$i], $kyy[$j])*(0.5*frand()+0.5);
    }
  }
  // sine tables
  for ($i = 1; $i <= $nfreq; ++$i) {
    $phix = 6.28*frand();
    $phiy = 6.28*frand();
    for ($x = 0; $x < $sx; ++$x) {
      $sinxx[$x][$i] = sin($x*$kxx[$i] + $phix);
      $sinyx[$x][$i] = sin($x*$kyx[$i] + $phiy);
    }
    $phix = 6.28*frand();
    $phiy = 6.28*frand();
    for ($y = 0; $y < $sy; ++$y) {
      $sinxy[$y][$i] = sin($y*$kxy[$i] + $phix);
      $sinyy[$y][$i] = sin($y*$kyy[$i] + $phiy);
    }
  }

  $bgc = imagecolorat($img, 1, 1); // background color
  // copy bitwise back into $img
  $hx = $sx/2; $hy = $sy/2;
  for ($x = 0; $x < $sx; ++$x) {
    for ($y = 0; $y < $sy; ++$y) {
      $dx = 0;
      $dy = 0;
      for ($i = 1; $i <= $nfreq; ++$i)
	for ($j = 1; $j <= $nfreq; ++$j) {
	  $dx += $cofsx[$i][$j]*$sinxx[$x][$i]*$sinxy[$y][$j];
	  $dy += $cofsy[$i][$j]*$sinyx[$x][$i]*$sinyy[$y][$j];
	}
      $x2 = $x + $dx;
      $y2 = $y + $dy;
      $c = $bgc;
      if ($x2 >= 0 && $x2 < $sx && $y2 >= 0 && $y2 < $sy)
	$c = imagecolorat($img2, $x2, $y2);
      imagesetpixel($img, $x, $y, $c);
    }
  }
  imagedestroy($img2);
}


// wiggly random line centered at specified coordinates
function randomline($img, $col, $x, $y, $longhorizflag)
{
  if ($longhorizflag) {
    $theta = 0;
    $len = rand(100, 150);
    $lwid = rand(1, 2);
  } else {
    $theta = (frand()-0.5)*M_PI*0.5;
    $len = rand(25,45);
    $lwid = floor(rand(2, 5)/2);
  }
  $k = frand()*0.6+0.2; $k = $k*$k*0.5;
  $phi = frand()*6.28;
  $step = 0.5;
  $dx = $step*cos($theta);
  $dy = $step*sin($theta);
  $n = $len/$step;
  $amp = 3*frand()/($k+5.0/$len);
  $x0 = $x - 0.5*$len*cos($theta);
  $y0 = $y - 0.5*$len*sin($theta);

  $ldx = round(-$dy*$lwid);
  $ldy = round($dx*$lwid);
  for ($i = 0; $i < $n; ++$i) {
    $x = $x0+$i*$dx + $amp*$dy*sin($k*$i*$step+$phi);
    $y = $y0+$i*$dy - $amp*$dx*sin($k*$i*$step+$phi);
    imagefilledrectangle($img, $x, $y, $x+$lwid, $y+$lwid, $col);
  }
}


// create string in random orientation, into supplied image
// font is truetype fontfile
function warped_string($img, $font, $color, $string) {

  // put string centered into block
  $sx = imagesx($img);
  $sy = imagesy($img);
  global $fontsize;
  $bb = imageftbbox($fontsize, 0, $font, $string);
  $tx = $bb[4]-$bb[0];
  $ty = $bb[5]-$bb[1];
  $x = floor($sx/2 - $tx/2 - $bb[0]);
  $y = round($sy/2 - $ty/2 - $bb[1]);
  imagettftext($img, $fontsize, 0, $x, $y, $color, $font, strtolower($string));

  // warp
  global $perturbation;
  transform_image($img, $perturbation);
  // wiggly lines
  for ($i = 0; $i <7; ++$i) {
      if ($i != 4) {
	  $x = $sx/2 + 50*floor($i/3-1) + rand(-10,10);
	  $y = $sy/2 + 20*floor($i%3-1) + rand(-5,5);
	  //randomline($img, $color, $x, $y, 0);
      } else {
	  $x = $sx/2;
	  $y = $sy/2 +rand(-2,2);
	  randomline($img, $color, $x, $y, 1);

      }
  }

}

function add_text($img, $string)
{
  $cmtcol = imagecolorallocatealpha ($img, 180, 180, 180, 0);
  for ($i=0;$i<10;$i++){
  imagestring($img, 1, 1, ($i*5), $string, $cmtcol);
  }
  
}

// write the random string
add_text($image, $signature);
$col = imagecolorallocate($image, rand(100,200), rand(100,200), rand(100,200));
warped_string($image, $font, $col, $rand);


//imagerectangle ($image, 0, 0, 159, 49, 255 );

// send several headers to make sure the image is not cached     
header("Expires: Tue, 11 Jun 1985 05:00:00 GMT");  
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");  
header("Cache-Control: no-store, no-cache, must-revalidate");  
header("Cache-Control: post-check=0, pre-check=0", false);  
header("Pragma: no-cache");      
header('Content-type: image/png'); 

// send the image to the browser 
imagepng($image); 

// destroy the image to free up the memory 
imagedestroy($image); 
?>
