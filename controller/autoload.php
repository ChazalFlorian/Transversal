<?php

function __autoload($element) {
    if (file_exists('model/' . $element . '.php'))
        require_once 'model/' . $element . '.php';
}
