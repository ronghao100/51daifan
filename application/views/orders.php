<div class="row">

    <div class="span8 page-header columns">
        <h1>我吃过</em></h1>
    </div>
    <div class="span3 well columns">
        <ul class="unstyled">
            <li><a href="/users/<?php echo $userid ?>"><strong><?php echo $realname ?></strong></a></li>
            <li>带过 <a href="/posts"><?php echo $post_count ?></a></li>
            <li>吃过 <a href="/orders"><?php echo $order_count ?></a></li>
            <li>帮助人数 <em style="color: green"><?php echo $order_count ?></em></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="span8">

        <?php foreach ($orders as $item):
                ?>
                <div class="well row">
                    <div class="span1">
                        <ul class="unstyled">
                            <li><a href="/users/<?php echo $item->foodOwner ?>">
                                    <strong>
                                        <?php echo $item->foodOwnerName?>
                                    </strong>
                                </a>
                            </li>
                            <li>
                                <?php
                                $eatDate = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->eatDate);
                                echo $eatDate['month'] . '月' . $eatDate['day'] . '号';
                                ?>
                            </li>
                        </ul>
                    </div>
                    <div class="span5">
                        <ul class="unstyled">

                            <li>带的<strong><?php echo $item->name ?></strong></li>
                            <li>
                                <blockquote><?php echo $item->describe ?></blockquote>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php
        endforeach
        ?>

    </div>
</div>