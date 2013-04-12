<?php 


  include_once './includes/bootstrap.inc'; 
  drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL); 
  drupal_flush_all_caches();
  //drupal_set_message('cache flushed.');
  echo "cache flushed";
?>