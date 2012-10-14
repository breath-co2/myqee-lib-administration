<?php
if (false)$group = new ORM_Admin_MemberGroup_Data();
?>
<form method="post" class="form-horizontal">
    <legend><?php echo $title;?></legend>
    <fieldset>

        <div class="control-group">
            <label class="control-label">组名称：</label>
            <div class="controls"><?php echo Form::input('group_name',$group->group_name,array('class'=>'input-xlarge'));?></div>
        </div>

        <div class="control-group">
            <label class="control-label">权限组说明：</label>
            <div class="controls">
                <?php echo Form::textarea('group_desc',$group->group_desc,array('class'=>'input-xlarge','rows'=>'3'));?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">排序：</label>
            <div class="controls">
                <?php echo Form::input('sort',$group->sort,array('class'=>'input-small','min'=>0,'max'=>9999));?>
                <p class="help-inline">数字越大越靠前</p>
            </div>
        </div>

        <?php
        if ($can_edit_perm)
        {
        ?>
        <?php View::factory('/admin/administrator/menu_form',array('checked_menu'=>$group->setting['menu_config']?$group->setting['menu_config']:'default'))->render();?>
        <div class="control-group">
            <label class="control-label">权限设置：</label>
            <div class="controls">
                <?php View::factory('/admin/administrator/perm_form',array('perm'=>$group->perm()))->render();?>
            </div>
        </div>
        <?php
        }
        ?>

        <div class="control-div">
            <div class="form-actions">
                <button class="btn btn-primary btn-primary" type="submit">保存数据</button>
                <input type="button" class="btn" onclick="desktop.back();" value="返回" />
                <?php
                if ( $can_edit_perm && !Session::instance()->member()->is_super_admin && $group->id>0 && ($my_group_ids = Session::instance()->member()->groups()->ids()) && in_array($group->id,$my_group_ids) )
                {
                    echo '<p class="help-inline">注意，您属于此权限组，若修改权限可能会影响自己的权限。</p>';
                }
                ?>
            </div>
        </div>
    </fieldset>
</form>