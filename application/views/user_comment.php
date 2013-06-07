<div class="row" style="margin-top: 40px">
    <div class="span8 offset1">

        <?php foreach ($comments as $item):
//            var_dump($item);
            ?>
            <div class="well row">
                <div class="span1">
                    <ul class="unstyled">
                        <li><a href="/users/<?php echo $item->owner ?>">
                                <strong>
                                    <?php echo $item->ownerName ?>
                                </strong>
                            </a>
                        </li>
                        <li>
                            <?php
                            $updatedAt = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->updatedAt);
                            echo $updatedAt['month'] . '-' . $updatedAt['day'] . ' ' . $updatedAt['hour'] . ':' . $updatedAt['minute'];
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="span5">
                    <ul class="unstyled">

                        <li>说</li>
                        <li>
                            <?php echo '<blockquote>' . $item->comment . '</blockquote>'; ?>
                        </li>
                    </ul>
                </div>
            </div>
        <?php
        endforeach
        ?>

    </div>
</div>