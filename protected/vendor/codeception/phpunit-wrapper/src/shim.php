<?php
// @codingStandardsIgnoreStart
// Add aliases for PHPUnit 6
namespace {    

    if (!class_exists('PHPUnit\Framework\Assert') && class_exists('PHPUnit_Framework_Assert')) {
        class_alias('PHPUnit_Framework_Assert', 'PHPUnit\Framework\Assert');
    }

    if (!class_exists('PHPUnit\Util\Log\JSON') || !class_exists('PHPUnit\Util\Log\TAP')) {
        if (class_exists('PHPUnit\Util\Printer')) {
            require_once __DIR__ . '/phpunit5-loggers.php'; // TAP and JSON loggers were removed in PHPUnit 6
        }
    }
}

// @codingStandardsIgnoreEnd
