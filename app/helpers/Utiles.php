<?php
trait Utiles{
    public static function arrayRecursiveDiff($aArray1, $aArray2) {
        if($aArray2 === NULL){
            $aArray2 = array();
        }
        $aReturn = array();
             foreach ($aArray1 as $mKey => $mValue) {
                 if (array_key_exists($mKey, $aArray2)) {
                if (is_array($mValue)) {
                    $aRecursiveDiff = Utiles::arrayRecursiveDiff($mValue, $aArray2[$mKey]);
                    if (count($aRecursiveDiff)) { 
                        $aReturn[$mKey] = $aRecursiveDiff; 
                    }
                } else {
                    if ($mValue != $aArray2[$mKey]) {
                     $aReturn[$mKey] = $mValue;
                    }
                }
            } else {
                $aReturn[$mKey] = $mValue;
            }
        }
        return $aReturn;
    } 

    public function actializarPivote ( $tabla , $columna , $id , $valores ) {
        DB::table( $tabla )->where( $columna , '=' , $id )->update( $valores );
    }
}

?>