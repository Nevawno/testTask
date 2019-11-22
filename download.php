<?php
require_once __DIR__ . './phpQuery-onefile.php';
$file = "./CSV.csv";
function file_force_download($file) {
  if (file_exists($file)) {
    if (ob_get_level()) {
      ob_end_clean();
    }
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
  }
}


file_force_download($file);
