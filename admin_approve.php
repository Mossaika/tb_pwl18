<div class="main">
    <div class="container">  
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
                                <button>Approve</button>
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
    </div>
</div>