<?php
namespace Library\MyQEE\Administration\Controller;

/**
 * 读取静态文件控制器
 *
 * @author jonwang
 *
 */
class Statics extends \Controller
{

    public function before()
    {
        $f = \array_pop($this->arguments);
        if ( $f && \preg_match('#^([a-zA-Z0-9_/\-\.]+).(js|css|jpg|png|gif|swf)$#i', $f,$m) )
        {
            $args = $this->arguments;
            $args[] = $m[1];
            $this->file = \implode('/', $args);
            $this->type = $m[2];
        }
    }

    public function action_default()
    {
        $file = $this->file;
        $type = $this->type;

        if ( ! \preg_match( '#^([a-zA-Z0-9_/\-\.]+)$#', $file ) || ! \preg_match( '#(js|css|jpg|png|gif|swf)$#', $type ) )
        {
            \Core::show_404();
        }

        $file = \Core::find_file( 'statics', $file, $type );
        if ( $file )
        {
            if ( \in_array( $type, array( 'jpg', 'gif', 'png' ) ) )
            {
                \header( 'Content-Type: image/' . $type );
            }
            elseif ( $type == 'css' )
            {
                \header( 'Content-Type: text/css' );
            }
            elseif ( $type == 'js' )
            {
                \header( 'Content-Type: application/x-javascript' );
            }
            elseif ( $type == 'swf' )
            {
                \header( 'Content-Type: application/swf' );
            }
            \header( 'Cache-Control: max-age=604800' );
            \header( 'Last-Modified: ' . \date( 'D, d M Y H:i:s \G\M\T', \filemtime( $file ) ) );
            \header( 'Expires: ' . \date( 'D, d M Y H:i:s \G\M\T', \TIME + 86400 * 30 ) );
            \header( 'Pragma: cache');
            \readfile( $file );
            exit();
        }
        else
        {
            \Core::show_404();
        }
    }
}