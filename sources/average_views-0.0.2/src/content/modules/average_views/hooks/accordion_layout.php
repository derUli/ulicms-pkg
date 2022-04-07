<?php
$acl = new ACL();
if ($acl->hasPermission("average_views")) {
    $query = Database::query("select round(avg(views)) as value from " . tbname("content"));
    $data = Database::fetchObject($query);
    $avg_pages = $data->value;
    ?>

    <h2 class="accordion-header"><?php translate("average_views"); ?></h2>
    <div class="accordion-content">
        <table>
            <tr>
                <td><strong><?php translate("pages"); ?></strong></td>
                <td style="text-align: right">
                    <?php echo $avg_pages; ?></td>

            </tr>
        </table>
    </div>

    <?php
}
