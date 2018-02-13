<?php
if (!function_exists('logger'))
{
    /**
     * Writes a trace message to a log file.
     */
    function trace_log($message, $file = NULL)
    {
        $default = '/tmp/yunet/debug.log';

        if (is_object($message) && is_array($message)) {
            $message = var_export($message);
        }

        if (!$file) {
            $file = $default;
        }

        if (!file_exists(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }

        if (!$fileHandler = fopen($file, 'a')) {
            throw new \Exception('Cannot open file: ' . $file);
        }

        $message = '[' . date('Y-m-d H:i:s') . ']' . 'INFO:' . $message . "\n";

        if (fwrite($fileHandler, $message) === false) {
            throw new \Exception('Cannot write to file: ' . $file);
        }

        fclose($fileHandler);
    }
}

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

