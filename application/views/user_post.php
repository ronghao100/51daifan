<?php if ($logged_in && $userid == $user->objectId) {
    ?>
    <div class="row" style="margin-top: 40px">
        <div class="span8 offset1">
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
<?php } ?>

<div class="row" style="margin-top: 40px">
    <div class="span8 offset1">

        <?php foreach ($posts as $post):
            foreach ($post as $item):
                ?>
                <div class="well row">
                    <div class="span1">
                        <ul class="unstyled">
                            <li>
                                <?php
                                $eatDate = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->eatDate->iso);
                                echo $eatDate['month'] . '月' . $eatDate['day'] . '号';
                                ?>
                            </li>
                        </ul>
                    </div>
                    <div class="span5">
                        <ul class="unstyled">

                            <li>带了<strong><?php echo $item->name ?></strong></li>
                            <li>
                                <blockquote><?php echo $item->describe ?></blockquote>
                            </li>
                            <li>
                                总共<em style="color: green"><?php echo $item->count ?></em>份,
                                已被抢出<em style="color: red"><?php echo $item->bookedCount ?></em>份,
                                还剩<em style="color: red"><?php echo $item->count - $item->bookedCount ?></em>份
                            </li>
                        </ul>
                    </div>
                </div>
            <?php
            endforeach;
        endforeach
        ?>

    </div>
</div>