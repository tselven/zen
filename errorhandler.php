<?php
use Core\Controller;

/**
 * Converts the debug backtrace into a string format for debugging.
 *
 * @return string
 */
function getDebugBacktraceAsString()
{
    $backtrace = debug_backtrace();
    $traceString = "";

    foreach ($backtrace as $index => $trace) {
        $file = $trace['file'] ?? '[internal function]';
        $line = $trace['line'] ?? '-';
        $function = $trace['function'] ?? '[unknown function]';
        $class = $trace['class'] ?? '';
        $type = $trace['type'] ?? '';

        $traceString .= "#{$index} {$file}({$line}): {$class}{$type}{$function}()\n";
    }

    return $traceString;
}

// Check PHP version compatibility
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    die('PHP version must be 5.3.0 or higher');
}

// Custom error handler
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    $errorType = match ($errno) {
        E_WARNING => 'Warning',
        E_NOTICE => 'Notice',
        default => 'Error'
    };

    Controller::error('Debug', [
        'errorMessage' => "{$errorType}: $errstr in $errfile on line $errline",
        'stackTrace' => getDebugBacktraceAsString(),
    ]);
    exit;
});

// Custom exception handler
set_exception_handler(function ($exception) {
    Controller::error('Debug', [
        'errorMessage' => "Uncaught Exception: " . $exception->getMessage(),
        'stackTrace' => $exception->getTraceAsString(),
    ]);
    exit;
});
