<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // دریافت اطلاعات از درخواست POST
    $data = json_decode(file_get_contents("php://input"), true);

    // بررسی خالی بودن فیلدها
    if (empty($data['name']) || empty($data['email']) || empty($data['phone'])) {
        http_response_code(400);
        echo json_encode(["message" => "لطفاً تمام فیلدها را پر کنید."]);
        exit();
    }

    // ساخت آرایه‌ای از داده‌ها
    $user_data = [
        'name' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'created_at' => date('Y-m-d H:i:s')
    ];

    // خواندن داده‌های قبلی از فایل JSON
    $file_path = 'data.json';
    if (file_exists($file_path)) {
        $current_data = json_decode(file_get_contents($file_path), true);
    } else {
        $current_data = [];
    }

    // اضافه کردن داده‌های جدید به داده‌های قبلی
    $current_data[] = $user_data;

    // ذخیره داده‌ها در فایل JSON
    file_put_contents($file_path, json_encode($current_data, JSON_PRETTY_PRINT));

    // ارسال پاسخ موفقیت‌آمیز
    echo json_encode(["message" => "اطلاعات با موفقیت ذخیره شد."]);
} else {
    http_response_code(405);
    echo json_encode(["message" => "روش درخواست مجاز نیست."]);
}
?>
