<script src="<?= base_url() ?>js/tables/tables.js" type="text/javascript" ></script>
<table id="newsletter_table" style="width:100%;">
    <thead>
        <tr>
            <th>Title</th>
            <th>Newsletter Date</th>
             <th>Company</th>
               <th>Location</th>
            <th>Link (right click and save as)</th>
            <th>Date Added</th>
            <th>actions</th>
        </tr>

    </thead>
    <tbody>
        <?php
        foreach ($newsletters as $row):

            $link = str_replace(" ", "+", $row->newsletter_filename);
            $datestring1 = "%F %Y ";
             $datestring2 = " %d/%m/%Y ";
            $time = $row->newsletter_date;
            $time2 = $row->date_added;
            $newsletter_date = mdate($datestring1, $time);
            $date_added =  mdate($datestring2, $time2);
            ?>

            <tr>
                <td>  <?= $row->newsletter_title ?> </td>
                <td> <?=  $newsletter_date ?></td>
                <td> <a href="<?=base_url()?>members/view/<?= $row->company_id ?>"><?= $row->company_name ?></a></td>
                <td> <?= $row->city ?>, <?= $row->country ?></td>
                <td><a href="https://s3-eu-west-1.amazonaws.com/laworldnewsletters/<?= $link ?>"><?= $row->newsletter_filename ?></a></td>
                <td> <?= $date_added ?></td>
                <td> <a href="<?= base_url() ?>newsletters/edit/<?= $row->newsletter_id ?>">edit</a></td>            

            </tr>




        <?php endforeach; ?>
    </tbody>
</table>