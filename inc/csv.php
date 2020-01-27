<?php
class csv {
  public static $fields = ["dni", "name", "category", "email", "companies"];

  public static function csv2array($file, $check = null, $onlyField = null) {
    $return = [];

    $flag = true;
    $headers = [];
    while (($line = fgetcsv($file, null, ",")) !== false) {
      if ($flag) {
        $headers = $line;
        $flag = false;
      } else {
        $item = [];

        foreach ($headers as $j => $field) {
          $item[$field] = trim($line[$j]);
        }

        if ($check === null || $check($item)) $return[] = ($onlyField === null ? $item : ($item[$onlyField] ?? null));
      }
    }

    fclose($file);

    return $return;
  }
}
