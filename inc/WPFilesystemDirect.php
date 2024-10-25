<?php

namespace LaunchpadFilesystem;

use stdClass;
use WP_Filesystem_Base;
use WP_Filesystem_Direct;

class WPFilesystemDirect extends FilesystemBase
{
   public function __construct(StdClass $configs = null)
   {
       parent::__construct();
       require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';
       $this->filesystem = new WP_Filesystem_Direct( $configs ?: new StdClass() );
   }
}
