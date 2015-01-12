<?php

class CircleCrop{

    /**
     * Genera imagenes circulares con transparencia en png
     * @param   string  $tempfile       la ruta a la imagen a transformar
     * @param   string  $outfile        la ruta de salida para la imagen circular
     * @author Ramon <ramon.lozano@corb.mx>
     */
    public static function circleCropImage($tempfile,$outfile){
        $circle = new Imagick();
        $imagick = new Imagick();
        $imagick->readImage($tempfile);

        $w = $imagick->getImageWidth();
        $h = $imagick->getImageHeight();
        

        if($w < $h){
            $h = $w;
        }else{
            $w = $h;
        }
        $x = 0;
        $y = 0;
        $circle->newImage($w,$h, 'none');
        $circle->setimageformat('png');
        $circle->setimagematte(true);
        $draw = new \ImagickDraw();
        $draw->setfillcolor('#ffffff');
        $draw->circle($w/2, $h/2, $w/2, $w);
        $circle->drawimage($draw);

        
        $imagick->setImageFormat( "png" );
        $imagick->setimagematte(true);
        $imagick->cropimage($w, $h, $x, $y);
        $imagick->compositeimage($circle, Imagick::COMPOSITE_DSTIN, 0, 0);
        $imagick->writeImage($outfile);
        $imagick->destroy();
    }
    
    public function __construct(){}
}
?>