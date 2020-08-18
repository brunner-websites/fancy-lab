<div class="slb-field-container">
  <label for="">Lists</label>
  <ul>

    <?php

    global $wpdb;
    $list_query = $wpdb->get_results("select ID, post_title from {$wpdb->posts} WHERE post_type='slb_list' AND post_status in ('draft', 'publish')");

    if (!is_null($list_query)) {
      foreach ($list_query as $list) {
        echo '<li><label><input type="checkbox" name="slb_list[]" value="' . $list->ID . '">' . $list->post_title . '</label></li>';
      }
    }
    ?>

  </ul>
</div>