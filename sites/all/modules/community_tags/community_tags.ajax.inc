<?php
// $Id: community_tags.ajax.inc,v 1.1.2.3 2008/08/23 03:04:47 herc Exp $

/**
 * @file
 * community_tags.ajax.inc
 *
 * Handles the server side Ajax interactions of Community Tags.
 *
 * @defgroup community_tags_ajax Community Tags server side Ajax interactions.
 * @{
 */


/**
 * Callback for the JS tagger.
 */
function community_tags_from_js($node) {
  global $user;

  $tags = (isset($_POST['tags']) && is_array($_POST['tags'])) ? $_POST['tags'] : array();
  
  // Merge in new tag and save.
  $tags = array_unique(array_merge($tags, drupal_explode_tags($_POST['add'])));  
  $tags =  preg_replace('%
        # Match an opening or closing HTML 4.01 tag.
        </?                  # Tag opening "<" delimiter.
        (?:                  # Group for HTML 4.01 tags.
          ABBR|ACRONYM|ADDRESS|APPLET|AREA|A|BASE|BASEFONT|BDO|BIG|
          BLOCKQUOTE|BODY|BR|BUTTON|B|CAPTION|CENTER|CITE|CODE|COL|
          COLGROUP|DD|DEL|DFN|DIR|DIV|DL|DT|EM|FIELDSET|FONT|FORM|
          FRAME|FRAMESET|H\d|HEAD|HR|HTML|IFRAME|IMG|INPUT|INS|
          ISINDEX|I|KBD|LABEL|LEGEND|LI|LINK|MAP|MENU|META|NOFRAMES|
          NOSCRIPT|OBJECT|OL|OPTGROUP|OPTION|PARAM|PRE|P|Q|SAMP|
          SCRIPT|SELECT|SMALL|SPAN|STRIKE|STRONG|STYLE|SUB|SUP|S|
          TABLE|TD|TBODY|TEXTAREA|TFOOT|TH|THEAD|TITLE|TR|TT|U|UL|VAR
        )\b                  # End group of tag name alternative.
        (?:                  # Non-capture group for optional attribute(s).
          \s+                # Attributes must be separated by whitespace.
          [\w\-.:]+          # Attribute name is required for attr=value pair.
          (?:                # Non-capture group for optional attribute value.
            \s*=\s*          # Name and value separated by "=" and optional ws.
            (?:              # Non-capture group for attrib value alternatives.
              "[^"]*"        # Double quoted string.
            | \'[^\']*\'     # Single quoted string.
            | [\w\-.:]+      # Non-quoted attrib value can be A-Z0-9-._:
            )                # End of attribute value alternatives.
          )?                 # Attribute value is optional.
        )*                   # Allow zero or more attribute=value pairs
        \s*                  # Whitespace is allowed before closing delimiter.
        /?                   # Tag may be empty (with self-closing "/>" sequence.
        >                    # Opening tag closing ">" delimiter.
        | <!--.*?-->         # Or a (non-SGML compliant) HTML comment.
        | <!DOCTYPE[^>]*>    # Or a DOCTYPE.
        %six', '', $tags);
  $vid = array_shift(community_tags_vids_for_node($node));
  community_tags_taxonomy_node_save($node, array('tags' => array($vid => $tags)), FALSE, $user->uid);

  // Fetch updated list.
  $tags = community_tags_flatten(community_tags_get_user_node_tags($user->uid, $node->nid));

  // Output JSON.
  print drupal_json(array('status' => TRUE, 'tags' => $tags, 'sequence' => $_POST['sequence']));
}

/**
 * @}
 */