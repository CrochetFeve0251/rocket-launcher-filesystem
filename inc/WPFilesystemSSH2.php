<?php

namespace LaunchpadFilesystem;
use WP_Filesystem_SSH2;

class WPFilesystemSSH2 extends FilesystemBase
{
    public function __construct( $opt = '' )
    {
        parent::__construct();
        require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-ssh2.php';
        $this->filesystem = new WP_Filesystem_SSH2($opt);
    }
}
