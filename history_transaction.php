<div class="main">
    <div class="container">
        <fieldset>
            <legend>All Transactions</legend>
            <table class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Distance Fee</th>
                        <th>Order Date</th>
                        <th>Pickup Date</th>
                        <th>Finish Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($transactions as $t) {
                        ?>
                        <tr>
                            <td><?php echo $t->getId(); ?></td>
                            <td><?php echo $t->getDistance_fee(); ?></td>
                            <td><?php echo $t->getOrder_date(); ?></td>
                            <td><?php echo $t->getPickup_date(); ?></td>
                            <td><?php echo $t->getFinish_date(); ?></td>
                            <td><input type="button" value="View Details" onclick="transactionDetail(<?php echo $t->getId(); ?>)"></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </fieldset>
        <fieldset>
            <legend>Details</legend>
            <table class="display">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($details as $d) {
                        ?>
                        <tr>
                            <td><?php echo $d->getItem_id() . ' - ' . $d->getItem_id()->getName(); ?></td>
                            <td><?php echo $d->getQuantity(); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </fieldset>
    </div>
</div>