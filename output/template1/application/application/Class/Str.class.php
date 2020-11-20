<?php
/**
 *
 */
class Str
{
  static function random($length)
  {
    $carat = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return @substr(
      str_shuffle(str_repeat($carat, $length)), 0, $length
    );
  }

  static function randomInt($length)
  {
    $carat = "0123456789";
    return @substr(
      str_shuffle(str_repeat($carat, $length)), 0, $length
    );
  }

  static function verycation_code($length)
  {
    $carat = "0123456789";
    return 111000 . @substr(
      str_shuffle(str_repeat($carat, $length)), 0, $length
    );
  }
}
