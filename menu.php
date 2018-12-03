<!--==============================content================================-->
<div class="ic">More Website Templates @ TemplateMonster.com - January 23, 2012!</div>
<div class="main">
    <div class="wrapper">
        <article>
            <form id="menu" method="POST">
                <h3>Items</h3>
                <ul class="price-list">
                    <?php
                    foreach ($items as $i) {
                        ?>
                        <li><span><input type="number" min="0" style="width: 30px;" value="0" name="items[]" id="<?php echo $i->getId(); ?>">
                                <input type="hidden" name="id[]" value="<?php echo $i->getId(); ?>">
                                <input type="hidden" name="prices[]" value="<?php echo $i->getPrice(); ?>">
                                x Rp <?php echo $i->getPrice(); ?></span>
                            <a href="#"><?php echo $i->getName(); ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul><br>
            </form>
            <table width="100%">
                <tr>
                    <td>
                        <button type="submit" class="button-1" style="border:0;" form="menu" name="btnCheckout">Checkout</button>
                    </td>
                    <th align="right">
                        Rp <a id="total">Total</a>
                    </th>
                </tr>
            </table>
        </article>
    </div>
</div>

<script type="text/javascript">
    $('input').on('input', function () {
        var temp = 0;
        var i = 0;
        var length = document.getElementsByName('items[]').length;
        while (i < length) {
            temp += parseInt(document.getElementsByName('items[]')[i].value) * parseInt(document.getElementsByName('prices[]')[i].value);
            i += 1;
        }
        $('#total').text(temp);
    });
</script>