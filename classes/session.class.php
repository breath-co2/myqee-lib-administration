<?php
namespace Library\MyQEE\Administration;

/**
 * Session
 *
 * @author     jonwang(jonwang@myqee.com)
 * @category   Library
 * @package    Classes
 * @subpackage Session
 * @copyright  Copyright (c) 2008-2012 myqee.com
 * @license    http://www.myqee.com/license.html
 */
class Session extends \Core\Session
{
    /**
     * 构造self::$member
     */
    protected function ini_member()
    {
        if ( null===static::$member && isset($_SESSION['member_id']) && $_SESSION['member_id']>0 )
        {
            $orm_member = new \ORM_Admin_Member_Finder();
            static::$member = $orm_member->where('id',$_SESSION['member_id'])->find(null,true)->current();
        }
    }
}