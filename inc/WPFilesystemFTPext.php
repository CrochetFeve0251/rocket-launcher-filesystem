<?php

namespace LaunchpadFilesystem;
use WP_Filesystem_FTPext;

class WPFilesystemFTPext extends FilesystemBase
{
    public function __construct( $opt = '' )
    {
        parent::__construct();
        require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-ftpext.php';
        $this->filesystem = new WP_Filesystem_FTPext($opt);
    }
}
