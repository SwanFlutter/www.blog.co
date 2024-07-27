<?php

namespace Traits;

trait Response
{
    public function jsonMsg(bool $success, string $message, $status = null, $data = null) {
        if ($status == null) {
            $status = http_response_code();
        } else {
            $status = http_response_code($status);
        }

        $msg = [
            'success' => $success,
            'message' => $message,
            'status' => $status
        ];
        if ($data) {
            $msg['data'] = $data;
        }
        return json_encode($msg);
    }

    public function sanitizeInput($input) {
        if (is_array($input)) {
            return array_map([self::class, 'sanitizeValue'], $input);
        } else {
            return self::sanitizeValue($input);
        }
    }

    public function sanitizeValue($value) {
        $sanitizedValue = trim($value);
        $sanitizedValue = filter_var($sanitizedValue, FILTER_DEFAULT);
        $sanitizedValue = htmlspecialchars($sanitizedValue, ENT_QUOTES, 'UTF-8');
        return $sanitizedValue;
    }
}

