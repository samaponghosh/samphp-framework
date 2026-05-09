<?php

/**
 * SamPHP Framework — Mailer
 *
 * A placeholder mailer class. Extend this with your preferred
 * email library (e.g., PHPMailer, SwiftMailer) for production use.
 *
 * Usage:
 *   Mailer::send('user@example.com', 'Subject', '<p>HTML body</p>');
 */

class Mailer
{
    /**
     * Send an email.
     *
     * Override this method with your preferred mail library.
     *
     * @param string $to Recipient email address
     * @param string $subject Email subject line
     * @param string $body Email body (HTML supported)
     * @param array $headers Optional additional headers
     * @return bool True on success
     */
    public static function send($to, $subject, $body, $headers = [])
    {
        $defaultHeaders = [
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=UTF-8',
            'From: ' . (defined('APP_NAME') ? APP_NAME : 'SamPHP') . ' <noreply@localhost>',
        ];

        $allHeaders = array_merge($defaultHeaders, $headers);

        return mail($to, $subject, $body, implode("\r\n", $allHeaders));
    }
}