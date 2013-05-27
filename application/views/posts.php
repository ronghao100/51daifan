<div class="row">

    <div class="span8 page-header columns">
        <h1>我要带饭</em></h1>
    </div>
    <div class="span3 well columns">
        <ul class="unstyled">
            <li><a href="/"><strong><?php echo $realname ?></strong></a></li>
            <li>帮助解决午饭问题</li>
            <li>帮助人数<em style="color: green">5</em></li>
            <li>被帮助次数<em style="color: green">5</em></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="span8">
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


<div class="row">
    <div class="span8">

        <?php foreach ($posts as $post):
            foreach ($post as $item):

                ?>
                <div class="well row">
                    <div class="span1">
                        <ul class="unstyled">
                            <li><a href="/account/<?php echo $userid ?>">
                                    <strong>
                                        <?php echo $realname ?>
                                    </strong>
                                </a>
                            </li>
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