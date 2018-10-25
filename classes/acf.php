<?php
class CustomACF {
    const constant = 'constant value';

    function showConstant() {
        echo self::constant . "\n";
    }
}

$class = new CustomACF();
?>