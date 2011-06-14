<?php

/**
 * Field handler for Taxonomy: Hierarchy
 */
class lineage_handler_field extends views_handler_field {
  function render($values) {
    $content = $values->{$this->field_alias};

    if ($content == '') return '';

    // split lineage string into pieces, i.e. hierarchial path (getting rid of weight numbers, too)
    $path = split("\n[0-9]+", "\n".$content);
    $s = '';
    // compose the path in readable form
    foreach ($path as $a) {
      if ($s != '') $s .= '  /  ';
      $s .= str_replace("\n", '', $a);
    }
    // output pseudo-link (without href) with hierarchically indented term and full path via title/alt-rollover
    return str_repeat('&nbsp;&nbsp;&nbsp;', substr_count($content, "\n")-1)
           . '<a title="' . $s . '" alt="' . $s . '">' . $a . '</a>';
  }
}

