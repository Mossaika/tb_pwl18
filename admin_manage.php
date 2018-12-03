<div class="main">
    <div class="container">  
        <fieldset>
            <legend>Users</legend>
            <table id="tableId" class="display">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Banned</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $u) {
                        ?>
                        <tr>
                            <td><?php echo $u->getUsername(); ?></td>
                            <td><?php echo $u->getEmail(); ?></td>
                            <td><?php echo $u->getName(); ?></td>
                            <td><?php echo $u->getRoles_id()->getName(); ?></td>
                            <td>
                                <?php
                                if ($u->getBanned() == 1) {
                                    echo 'YES';
                                } else {
                                    echo 'NO';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($u->getRoles_id()->getId() == 1) {
                                    echo '';
                                } else if ($u->getBanned() == 0) {
                                    ?>
                                    <input type="button" value="Ban" onClick="banUser(<?php echo $u->getId(); ?>)">
                                    <?php
                                } else {
                                    ?>
                                    <input type="button" value="Unban" onClick="unbanUser(<?php echo $u->getId(); ?>)">
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </fieldset>
    </div>
</div>