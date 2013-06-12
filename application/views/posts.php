<div class="row-fluid">

    <div class="span8">
        <div class="row-fluid">
            <div class="page-header columns">
                <h1>我要带饭</em></h1>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
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
        <?php foreach ($posts as $item):
            ?>
            <div class="row-fluid">
                <div class="span12 well">
                        <div class="span2">
                            <ul class="unstyled">
                                <li>
                                    <?php
                                    $eatDate = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->eatDate);
                                    echo $eatDate['month'] . '月' . $eatDate['day'] . '号';
                                    ?>
                                </li>
                            </ul>
                        </div>
                        <div class="span10">
                            <ul class="unstyled">

                                <li>
                                    <span>带了<strong><?php echo $item->name ?></strong></span>
                                </li>
                                <li>
                                    <blockquote><?php echo $item->describe ?></blockquote>
                                </li>
                                <li>
                                <span>
                                    <?php
                                    $createDate = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->createdAt);
                                    echo $createDate['month'] . '-' . $createDate['day'] . ' ' . $createDate['hour'] . ':' . $createDate['minute'];
                                    ?>
                                    发布
                                </span>
                        <span class="offset5">总共(<?php echo $item->count ?>)<i class="S_txt3">|</i>
                        还剩(<?php echo $item->count - $item->bookedCount ?>)<i class="S_txt3">|</i>
                        <a class='booked_persons_link' onclick="return false" data-baseUrl="<?php echo base_url(); ?>"
                           data-foodid="<?php echo $item->objectId; ?>" href="#">已抢出(<?php echo $item->bookedCount ?>
                            )</a></span>
                                </li>
                                <li class='booked_persons_span' data-isGetData=false
                                    id="booked_persons_<?php echo $item->objectId; ?>">
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>
        <?php
        endforeach
        ?>
    </div>

    <div class="span4">
        <div class="row-fluid">
            <div class="span12 well" style="height: 200px;">
                <span class="span4">
                    <a href="/users/<?php echo $userid ?>">
                        <img style="height: 120px;width: 120px;" src="<?php
                        if ($avatar) {
                            echo $avatar;
                        } else {
                            echo base_url() . 'application/views/images/large_avatar.png';
                        }
                        ?>" alt="<?php echo $realname ?>">
                    </a>
                </span>
                <span class="span8">
                <ul class="unstyled">
                    <li style="padding-bottom: 20px">
                        <a href="/users/<?php echo $userid ?>"><strong><?php echo $realname ?></strong></a></li>
                    <li style="float: left;width: 61px;text-align: center">带过 <a
                            href="/users/post/<?php echo $userid ?>"><?php echo $post_count ?></a></li>
                    <li style="float: left;width: 61px;text-align: center">吃过 <a
                            href="/users/order/<?php echo $userid ?>"><?php echo $order_count ?></a></li>
                    <li style="float: left;width: 70px;text-align: center">帮助人数 <a
                            href="#"><?php echo $order_count ?></a></li>
                    <li style="padding-top: 40px"><a class="btn btn-primary" href="/users/post/<?php echo $userid ?>">我要带饭</a></li>
                </ul>
                    </span>
            </div>
        </div>
    </div>

</div>

