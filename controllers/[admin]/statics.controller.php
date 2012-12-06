<?php
namespace Library\MyQEE\Administration;

/**
 * 读取静态文件控制器
 *
 * @author jonwang
 *
 */
class Controller_Statics extends \Controller
{
    protected $allow_suffix = 'js|css|jpg|png|gif|bmp|html|htm|mp4|swf|zip';

    public function before()
    {
        $f = \array_pop($this->arguments);
        if ( $f && \preg_match('#^([a-zA-Z0-9_/\-\.@]+).('.$this->allow_suffix.')$#i', $f,$m) )
        {
            $args = $this->arguments;
            $args[] = $m[1];
            $this->file = \implode('/', $args);
            $this->type = $m[2];
        }
    }

    private function get_file_list($toppathlen,$dir,&$list)
    {
        $files = \glob($dir . '*');

        foreach ( $files as $file )
        {
            $bn = \basename($file);

            if ($bn[0]=='.')continue;

            if ( \is_dir($file) )
            {
                $this->get_file_list($toppathlen,$file.\DS,$list);
            }
            else
            {
                $list[] = \substr($file,$toppathlen);
            }
        }
        return $list;
    }

    public function action_appcache()
    {
        \header('Content-Type: text/cache-manifest');
        //\readfile(\Core::find_file('data', 'tetris','.manifest'));

        $list = array();

        foreach (\Core::$include_puth as $path)
        {
            $dir = $path . 'statics'.\DS;
            if (\is_dir($dir))
            {
                $this->get_file_list(\strlen($dir),$dir,$list);
            }
        }

        $path = \Core::url('statics/');
        $list = \array_map(function($t) use ($path){return $path.$t;},$list);

        echo 'CACHE MANIFEST'.\CRLF;

        echo \implode(\CRLF, $list);
    }

    public function action_default()
    {
        $file = $this->file;
        $type = $this->type;

        if ( ! \preg_match('#^([a-zA-Z0-9_/\-\.@]+)$#', $file) || ! \preg_match( '#('.$this->allow_suffix.')$#i', $type ) )
        {
            \Core::show_404();
        }
        $file = \Core::find_file( 'statics', $file, $type );
        if ( $file )
        {
            \Core::close_buffers(false);

            // 清理所有已输出的header
            \header_remove();

            $low_type = strtolower($type);
            if ( $low_type == 'jpg' )
            {
                \header( 'Content-Type: image/jpeg' );
            }
            elseif ( \in_array( $low_type, array( 'gif', 'png' ) ) )
            {
                \header( 'Content-Type: image/' . $low_type );
            }
            elseif ( $low_type == 'css' )
            {
                \header( 'Content-Type: text/css' );
            }
            elseif ( $low_type == 'js' )
            {
                \header( 'Content-Type: application/x-javascript' );
            }
            elseif ( $low_type == 'swf' )
            {
                \header( 'Content-Type: application/swf' );
            }

            \header('Cache-Control: max-age=604800');
            \header('Expires: ' . \date('D, d M Y H:i:s \G\M\T', \TIME + 86400 * 30));
            \header('Pragma: cache');

            $fun = '\\apache_get_modules';
            if (\function_exists($fun))
            {
                if (\in_array('mod_xsendfile',$fun()))
                {
                    $slen = \strlen(\DIR_SYSTEM);
                    if (\substr($file,0,$slen)==\DIR_SYSTEM)
                    {
                        // 采用xsendfile发送文件
                        \header('X-Sendfile: '.\substr($file,$slen));
                        exit();
                    }
                }
            }
            else
            {
                \header( 'Last-Modified: ' . \date( 'D, d M Y H:i:s \G\M\T', \filemtime( $file ) ) );
            }

            \readfile($file);
            exit();
        }
        else
        {
            \Core::show_404();
        }
    }
}