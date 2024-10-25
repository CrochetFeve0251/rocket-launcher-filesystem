<?php

namespace LaunchpadFilesystem;
use WP_Filesystem_ftpsockets;

class WPFilesystemftpsockets extends FilesystemBase
{

    public function __construct( $opt = '' )
    {
        parent::__construct();
        require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-ftpsockets.php';
        $this->filesystem = new WP_Filesystem_ftpsockets($opt);
    }
}
