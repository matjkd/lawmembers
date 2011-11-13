<script type="text/javascript">
    $(document).ready(function() {
        oTable = $('#transfer_list').dataTable({
            "bJQueryUI": true,
            "aaSorting": [[ 0, "desc" ]],
            "sPaginationType": "full_numbers",
            "bStateSave": false

        });
    });

</script>



<table id="transfer_list"  width="100%" style="clear:both;">

    <thead>
        <tr>
            <th>Account Name</th>
            <th>Country</th>
            <th>Website</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transferAccounts as $row): ?>

            <tr>
                <td><a href="<?= base_url() ?>filetransfer/view_account/<?= $row->accountid ?>"><?= $row->company_name ?></a></td>
                <td><a href="<?= base_url() ?>filetransfer/view_account/<?= $row->accountid ?>"><?= $row->country ?></a></td>
                <td><a href="<?= base_url() ?>filetransfer/view_account/<?= $row->accountid ?>"><?= $row->company_web ?></a></td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>



