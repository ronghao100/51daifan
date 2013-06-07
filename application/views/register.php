<div>
    <?php
    $this->load->helper('form');
    $attributes['class'] = 'form-horizontal';
    echo form_open('account/register',$attributes );
    ?>

        <fieldset>
            <legend>欢迎加入带饭的大家庭</legend>
            <div class="control-group">
                <label class="control-label" for="realname">姓名</label>
                <div class="controls">
                    <input type="text" name="realname" id="realname" value="<?php echo set_value('realname'); ?>" placeholder="RTX名">
                    <?php echo form_error('realname'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="email">邮箱</label>
                <div class="controls">
                    <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" placeholder="邮箱">
                    <?php echo form_error('email'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="password">密码</label>
                <div class="controls">
                    <input name="password" id="password" type="password" value="<?php echo set_value('password'); ?>">
                    <?php echo form_error('password'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="passwordconf">确认密码</label>
                <div class="controls">
                    <input name="passwordconf" id="passwordconf" type="password" value="<?php echo set_value('passwordconf'); ?>">
                    <?php echo form_error('passwordconf'); ?>
                </div>
            </div>
            <div class="form-actions">
                <input value="注册" type="submit" class="btn btn-primary ">
            </div>
        </fieldset>
    </form>

</div>