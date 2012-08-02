<div style="vertical-align:middle;display:table-cell;padding:0 0 0 30px;">
    <div style="display:inline-block;text-align:left;">
        <div id="login_form_div">
        <h3 style="color:#fff;text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);"><?php echo __('Administrator login')?></h3>
        <?php
        if (!$can_not_login){
        ?>
        <form method="post" action="<?php echo Core::url('login/');?>">
        <?php
        }
        ?>
        <span style="position:absolute;margin:13px 0 0 226px;-index:1000;display:none;" id="login_gravatar_div">
            <span class="btn-group">
                <span data-toggle="dropdown" style="cursor:pointer;display:block;border-radius:3px;width:32px;height:32px;background-size:100% 100%;"></span>
                <ul class="dropdown-menu">
                    <li><a href="#" rel="nofollow" onclick="localStorage.removeItem('logined_member');var obj=$('#login_form_div > form').get(0).username;obj.value='';obj.focus();$('#login_gravatar_div').hide();return false;"><i class="icon-trash"></i> 清除</a></li>
                </ul>
            </span>
        </span>

        <input type="text" id="login_form_username" name="username" placeholder="<?php echo __('Username');?>" size="12" style="margin-top:9px;padding:6px 10px;width:240px;font-size:16px;height:26px;border-radius:6px;border:1px solid #2270a0;background:rgba(255,255,255,0.8);box-shadow:inset 1px 1px 2px #8e8e8e,0 0 10px #97f4ff;" />

        <input type="password" id="login_form_password" name="password" placeholder="<?php echo __('Password');?>" size="12" style="margin-top:9px;padding:6px 10px;width:240px;font-size:16px;height:26px;border-radius:6px;border:1px solid #2270a0;background:rgba(255,255,255,0.8);box-shadow:inset 1px 1px 2px #8e8e8e,0 0 10px #97f4ff;" />

        <span id="login_captach_div" style="<?php if (!$show_captcha)echo 'display:none;"';?>white-space:nowrap;">
            <input autocomplete="off" type="text" maxlength="4" name="captcha" placeholder="<?php echo __('Verification code')?>" size="4" style="margin-top:9px;padding:6px 10px;width:110px;font-size:16px;height:26px;border-radius:6px;border:1px solid #2270a0;background:rgba(255,255,255,0.8);box-shadow:inset 1px 1px 2px #8e8e8e,0 0 10px #97f4ff;" />
            <img src="<?php echo Core::url('captcha/126x39.png?timeline='.microtime(1));?>" style="border-radius:6px;cursor:pointer;" title="点击更换验证码" onclick="this.src=this.src.split('?')[0]+'?timeline='+new Date().getTime();" />
        </span>
        
        <button type="submit" class="btn btn-large btn btn-danger"><i class="icon-check icon-white"></i> <?php echo __('Login');?></button>

        <?php
        if (!$can_not_login){
        ?>
        </form>
        <?php
        }
        ?>
        <div style="position:absolute">
        <span id="login_msg_div" class="label label-warning" style="font-size:14px;"><?php echo $message;?></span>
        </div>
        </div>
    </div>
</div>


<script type="text/javascript">
(function()
{
    var obj = $('#login_form_div > form').get(0);
    if(obj)obj.onsubmit = function()
    {
        var form = this;
        var show_msg = function(msg)
        {
            $('#login_msg_div').clearQueue().html(msg).show().css('opacity',1).delay(1000).fadeOut();
            //表单震动
            $('#login_form_div')
            .transition({x:-6},20,'linear').transition({x:6},40,'linear')
            .transition({x:-6},20,'linear').transition({x:6},40,'linear')
            .transition({x:-6},20,'linear').transition({x:6},40,'linear')
            .transition({x:0},20,'linear');
        };
        if (form.username.value=='')
        {
            form.username.select();
            show_msg('用户名不能空');
            return false;
        }
        if (form.password.value=='')
        {
            form.password.select();
            show_msg('密码不能空');
            return false;
        }
        if ($('#login_captach_div').css('display')!='none')
        {
            if (form.captcha.value=='')
            {
                form.captcha.select();
                show_msg('验证码不能空');
                return false;
            }
        }

        // 采用AJAX提交表单
        $(form).ajaxSubmit({
            dataType: "json",
            success:function(data){
                if (data.code==-1)
                {
                    show_msg(data.msg);
                    if (data.data.show_captcha)
                    {
                        //显示验证码
                        $('#login_captach_div').show().find('img').click();
                    }
                    
                    if (data.data.error_input && form[data.data.error_input])
                    {
                        form[data.data.error_input].focus();
                    }
                    
                    if (data.data.can_not_login)
                    {
                        form._msg = data.msg;
                        //屏蔽登录
                        form.onsubmit = function(){show_msg(this._msg);return false;}
                    }
                }
                else if (data.code==1)
                {
                    desktop.login_success(data.data);
                }
            },
            error  :function(){alert('页面处理失败，请重试');}
        });
    
        return false;
    };

    if ($('#login_msg_div').html()=='')$('#login_msg_div').hide();
    var l;
    try
    {
        l = $.parseJSON(localStorage.getItem('logined_member'));
    }catch(e){}
    
    if (l)
    {
        $('#login_form_username')[0].value = l[0];
        $('#login_form_password').focus();
        $('#login_gravatar_div').show().find('span').css('backgroundImage','url('+l[1]+')');
    }
    else
    {
        $('#login_form_username').focus();
    }
})();


</script>