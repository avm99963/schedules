<?php
class security {
  public static function htmlsafe($string) {
    return htmlspecialchars($string);
  }
}
