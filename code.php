<?php
//captcha验证码
 $w = 150;
 $h = 50;
//创建真彩图片
 $img = imagecreatetruecolor($w,$h);
 //背景颜色
 $white = imagecolorallocate($img,255,255,255);

  $textcolor = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));

 //在制定图片画矩形
 imagefilledrectangle($img, 0 , 0 , $w , $h , $white);

 function random_str(){
        $str = "abcdefghigklmnopqrstuvwxyz1234567890";

        $reg = '/[a-z]{1}/';

        $len = strlen($str);
        for($i=0;$i<$len-1;$i++){
            if(preg_match($reg,$str)){
                $i = rand(0,$len-1);
                $str[$i] = strtoupper($str[$i]);
            }
        }
        $shuffle = str_shuffle($str); //随机打乱一个字符串
        $new_str = substr($shuffle,0,4);
        return $new_str;
    }


    $str=random_str();


    $fontsize = 30;
    for($i=0;$i<strlen($str);$i++){

        $color = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));

        //定义字符Y坐标
        $y= ($h+15)/2 + rand(-1,1);

        //定义字符X坐标
        $x = $i*30+8;

        imagettftext($img,$fontsize,rand(-30,30),$x,$y,$color,'./lib/texb.ttf',$str[$i]);
    }


     //6.画点
    for($i=0;$i<50;$i++){
        $potcolor = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
        //imagesetpixel($img,rand(0,$width),rand(0,$height),$potcolor);
        //原点
        imagefilledellipse($img,rand(0,$w),rand(0,$h),rand(1,3),rand(1,3),$potcolor);

    }
     //7.划线
    for($i=0;$i<5;$i++) {
        $linecolor = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));

        imageline($img,rand(0,$w),rand(0,$h),rand($w,$w),rand(0,$h),$linecolor);
    }


     session_start();
     $_SESSION['code']=strtolower($str);
     header('Content-Type:image/jpeg');
     imagejpeg($img);
     imagedestroy($img);







