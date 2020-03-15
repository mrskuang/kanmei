<?php
        /**
         * author kzb
         * time 2020-1-6
         *
         */
        $imgs=$_GET['imgs'];
        function thumb($img_addr,$width,$hight,$path='',$filename=''){
                list($w,$h,$type) = getimagesize($img_addr);

                $types = [
                    1 => 'gif',
                    2 => 'jpeg',
                    3 => 'png'
                ];
                $desc_str = "imagecreatefrom".$types[$type];
                $desc_img = $desc_str($img_addr);

                $img_new = imagecreatetruecolor($width,$hight);
                //imagecolorallocate 为一幅图像分配颜色
                $white = imagecolorallocate($img_new,255,255,255);
                //imagecolorallocate 为一幅图像分配颜色 + alpha(透明度)
                //$white = imagecolorallocatealpha($img_new,255,255,255,100);
                imagefill($img_new,0,0,$white);

                imagecopyresized($img_new,$desc_img,0,0,0,0,$width,$hight,$w,$h);

                header("Content-Type:image/png");
                //	imagepng($img_new,'thumb_hahah.png'); //保存
                imagepng($img_new); //输出

                //8. 释放内存
                imagedestroy($img_new);
        }

        echo thumb($imgs,150,102);
?>
