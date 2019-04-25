<script type="text/javascript" charset="utf-8">
    $(document).ready(function() 
    {
     $('table_view').dataTable( {
            "aaData": [
    <?php if(!empty($result)) { 
                foreach($result as $row) {
                // extract($row);
        ?>

       ["<?php echo $UNIT; ?>","<?php echo $PARTNUMBER; ?>","<?php echo $SERIALNUMBER; ?>","<?php echo $DATERCD; ?>","<?php echo $DATERMVD; ?>","<?php echo $ACTYPE; ?>","<?php echo $ACREG; ?>","<?php echo $TECH; ?>","<?php echo $POS; ?>","<?php echo $QTY; ?>","<a class='ajax-action-links' href='edititems.php?id=<?php echo $ID; ?>'><img src='crud-icon/edit.png' title='Edit' /></a><a class='ajax-action-links'  href='javascript:delete_id(<?php echo $ID; ?>)' ><img src='crud-icon/delete.png' title='Delete' /></a>"],
       
    <?php }
            }
        ?>
       ],
            "columns": [
                { "title": "Unit" },
                { "title": "Part number" },
                { "title": "Serial number" },
                // { "title": "Description" },
                { "title": "Date recieved" },
                { "title": "Date removed" },
                { "title": "Ac type" },
                { "title": "Ac reg" },
                { "title": "Engineer" },
                { "title": "Position" },
                { "title": "Quantity" },
                { "title": "Actions" }
            ]
        } );   
    });
    </script>