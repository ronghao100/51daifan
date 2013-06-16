<?php if ($logged_in && $userid == $user->objectId) {
    ?>
    <div class="row-fluid" style="margin-top: 40px">
        <div class="span6 offset2">
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

<div class="row-fluid" style="margin-top: 40px">
    <div class="span6 offset2">

        <?php foreach ($posts as $item):
            ?>
            <div class="row-fluid" style="border-bottom: 1px solid #EAEAE2;margin-bottom: 10px">
                <div class="span1" style="width:50px">
                    <ul class="unstyled">
                        <li>
                            <?php
                            $eatDate = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->eatDate);
                            ?>
                            <div class="ydtime">
                                <span class="dblok"><?php echo $eatDate['month'] ?>月</span>
                                <span class="tdate"><?php echo $eatDate['day'] ?></span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="span10">
                    <ul class="unstyled">

                        <li>
                            <span><strong><?php echo $item->name ?></strong></span>
                        </li>
                        <li style="margin-bottom: 10px;margin-top: 10px">
                            <?php echo $item->describe ?>
                        </li>
                        <li>
                                <span>
                                    <?php echo $item->createdAt; ?>
                                    发布
                                </span>
                        <span class="offset2" style="float:right ">
                        <a class='booked_persons_link' onclick="return false" data-baseUrl="<?php echo base_url(); ?>"
                           data-foodid="<?php echo $item->objectId; ?>" href="#">谁吃了(<?php echo $item->bookedCount ?>
                            )</a></span>
                        </li>
                        <li class='booked_persons_span' data-isGetData=false
                            id="booked_persons_<?php echo $item->objectId; ?>">
                        </li>
                    </ul>
                </div>
            </div>
        <?php
        endforeach
        ?>

    </div>
</div>