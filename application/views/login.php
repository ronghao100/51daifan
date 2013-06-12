<div>
    <?php
    $this->load->helper('form');
    $attributes['class'] = 'form-horizontal';
    echo form_open('account/login', $attributes);
    ?>

    <fieldset>
        <legend>欢迎回来</legend>
        <div class="control-group">
            <label class="control-label" for="email">帐号</label>

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
            <label class="control-label">
                <input id="remember_me" name="remember_me" type="checkbox">
            </label>

            <div class="controls">
                下次自动登录
            </div>
        </div>
        <div class="form-actions">
            <input value="登录" type="submit" class="btn btn-primary ">
            <span>没有账号，<a class="" href="/account/register">从这里注册>></a></span>
        </div>
    </fieldset>
    </form>

</div>