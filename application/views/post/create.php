<div class="row-fluid">

    <div class="span6 offset3">

        <?php
        $this->load->helper('form');
        $attributes['class'] = 'form-horizontal';
        echo form_open('posts/create', $attributes);
        ?>

        <fieldset>
            <legend>带饭</legend>
            <div class="control-group">
                <label class="control-label" for="name">菜名</label>

                <div class="controls">
                    <input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>"
                           placeholder="菜名">
                    <?php echo form_error('name'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="describe">描述</label>

                <div class="controls">
                    <textarea name="describe" id="describe"><?php echo set_value('describe'); ?></textarea>
                    <?php echo form_error('describe'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="count">数量</label>

                <div class="controls">
                    <input type="text" name="count" id="count" value="<?php echo set_value('count'); ?>">
                    <?php echo form_error('name'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="eatDate">带饭日期</label>

                <div class="controls">
                    <input type="text" class="datepicker" name="eatDate" id="eatDate"
                           value="<?php echo set_value('eatDate'); ?>">
                    <?php echo form_error('eatDate'); ?>
                </div>
            </div>
            <div class="form-actions">
                <input value="我带" type="submit" class="btn btn-primary ">
            </div>
        </fieldset>
        </form>
    </div>
</div>
