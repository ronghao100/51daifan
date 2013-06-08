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
                    </ul>
                </div>
                <div class="span5">
                    <ul class="unstyled">

                        <li><?php echo $item->updatedAt;?> 说</li>
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