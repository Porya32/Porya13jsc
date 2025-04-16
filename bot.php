<?php

// توکن ربات تلگرام
$token = '7697115911:AAGEOJNC7bhv-nui_4u9x4lknQGsLyWuIr4';
$apiUrl = "https://api.telegram.org/bot$token";

// دریافت درخواست‌های جدید
$update = json_decode(file_get_contents('php://input'), true);
$chatId = $update['message']['chat']['id'];
$message = $update['message']['text'];

// لیست شبکه‌ها
$channels = [
    'IRIB TV1' => 'https://tv1.ir/live',
    'IRIB TV2' => 'https://tv2.ir/live',
    'IRIB TV3' => 'https://tv3.ir/live',
];

// اگر پیام ارسالی نام یکی از شبکه‌ها باشد
if (array_key_exists($message, $channels)) {
    $streamUrl = $channels[$message];
    sendMessage($chatId, "شما در حال تماشای: $message \n $streamUrl");
} else {
    sendMessage($chatId, "لطفاً نام شبکه تلویزیونی را وارد کنید.");
}

// ارسال پیام به تلگرام
function sendMessage($chatId, $text) {
    global $apiUrl;
    file_get_contents("$apiUrl/sendMessage?chat_id=$chatId&text=" . urlencode($text));
}

?>
