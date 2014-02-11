<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title><?= $subject ?></title>
    <?= import('ticket_style.html'); ?>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td class="headerContent">
                <a href="<?= $url ?>">Ticket #<?= $ticket->id ?>: <?= $ticket->title ?></a>
            </td>
        </tr>
        <tr>
            <td valign="top" class="bodyContent">
                <!-- // Begin Module: Standard Content \\ -->
                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                    <tr>
                        <td valign="top">
                            <div mc:edit="std_content00">
                                <p>Ticket <a href="<?= $url ?>">#<?= $ticket->id ?></a> has been created.</p>
                                <p>
                                    To review the status of the ticket and add updates, follow the link below:<br />
                                    <a href="<?= $url ?>"><?= $url ?></a>
                                </p>
                                <hr />
                                <strong>
                                    <?= $author->getName() ?> - <?= helper('date.format', array('date'=> $ticket->created_on, 'format' => 'd F Y H:i')) ?>
                                </strong>
                                <br />
                                <?= $ticket->text ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>