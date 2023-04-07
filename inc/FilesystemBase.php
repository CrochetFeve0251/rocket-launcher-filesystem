<?php

namespace LaunchpadFilesystem;
use WP_Filesystem_Base;
use WP_Error;

/**
 * @property bool $verbose Whether to display debug data for the connection.
 * @property array $cache Cached list of local filepaths to mapped remote filepaths.
 * @property string $method The Access method of the current connection, Set automatically.
 * @property WP_Error $errors
 * @property array $options
 * @method string abspath() Returns the path on the remote filesystem of ABSPATH.
 * @method string wp_content_dir() Returns the path on the remote filesystem of WP_CONTENT_DIR.
 * @method string wp_plugins_dir() Returns the path on the remote filesystem of WP_PLUGIN_DIR.
 * @method string wp_themes_dir( $theme = false ) Returns the path on the remote filesystem of the Themes Directory.
 * @method string wp_lang_dir() Returns the path on the remote filesystem of WP_LANG_DIR.
 * @method string find_base_dir( $base = '.', $verbose = false ) Locates a folder on the remote filesystem.
 * @method string get_base_dir( $base = '.', $verbose = false ) Locates a folder on the remote filesystem.
 * @method string|false find_folder( $folder ) Locates a folder on the remote filesystem.
 * @method string|false search_for_folder( $folder, $base = '.', $loop = false ) Locates a folder on the remote filesystem.
 * @method string gethchmod( $file ) Returns the *nix-style file permissions for a file.
 * @method string getchmod( $file ) Gets the permissions of the specified file or filepath in their octal format.
 * @method string getnumchmodfromh( $mode ) Converts *nix-style file permissions to a octal number.
 * @method bool is_binary( $text ) Determines if the string provided contains binary characters.
 * @method bool chown( $file, $owner, $recursive = false ) Changes the owner of a file or directory.
 * @method bool connect() Connects filesystem.
 * @method string|false get_contents( $file ) Reads entire file into a string.
 * @method array|false get_contents_array( $file ) Reads entire file into an array.
 * @method bool put_contents( $file, $contents, $mode = false ) Writes a string to a file.
 * @method string|false cwd() Gets the current working directory.
 * @method bool chdir( $dir ) Changes current directory.
 * @method bool chgrp( $file, $group, $recursive = false ) Changes the file group.
 * @method bool chmod( $file, $mode = false, $recursive = false ) Changes filesystem permissions.
 * @method string|false owner( $file ) Gets the file owner.
 * @method string|false group( $file ) Gets the file's group.
 * @method bool copy( $source, $destination, $overwrite = false, $mode = false ) Copies a file.
 * @method bool move( $source, $destination, $overwrite = false ) Moves a file.
 * @method bool delete( $file, $recursive = false, $type = false ) Deletes a file or directory.
 * @method bool exists( $path ) Checks if a file or directory exists.
 * @method bool is_file( $file ) Checks if resource is a file.
 * @method bool is_dir( $path ) Checks if resource is a directory.
 * @method bool is_readable( $file ) Checks if a file is readable.
 * @method bool is_writable( $path ) Checks if a file or directory is writable.
 * @method int|false atime( $file ) Gets the file's last access time.
 * @method int|false mtime( $file ) Gets the file modification time.
 * @method int|false size( $file ) Gets the file size (in bytes).
 * @method bool touch( $file, $time = 0, $atime = 0 ) Sets the access and modification times of a file.
 * @method bool mkdir( $path, $chmod = false, $chown = false, $chgrp = false ) Creates a directory.
 * @method bool rmdir( $path, $recursive = false ) Deletes a directory.
 * @method array|false dirlist( $path, $include_hidden = true, $recursive = false ) Gets details for files in a directory or a specific file.
 */
abstract class FilesystemBase
{
    /**
     * @var WP_Filesystem_Base
     */
    protected $filesystem;

    public function __construct()
    {
        require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
    }

    public function __call(string $name, array $arguments) {
        if(method_exists($this, $name)) {
            return call_user_func_array([&$this, $name], $arguments);
        }

        return call_user_func_array([&$this->filesystem, $name], $arguments);
    }

    public function __get(string $name): mixed {
        if(property_exists($this, $name)) {
            return $this->{$name};
        }

        return $this->filesystem->{$name};
    }

    public function __set(string $name, mixed $value): void {
        if(property_exists($this, $name)) {
            $this->{$name} = $value;
        }

        $this->filesystem->{$name} = $value;
    }
}
