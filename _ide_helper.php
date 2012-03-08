<?php

namespace Controller
{
    class Admin extends \Library\MyQEE\Administration\Controller\Admin{}
}


namespace Model
{
    class Admin extends \Library\MyQEE\Administration\Model\Admin{}
}


namespace ORM\Admin
{
    class Member_Data extends \Library\MyQEE\Administration\ORM\Admin\Member_Data{}

    class Member_Finder extends \Library\MyQEE\Administration\ORM\Admin\Member_Finder{}

    class Member_Result extends \Library\MyQEE\Administration\ORM\Admin\Member_Result{}
}