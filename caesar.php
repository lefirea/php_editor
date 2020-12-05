<?php
        function caesar($text){
                $caetex = $text;
                for($i = 0; $i < strlen($text);$i++ ){
                        $ascii = ord($caetex[$i]);
                        if($ascii >= 32 && $ascii <= 126){
                                if($ascii == 126){
                                        $ascii = 32;
                                }
                        }
                        $ascii++;
                        $caetex[$i] = chr($ascii);
                }
                return $caetex;
        }

        function caesardec($text){
                $caetex = $text;
                for($i = 0; $i < strlen($text);$i++ ){
                        $ascii = ord($caetex[$i]);
                        if($ascii >= 32 && $ascii <= 126){
                                if($ascii == 32){
                                        $ascii = 126;
                                }else{
                                        $ascii--;
                                }
                        }else{
                                $ascii = $ascii;
                        }
                        
                        $caetex[$i] = chr($ascii);
                }
                return $caetex;
        }
?>