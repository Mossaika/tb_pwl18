<div class="main">
    <div class="container">  
        <fieldset>
            <legend>Drivers</legend>
            <table id="tableId" class="display">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Driver ID</th>
                        <th>Approved</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($drivers as $d) {
                        ?>
                        <tr>
                            <td><?php echo $d->getUsername(); ?></td>
                            <td><?php echo $d->getEmail(); ?></td>
                            <td><?php echo $d->getName(); ?></td>
                            <td><?php echo $d->getDriver_id()->getId(); ?></td>
                            <td><?php
                                if ($d->getDriver_id()->getApproved() == 0) {
                                    echo 'NO';
                                } else {
                                    echo 'YES';
                                }
                                ?></td>
                            <td><?php
                                if ($d->getDriver_id()->getApproved() == 0) {
                                    ?>
                                    <button value="Approve" onclick="approveDriver(<?php echo $d->getDriver_id()->getId(); ?>)">Approve</button>
                                    <?php
                                } else {
                                    echo 'Already approved';
                                }
                                ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </fieldset>
        <br>
        <fieldset>
            <legend>Sellers</legend>
            <table id="tableId" class="display">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Seller ID</th>
                        <th>Approved</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($sellers as $s) {
                        ?>
                        <tr>
                            <td><?php echo $s->getUsername(); ?></td>
                            <td><?php echo $s->getEmail(); ?></td>
                            <td><?php echo $s->getName(); ?></td>
                            <td><?php echo $s->getSeller_id()->getId(); ?></td>
                            <td><?php
                                if ($s->getSeller_id()->getApproved() == 0) {
                                    echo 'NO';
                                } else {
                                    echo 'YES';
                                }
                                ?></td>
                            <td><?php
                                if ($s->getSeller_id()->getApproved() == 0) {
                                    ?>
                                    <input type="button" value="Approve" onClick="approveSeller(<?php echo $s->getSeller_id()->getId(); ?>)">
                                    <?php
                                } else {
                                    echo 'Already approved';
                                }
                                ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </fieldset>
    </div>
</div>