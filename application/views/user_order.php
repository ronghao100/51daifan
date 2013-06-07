
<div class="row" style="margin-top: 40px">
    <div class="span8 offset1">

        <?php foreach ($orders as $item):
                ?>
                <div class="well row">
                    <div class="span1">
                        <ul class="unstyled">
                            <li><a href="/users/<?php echo $item->foodOwner ?>">
                                    <strong>
                                        <?php echo $item->foodOwnerName ?>
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