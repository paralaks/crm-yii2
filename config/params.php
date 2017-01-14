<?php

$serverDomain = str_ireplace(['http://', 'https://', 'www.'], '', SERVER_DOMAIN);

return [
    'adminEmail' => 'admin@'.$serverDomain,
    'supportEmail' => 'support@'.$serverDomain,
    'user.passwordResetTokenExpire' => 60 * 60 * 24,
];
