<?php

namespace ASLQ;

/**
 * The Frontend Class
 */
class Frontend
{

  /**
   * Initializing the frontend Class
   */
  public function __construct()
  {
    new Frontend\WC_Hooks();
  }
}
