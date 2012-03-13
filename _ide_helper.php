<?php

namespace Controller
{
    class Admin extends \Library\MyQEE\Administration\Controller\Admin{}
}


namespace Model
{
    class Admin extends \Library\MyQEE\Administration\Model\Admin{}
}

namespace Model\Admin
{
    class Administrator extends \Library\MyQEE\Administration\Model\Admin\Administrator{}
}


namespace ORM\Admin
{
    class Member_Data extends \Library\MyQEE\Administration\ORM\Admin\Member_Data{}

    class Member_Finder extends \Library\MyQEE\Administration\ORM\Admin\Member_Finder{}

    class Member_Result extends \Library\MyQEE\Administration\ORM\Admin\Member_Result{}

    class MemberGroup_Data extends \Library\MyQEE\Administration\ORM\Admin\MemberGroup_Data{}

    class MemberGroup_Finder extends \Library\MyQEE\Administration\ORM\Admin\MemberGroup_Finder{}

    class MemberGroup_Result extends \Library\MyQEE\Administration\ORM\Admin\MemberGroup_Result{}
}