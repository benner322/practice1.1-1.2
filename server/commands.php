<?php
function runCommand($cmd) {
    $output = shell_exec($cmd);
    return $output;
}