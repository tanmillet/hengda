<?php
namespace  Traits;

/**
 * Created by PhpStorm.
 * User: Terry Lucas
 * Date: 2017/7/4
 * Time: 15:38
 */
class ResizeImage
{
    public $type;//图片类型
    public $width;//实际宽度
    public $height;//实际高度
    public $resize_width;//改变后的宽度
    public $resize_height;//改变后的高度
    public $cut;//是否裁图
    public $srcimg;//源图象
    public $dstimg;//目标图象地址
    public $im;//临时创建的图象
    public $quality;//图片质量
    public $typeimg = [1 => 'gif', 2 => 'jpg', 3 => 'png', 6 => 'bmp'];

    public function __construct($img, $wid, $hei, $c, $dstpath, $quality = 100)
    {
        $this->srcimg = $img;
        $this->resize_width = $wid;
        $this->resize_height = $hei;
        $this->cut = $c;
        $this->quality = $quality;
        // $this->type = strtolower(substr(strrchr($this->srcimg, '.'), 1));//图片的类型
        $types = getimagesize($this->srcimg);
        if(isset($types[2]) && isset($this->typeimg[$types[2]])){
            $this->type = $this->typeimg[$types[2]];//图片的类型
        } else{
            throw new  \Exception('图片格式不正确！');
        }
        $this->initi_img();//初始化图象
        $this->dst_img($dstpath);//目标图象地址
        @$this->width = imagesx($this->im);
        @$this->height = imagesy($this->im);
        $this->newimg();//生成图象
        @ImageDestroy($this->im);
    }

