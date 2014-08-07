<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title><?= $subject ?></title>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="border-collapse: collapse; border-bottom-width: 0; color: #FFF; font-family: Arial; font-weight: bold; line-height: 100%; text-align: center; vertical-align: middle; background-color: #0054ae; padding: 10px 0;" align="center" bgcolor="#0054ae" valign="middle">
                <a href="<?= $url ?>" style="color: #FFF; font-weight: normal; text-decoration: underline;">Ticket #<?= $ticket->id ?>: <?= $ticket->title ?></a>
            </td>
        </tr>
        <tr>
            <td valign="top" style="border-collapse: collapse;">

                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                    <tr>
                        <td valign="top" style="border-collapse: collapse;">
                            <div mc:edit="std_content00" style="color: #505050; font-family: Arial; font-size: 14px; line-height: 150%; text-align: left;" align="left">
                                <p>Ticket <a href="<?= $url ?>" style="color: #004d9f; font-weight: normal; text-decoration: underline;">#<?= $ticket->id ?></a> has been updated.</p>
                                <p>
                                    To review the status of the ticket and add updates, follow the link below:<br />
                                    <a href="<?= $url ?>" style="color: #004d9f; font-weight: normal; text-decoration: underline;"><?= $url ?></a>
                                </p>
                                <hr style="height: 1px; border-top-color: #d3d3d3; margin: 20px 0 0; padding: 20px 0 0; border-style: dotted none none; border-width: 1px 0 0;" />
                                <? foreach($ticket->getComments() as $comment) : ?>
                                    <strong>
                                        <?= $comment->created_by_name ?> - <?= helper('date.format', array('date'=> $comment->created_on, 'format' => 'd F Y H:i')) ?>
                                    </strong>
                                    <br />
                                    <?= $comment->text ?>
                                    <hr style="height: 1px; border-top-color: #d3d3d3; margin: 20px 0 0; padding: 20px 0 0; border-style: dotted none none; border-width: 1px 0 0;" />
                                <? endforeach; ?>
                                <strong>
                                    <?= $ticket->created_by_name ?> - <?= helper('date.format', array('date'=> $ticket->created_on, 'format' => 'd F Y H:i')) ?>
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