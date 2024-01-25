<?php

    namespace CG\FVSS;
    
    class Fvss {

        public function validate($data){
            $status     = true;
            $message    = null;

            foreach($data as $key => $val){
                $value  = $val["value"];

                if(isset($val["length"]) && $val["length"] && !empty($val["length"])){
                    if(strlen($val["value"]) < $val["length"]){
                        $status     = false;
                        $message    = (isset($val["label"]) ? $val["label"] : ucwords($value)) . " must be at least ". $val["length"] ." characters long";
                    }
                }
                
                if(isset($val["space"]) && $val["space"] && !empty($val["space"])){
                    $value  = preg_replace("/[ \t\n\f]+/", "", $value);
                }
                
                if(isset($val["punct"]) && $val["punct"] && !empty($val["punct"])){
                    $value  = preg_replace("#[[:punct:]]#", "", $value);
                }
                
                $set_rules  = explode("-", $val["type"]);
                foreach($set_rules as $rkey => $rval){
                    switch($rval){
                        case "alpha"    : 
                            if(!ctype_alpha($value)){
                                $status     = false;
                                $message    = "Invalid ". (isset($val["label"]) ? $val["label"] : ucwords($val["value"])) ." format. Only letters allowed";
                            }
                            break;
                        case "num"      : 
                            if(!ctype_digit($value)){
                                $status     = false;
                                $message    = "Invalid ". (isset($val["label"]) ? $val["label"] : ucwords($val["value"])) ." format. Only numbers allowed";
                            }
                            break;
                        case "alphanum"    : 
                            if(!ctype_alnum($value)){
                                $status     = false;
                                $message    = "Invalid ". (isset($val["label"]) ? $val["label"] : ucwords($val["value"])) ." format. Only letters and numbers allowed";
                            }
                            break;
                        case "email"    : 
                            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                                $status     = false;
                                $message    = "Invalid" . (isset($val["label"]) ? $val["label"] : ucwords($val["value"])) ." format. not email format";
                            }
                            break;
                        case "date"     : 
                            if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $value)){
                                $status     = false;
                                $message    = "Invalid" . (isset($val["label"]) ? $val["label"] : ucwords($val["value"])) ." format. not date format";
                            }
                            break;
                        case "datetime"     : 
                            if(!preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", $value)){
                                $status     = false;
                                $message    = "Invalid" . (isset($val["label"]) ? $val["label"] : ucwords($val["value"])) ." format. not Date Time format";
                            }
                            break;
                        case "datetimelocal"     : 
                            if(!preg_match("/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/", $value)){
                                $status     = false;
                                $message    = "Invalid" . (isset($val["label"]) ? $val["label"] : ucwords($val["value"])) ." format. not Date Time format";
                            }
                            break;
                        case "time"     : 
                            if(!preg_match("/^\d{2}:\d{2}:\d{2}$/", $value)){
                                $status     = false;
                                $message    = "Invalid" . (isset($val["label"]) ? $val["label"] : ucwords($val["value"])) ." format. not Time format";
                            }
                            break;
                        case "url"      : 
                            if(!filter_var($value, FILTER_VALIDATE_URL)){
                                $status     = false;
                                $message    = "Invalid" . (isset($val["label"]) ? $val["label"] : ucwords($val["value"])) ." format. not URL format";
                            }
                            break;
                        case "domain"      : 
                            if(!preg_match("/^(www\.)?[a-zA-Z0-9][a-zA-Z0-9-]*\.[a-zA-Z]{2,}$/", $value)){
                                $status     = false;
                                $message    = "Invalid" . (isset($val["label"]) ? $val["label"] : ucwords($val["value"])) ." format. not Domain format";
                            }
                            break;
                    }
                }
            }
            
            return (object) [
                "status"    => $status,
                "message"   => $message
            ];
        }

    }