<?php

$doc="Software Development Request Application.doc";
header('Content-type: application/doc');
header('Content-Disposition: attachment; filename="'.$doc.'"');
readfile("$doc");
?>