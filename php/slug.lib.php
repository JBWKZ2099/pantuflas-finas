<?php
  function slugger($string) {
    $string = str_replace(" ", "-", $string);

    $noaccent = array(
      "Š"=>"S", "š"=>"s", "Ž"=>"Z", "ž"=>"z", "À"=>"A", "Á"=>"A", "Â"=>"A", "Ã"=>"A", "Ä"=>"A", "Å"=>"A", "Æ"=>"A", "Ç"=>"C", "È"=>"E", "É"=>"E", "Ê"=>"E", "Ë"=>"E", "Ì"=>"I", "Í"=>"I", "Î"=>"I", "Ï"=>"I", "Ñ"=>"N", "Ò"=>"O", "Ó"=>"O", "Ô"=>"O", "Õ"=>"O", "Ö"=>"O", "Ø"=>"O", "Ù"=>"U", "Ú"=>"U", "Û"=>"U", "Ü"=>"U", "Ý"=>"Y", "Þ"=>"B", "ß"=>"Ss", "à"=>"a", "á"=>"a", "â"=>"a", "ã"=>"a", "ä"=>"a", "å"=>"a", "æ"=>"a", "ç"=>"c", "è"=>"e", "é"=>"e", "ê"=>"e", "ë"=>"e", "ì"=>"i", "í"=>"i", "î"=>"i", "ï"=>"i", "ð"=>"o", "ñ"=>"n", "ò"=>"o", "ó"=>"o", "ô"=>"o", "õ"=>"o", "ö"=>"o", "ø"=>"o", "ù"=>"u", "ú"=>"u", "û"=>"u", "ý"=>"y", "þ"=>"b", "ÿ"=>"y"
    );
    $string = strtr( $string,$noaccent );

    return strtolower( preg_replace("/[^A-Za-z0-9\-]/", "", $string) );
  }

  function isFile() {
    $actual_link = (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $ider = explode("-", $actual_link);
    if( array_key_exists(1,$ider) )
      $some = $ider[1];
    else
      $some = "";

    if($some != "") {
      $req = explode("/", $_SERVER["REQUEST_URI"]);
      $_GET["type"] = $req[2];

      $array = array( "file"=>$_GET["type"] );
    } else {
      $array = array(
        "no",
        explode("/", $_SERVER["REQUEST_URI"])[1]
      );
    }
    
    return $array;
  }
?>