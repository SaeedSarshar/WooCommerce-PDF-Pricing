function wc_pdf_pricing_settings_page() {
    // بررسی دسترسی مدیر
    if (!current_user_can('manage_options')) {
        return;
    }

    // ذخیره تنظیمات اگر فرم ارسال شده است
    if (isset($_POST['wc_pdf_pricing_save'])) {
        $pricing_table = isset($_POST['pricing_table']) ? json_encode($_POST['pricing_table']) : '';
        update_option('wc_pdf_pricing_table', $pricing_table);
        echo '<div class="updated"><p>تنظیمات ذخیره شد.</p></div>';
    }

    // بازیابی تنظیمات ذخیره‌شده
    $pricing_table = json_decode(get_option('wc_pdf_pricing_table', '[]'), true);

    // اطمینان از آرایه بودن جدول قیمت‌ها
    if (!is_array($pricing_table)) {
        $pricing_table = [];
    }

    // شروع HTML تنظیمات
    echo '<div class="wrap">';
    echo '<h1>تنظیمات قیمت‌گذاری PDF</h1>';
    echo '<form method="post">';
    echo '<table class="form-table">';
    echo '<thead>
            <tr>
                <th>سایز</th>
                <th>بازه‌ها (حداقل - حداکثر - قیمت هر صفحه)</th>
                <th>عملیات</th>
            </tr>
          </thead>';
    echo '<tbody id="pricing-table">';

    // حلقه برای نمایش داده‌های موجود در جدول قیمت
    foreach ($pricing_table as $index => $entry) {
        echo '<tr>
                <td><input type="text" name="pricing_table[' . $index . '][size]" value="' . esc_attr($entry['size'] ?? '') . '" required></td>
                <td>';
        if (!empty($entry['ranges'])) {
            foreach ($entry['ranges'] as $range_index => $range) {
                echo '<div>
                        <input type="number" name="pricing_table[' . $index . '][ranges][' . $range_index . '][min]" placeholder="حداقل" value="' . esc_attr($range['min'] ?? '') . '" required>
                        <input type="number" name="pricing_table[' . $index . '][ranges][' . $range_index . '][max]" placeholder="حداکثر" value="' . esc_attr($range['max'] ?? '') . '" required>
                        <input type="number" name="pricing_table[' . $index . '][ranges][' . $range_index . '][price_per_page]" placeholder="قیمت هر صفحه" value="' . esc_attr($range['price_per_page'] ?? '') . '" required>
                        <button type="button" class="remove-range button">حذف بازه</button>
                      </div>';
            }
        }
        echo '<button type="button" class="add-range button">افزودن بازه</button>';
        echo '</td>
              <td><button type="button" class="remove-size button">حذف سایز</button></td>
              </tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '<button type="button" id="add-size" class="button">افزودن سایز</button>';
    echo '<br><br>';
    echo '<input type="submit" name="wc_pdf_pricing_save" class="button-primary" value="ذخیره تنظیمات">';
    echo '</form>';
    echo '</div>';
}
