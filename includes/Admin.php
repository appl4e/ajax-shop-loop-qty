<?php

namespace ASLQ;

/**
 * The Admin Class
 */
class Admin
{
  public function __construct()
  {
    add_action('admin_notices', [$this, 'aslq_admin_notice_success']);
  }

  public function aslq_admin_notice_success()
  {
  ?>
    <div class="notice notice-success is-dismissible">
      <p><?php _e('ASLQ Plugin Installed and Activated Successfully!', 'ajax-shop-loop-qty'); ?></p>
    </div>
  <?php
  }
}