    public function newimg()
    {
        $img_func = '';
        $resize_ratio = ($this->resize_width) / ($this->resize_height);//改变后的图象的比例
        @$ratio = ($this->width) / ($this->height);//实际图象的比例
        if (($this->cut) == '1') {//裁图
            if ($img_func === 'imagepng' && (str_replace('.', '', PHP_VERSION) >= 512)) {    //针对php版本大于5.12参数变化后的处理情况
                $quality = 9;
            }
            if ($ratio >= $resize_ratio) {//高度优先
                $newimg = imagecreatetruecolor($this->resize_width, $this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, $this->resize_height, (($this->height) * $resize_ratio), $this->height);
                imagejpeg($newimg, $this->dstimg, $this->quality);
            }
            if ($ratio < $resize_ratio) {//宽度优先
                $newimg = imagecreatetruecolor($this->resize_width, $this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, $this->resize_height, $this->width, (($this->width) / $resize_ratio));
                imagejpeg($newimg, $this->dstimg, $this->quality);
            }
        } else {//不裁图
            if ($ratio >= $resize_ratio) {
                $newimg = imagecreatetruecolor($this->resize_width, ($this->resize_width) / $ratio);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, ($this->resize_width) / $ratio, $this->width, $this->height);
                imagejpeg($newimg, $this->dstimg, $this->quality);
            }
            if ($ratio < $resize_ratio) {
                @$newimg = imagecreatetruecolor(($this->resize_height) * $ratio, $this->resize_height);
                @imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, ($this->resize_height) * $ratio, $this->resize_height, $this->width, $this->height);
                @imagejpeg($newimg, $this->dstimg, $this->quality);
            }
        }
    }

    public function initi_img()
    {//初始化图象
        if ($this->type == 'jpg' || $this->type == 'jpeg') {
            $this->im = @imagecreatefromjpeg($this->srcimg);
        }
        if ($this->type == 'gif') {
            $this->im = @imagecreatefromgif($this->srcimg);
        }
        if ($this->type == 'png') {
            $this->im = @imagecreatefrompng($this->srcimg);
        }
        if ($this->type == 'wbm') {
            @$this->im = @imagecreatefromwbmp($this->srcimg);
        }
        if ($this->type == 'bmp') {
            $this->im = $this->ImageCreateFromBMP($this->srcimg);
        }
    }

    public function dst_img($dstpath)
    {//图象目标地址
        $full_length = strlen($this->srcimg);
        $type_length = strlen($this->type);
        $name_length = $full_length - $type_length;
        $name = substr($this->srcimg, 0, $name_length - 1);
        $this->dstimg = $dstpath;
    }

    public function ImageCreateFromBMP($filename)
    {    //自定义函数处理bmp图片
        if (!$f1 = fopen($filename, "rb")) returnFALSE;
        $FILE = unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread($f1, 14));
        if ($FILE['file_type'] != 19778) returnFALSE;
        $BMP = unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel' .
            '/Vcompression/Vsize_bitmap/Vhoriz_resolution' .
            '/Vvert_resolution/Vcolors_used/Vcolors_important', fread($f1, 40));
        $BMP['colors'] = pow(2, $BMP['bits_per_pixel']);
        if ($BMP['size_bitmap'] == 0) $BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];
        $BMP['bytes_per_pixel'] = $BMP['bits_per_pixel'] / 8;
        $BMP['bytes_per_pixel2'] = ceil($BMP['bytes_per_pixel']);
        $BMP['decal'] = ($BMP['width'] * $BMP['bytes_per_pixel'] / 4);
        $BMP['decal'] -= floor($BMP['width'] * $BMP['bytes_per_pixel'] / 4);
        $BMP['decal'] = 4 - (4 * $BMP['decal']);
        if ($BMP['decal'] == 4) $BMP['decal'] = 0;
        $PALETTE = array();
        if ($BMP['colors'] < 16777216) {
            $PALETTE = unpack('V' . $BMP['colors'], fread($f1, $BMP['colors'] * 4));
        }
        $IMG = fread($f1, $BMP['size_bitmap']);
        $VIDE = chr(0);
        $res = imagecreatetruecolor($BMP['width'], $BMP['height']);
        $P = 0;
        $Y = $BMP['height'] - 1;
        while ($Y >= 0) {
            $X = 0;
            while ($X < $BMP['width']) {
                if ($BMP['bits_per_pixel'] == 24)
                    $COLOR = unpack("V", substr($IMG, $P, 3) . $VIDE);
                elseif ($BMP['bits_per_pixel'] == 16) {
                    $COLOR = unpack("n", substr($IMG, $P, 2));
                    $COLOR[1] = $PALETTE[$COLOR[1] + 1];
                } elseif ($BMP['bits_per_pixel'] == 8) {
                    $COLOR = unpack("n", $VIDE . substr($IMG, $P, 1));
                    $COLOR[1] = $PALETTE[$COLOR[1] + 1];
                } elseif ($BMP['bits_per_pixel'] == 4) {
                    $COLOR = unpack("n", $VIDE . substr($IMG, floor($P), 1));
                    if (($P * 2) % 2 == 0) $COLOR[1] = ($COLOR[1] >> 4); else$COLOR[1] = ($COLOR[1] & 0x0F);
                    $COLOR[1] = $PALETTE[$COLOR[1] + 1];
                } elseif ($BMP['bits_per_pixel'] == 1) {
                    $COLOR = unpack("n", $VIDE . substr($IMG, floor($P), 1));
                    if (($P * 8) % 8 == 0) $COLOR[1] = $COLOR[1] >> 7;
                    elseif (($P * 8) % 8 == 1) $COLOR[1] = ($COLOR[1] & 0x40) >> 6;
                    elseif (($P * 8) % 8 == 2) $COLOR[1] = ($COLOR[1] & 0x20) >> 5;
                    elseif (($P * 8) % 8 == 3) $COLOR[1] = ($COLOR[1] & 0x10) >> 4;
                    elseif (($P * 8) % 8 == 4) $COLOR[1] = ($COLOR[1] & 0x8) >> 3;
                    elseif (($P * 8) % 8 == 5) $COLOR[1] = ($COLOR[1] & 0x4) >> 2;
                    elseif (($P * 8) % 8 == 6) $COLOR[1] = ($COLOR[1] & 0x2) >> 1;
                    elseif (($P * 8) % 8 == 7) $COLOR[1] = ($COLOR[1] & 0x1);
                    $COLOR[1] = $PALETTE[$COLOR[1] + 1];
                } else
                    returnFALSE;
                imagesetpixel($res, $X, $Y, $COLOR[1]);
                $X++;
                $P += $BMP['bytes_per_pixel'];
            }
            $Y--;
            $P += $BMP['decal'];
        }
        fclose($f1);
        return $res;
    }

    // echo imageNewageUpdateSize("./imageNewages/leyangjun.jpg",400,400,"ss_");  //你自己要添加的图片
    /**
     * 等比缩放函数（以保存的方式实现）
     * @param string $picName 被缩放的处理图片源
     * @param int $maxx 缩放后图片的最大宽度
     * @param int $maxy 缩放后图片的最大高度
     * @param string $pre 缩放后图片名的前缀名
     * @return String 返回后的图片名称(带路径)，如a.jpg=>s_a.jpg
     */
    function imageNewageUpdateSize($picName, $maxx = 100, $maxy = 100, $pre = "s_")
    {
        $imageNewageInfo = getimageNewageSize($picName); //获取图片的基本信息

        $w = $imageNewageInfo[0];//获取宽度
        $h = $imageNewageInfo[1];//获取高度

        //获取图片的类型并为此创建对应图片资源
        switch ($imageNewageInfo[2]) {
            case 1: //gif
                $imageNew = imageNewagecreatefromgif($picName);
                break;
            case 2: //jpg
                $imageNew = imageNewagecreatefromjpeg($picName);
                break;
            case 3: //png
                $imageNew = imageNewagecreatefrompng($picName);
                break;
            default:
                die("图片类型错误！");
        }

        //计算缩放比例
        if (($maxx / $w) > ($maxy / $h)) {
            $b = $maxy / $h;
        } else {
            $b = $maxx / $w;
        }

        //计算出缩放后的尺寸
        $nw = floor($w * $b);
        $nh = floor($h * $b);

        //创建一个新的图像源(目标图像)
        $nimageNew = imageNewagecreatetruecolor($nw, $nh);

        //执行等比缩放
        imageNewagecopyresampled($nimageNew, $imageNew, 0, 0, 0, 0, $nw, $nh, $w, $h);

        //输出图像（根据源图像的类型，输出为对应的类型）
        $picimageNewageInfo = pathimageNewageInfo($picName);//解析源图像的名字和路径信息
        $newpicName = $picimageNewageInfo["dirname"] . "/" . $pre . $picimageNewageInfo["basename"];
        switch ($imageNewageInfo[2]) {
            case 1:
                imageNewagegif($nimageNew, $newpicName);
                break;
            case 2:
                imageNewagejpeg($nimageNew, $newpicName);
                break;
            case 3:
                imageNewagepng($nimageNew, $newpicName);
                break;
        }
        //释放图片资源
        imageNewagedestroy($imageNew);
        imageNewagedestroy($nimageNew);
        //返回结果
        return $newpicName;
    }

    /**
     * 为一张图片添加上一个logo图片水印（以保存的方式实现）
     * @param string $picName 被处理图片源
     * @param string $logo 水印图片
     * @param string $pre 处理后图片名的前缀名
     * @return String 返回后的图片名称(带路径)，如a.jpg=>n_a.jpg
     */
    function imageNewageUpdateLogo($picName, $logo, $pre = "n_")
    {
        $picNameimageNewageInfo = getimageNewageSize($picName); //获取图片源的基本信息
        $logoimageNewageInfo = getimageNewageSize($logo); //获取logo图片的基本信息
        //var_dump($logoimageNewageInfo);
        //根据图片类型创建出对应的图片源
        switch ($picNameimageNewageInfo[2]) {
            case 1: //gif
                $imageNew = imageNewagecreatefromgif($picName);
                break;
            case 2: //jpg
                $imageNew = imageNewagecreatefromjpeg($picName);
                break;
            case 3: //png
                $imageNew = imageNewagecreatefrompng($picName);
                break;
            default:
                die("图片类型错误！");
        }
        //根据logo图片类型创建出对应的图片源
        switch ($logoimageNewageInfo[2]) {
            case 1: //gif
                $logoimageNew = imageNewagecreatefromgif($logo);
                break;
            case 2: //jpg
                $logoimageNew = imageNewagecreatefromjpeg($logo);
                break;
            case 3: //png
                $logoimageNew = imageNewagecreatefrompng($logo);
                break;
            default:
                die("logo图片类型错误！");
        }


        //执行图片水印处理                    源图的高-logo图的高       源图的宽-logo图的宽
        imageNewagecopyresampled($imageNew, $logoimageNew, $picNameimageNewageInfo[0] - $logoimageNewageInfo[0], $picNameimageNewageInfo[1] - $logoimageNewageInfo[1], 0, 0, $logoimageNewageInfo[0], $logoimageNewageInfo[1], $logoimageNewageInfo[0], $logoimageNewageInfo[1]);

        //输出图像（根据源图像的类型，输出为对应的类型）
        $picimageNewageInfo = pathimageNewageInfo($picName);//解析源图像的名字和路径信息
        $newpicName = $picimageNewageInfo["dirname"] . "/" . $pre . $picimageNewageInfo["basename"];
        switch ($picNameimageNewageInfo[2]) {
            case 1:
                imageNewagegif($imageNew, $newpicName);
                break;
            case 2:
                imageNewagejpeg($imageNew, $newpicName);
                break;
            case 3:
                imageNewagepng($imageNew, $newpicName);
                break;
        }
        //释放图片资源
        imageNewagedestroy($imageNew);
        imageNewagedestroy($logoimageNew);
        //返回结果
        return $newpicName;
    }

    ////echo imageNewageUpdateLogo("./imageNewages/leyangjun.jpg","./imageNewages/logo.png");  //对应添加你的图片，和你的logo水印图片 OK
}