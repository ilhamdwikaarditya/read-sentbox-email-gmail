<?php
$imapServ = "imap.gmail.com";
$imapPort = "993";
$imapUser = "email@gmail.com";
$imapPass = "secret";

$mbox = imap_open("{" . $imapServ . ":" . $imapPort . "/ssl}[Gmail]/Sent Mail", $imapUser, $imapPass);

if (isset($_GET['email'])) {

    $result = imap_fetchbody($mbox, $_GET['email'], 1);
    echo "<p>$result</p>";
    echo "<br>";
    echo "<b><a href=\"" . $_SERVER['SCRIPT_NAME'] . "\">Back To List</a></b>";
} else {
	$MC = imap_check($mbox);
	$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
	foreach ($result as $overview) {
		echo "#{$overview->msgno} \n";
		echo "<a href=\"" . $_SERVER['SCRIPT_NAME'] . "?email=" . $overview->uid . "\"><b>Waktu:</b>	". $overview->date . "	<b>Penerima:</b>" . $overview->from . " <b>Subject: </b>" . $overview->subject . "</a>";
        echo "<br>";
	}
}
?>