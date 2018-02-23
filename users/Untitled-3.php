<?php

$doc="Change_Request_Form.doc";
header('Content-type: application/doc');
header('Content-Disposition: attachment; filename="'.$doc.'"');
readfile("$doc");
?>