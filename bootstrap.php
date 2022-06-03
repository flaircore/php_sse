<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

// Global error handler.
set_exception_handler(function (\Throwable $e) {
    echo $e;
});