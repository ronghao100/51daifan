<div class="row-fluid">
    <div class="span6 offset2">


        <div class="row-fluid">
            <span class="span12">
                        <?php if ($logged_in && $userid == $user->objectId && sizeof($recipes) == 0) {
                            echo "你还没有记录过咱自己家的美食日记呢 <a href='/recipes/create'> 记录咱家的美食日记</a>";
                        }
                        ?>
                <a style="float: right" class="btn btn-primary" href="/recipes/create">
                    <i class="icon-camera icon-white"></i> 我要记录</a></span>
        </div>

        <?php foreach ($recipes as $item):
//            var_dump($item);
            ?>
            <div class="row-fluid" style="border-bottom: 1px solid #EAEAE2;margin-bottom: 10px">
                <div class="span1" style="width:50px">
                    <ul class="unstyled">
                        <li>
                            <?php
                            $createdAt = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->createdAt);
                            ?>
                            <div class="ydtime">
                                <span class="dblok"><?php echo $createdAt['month'] ?>月</span>
                                <span class="tdate"><?php echo $createdAt['day'] ?></span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="span10">
                    <ul class="unstyled">
                        <li>
                            <?php echo $item->name ?> : <?php echo $item->des ?>
                        </li>
                        <li>
                            <?php
                            if ($item->image1) {
                                echo "<img class='recipes_img' src='" . $item->image1 . "'/>";
                            }
                            if ($item->image2) {
                                echo "<img class='recipes_img' src='" . $item->image2 . "'/>";
                            }
                            if ($item->image3) {
                                echo "<img class='recipes_img' src='" . $item->image3 . "'/>";
                            }
                            if ($item->image4) {
                                echo "<img class='recipes_img' src='" . $item->image4 . "'/>";
                            }
                            if ($item->image5) {
                                echo "<img class='recipes_img' src='" . $item->image5 . "'/>";
                            }
                            if ($item->image6) {
                                echo "<img class='recipes_img' src='" . $item->image6 . "'/>";
                            }
                            ?>
                        </li>
                        <li>
                                <span>
                                    <?php echo $item->createdAt; ?>
                                    发布
                                </span>
                        </li>
                    </ul>
                </div>
            </div>
        <?php
        endforeach
        ?>

    </div>
</div>