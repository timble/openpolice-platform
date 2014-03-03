$(document).ready(
    function () {
        // Check first thumbnail in the list as attachments_attachment_id by default
        if(!$jQuery("input[name='attachments_attachment_id']:checked").val()) {
            $jQuery('#attachments-list .thumbnail:first-of-type input[name="attachments_attachment_id"]').prop('checked', true);
        }
    }
);