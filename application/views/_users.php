<?php

if (!empty($data)) { ?><?php
                        foreach ($data as $value) { $val = 0; ?>
<tr>
    <td>
    <?php echo $val+1; ?>
    </td>
    <td>
        <?php echo $value->Username; ?>
    </td>
    <td>
        <?php echo $value->Email; ?>
    </td>
    <td>
        <?php echo $value->Marks; ?>

    </td>
    <td>
        <button class="btn btn-primary edit" data-id="<?php echo $value->UserID; ?>">Edit</button>
    </td>
    <td>
    <button class="btn btn-danger delete" data-id="<?php echo $value->UserID; ?>">Delete</button>
    </td>
</tr>

<?php
                        }
                    } else {
?>
<tr>
    <td colspan="6" class="text-center">No Records Found</td>
</tr>
<?php
                    }
?>