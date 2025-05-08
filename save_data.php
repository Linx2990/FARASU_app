<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // دریافت اطلاعات از فرم
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $phone = $_POST["phone"] ?? "";

    // بررسی خالی بودن فیلدها
    if (empty($name) || empty($email) || empty($phone)) {
        die("لطفاً تمام فیلدها را پر کنید.");
    }

    // ساخت آرایه‌ای از داده‌ها
    $user_data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
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

    echo "اطلاعات با موفقیت ذخیره شد.";
} else {
    die("دسترسی غیرمجاز.");
}
?>
