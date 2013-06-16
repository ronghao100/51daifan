<div class="row-fluid">
    <div class="span6 offset2">

        <div class="row-fluid">
            <span class="span12">
                        <?php if ($logged_in && $userid == $user->objectId && sizeof($posts) == 0) {
                            echo "你还没有带过饭呢 <a href='/posts/create'> 给大家分享咱家的爱心便当</a>";
                        }
                        ?>
                <a style="float: right" class="btn btn-primary" href="/posts/create">
                    <i class="icon-edit icon-white"></i> 我要带饭</a></span>
        </div>

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