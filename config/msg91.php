<?php

return [

    'base_url' => 'https://api.msg91.com/api/v5/',

    /* Auth key from msg91  (required) */
    'auth_key' => env('MSG91_API_KEY', ''),

    /* Default sender id (required) */
    'sender_id' => env('MSG91_SENDER_ID', ''),

    /* Default sender email (required) */
    'sender_email' => env('MSG91_SENDER_EMAIL', ''),

    /* Default route, 1 for promotional, 4 for transactional id (required) */
    'route' => env('MSG91_ROUTE', 4),

    /* Country option, 0 for international, 91 for India, 1 for US (optional) */
    'country' => env('MSG91_COUNTRY', 91),

    /* Otp expiry in minutes */
    'otp_expiry' => 5,

    // 'map' => [
    //     \App\Lib\Template::EXPIRY_REMINDER => 'sms.expiry_reminder',
    //     \App\Lib\Template::EXPIRED => 'sms.expired',
    //     \App\Lib\Template::AUTO_RENEW_REMINDER => 'sms.auto_renew_reminder',
    //     \App\Lib\Template::RENEWED => 'sms.renewed',
    //     \App\Lib\Template::ACTIVATED => 'sms.activated',
    //     \App\Lib\Template::FAILED => 'sms.failed',
    //     \App\Lib\Template::SEND_OTP => 'sms.send_otp',
    // ],

    'status_code' => [
        505 => "Demo account",
        418 => "IP not whitelisted",
        200 => "Ok",
        101 => "Missing mobile no.",
        102 => "Missing message",
        103 => "Missing sender ID",
        105 => "Missing password",
        106 => "Missing Authentication Key",
        107 => "Missing Route",
        202 => "Invalid mobile number. You must have entered either less than 10 digits or there is an alphabetic character in the mobile number field in API.",
        203 => "Invalid sender ID. Your sender ID must be 6 characters, alphabetic.",
        207 => "Invalid authentication key. Crosscheck your authentication key from your account’s API section.",
        208 => "IP is blacklisted. We are getting SMS submission requests other than your whitelisted IP list.",
        301 => "Insufficient balance to send SMS",
        302 => "Expired user account. You need to contact your account manager.",
        303 => "Banned user account",
        306 => "This route is currently unavailable. You can send SMS from this route only between 9 AM - 9 PM.",
        307 => "Incorrect scheduled time",
        308 => "Campaign name cannot be greater than 32 characters",
        309 => "Selected group(s) does not belong to you",
        310 => "SMS is too long. System paused this request automatically.",
        311 => "Request discarded because same request was generated twice within 10 seconds"
    ]
];
