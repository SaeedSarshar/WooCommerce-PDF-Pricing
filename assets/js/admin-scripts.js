jQuery(document).ready(function($) {
    // افزودن سایز جدید
    $("#add-size").on("click", function() {
        const index = $("#pricing-table tr").length; // شمارش ردیف‌های جدول
        const row = `
            <tr>
                <td><input type="text" name="pricing_table[${index}][size]" placeholder="Size" required></td>
                <td>
                    <button type="button" class="add-range button">Add Range</button>
                </td>
                <td><button type="button" class="remove-size button">Remove</button></td>
            </tr>`;
        $("#pricing-table").append(row); // افزودن ردیف جدید به جدول
    });

    // حذف سایز
    $(document).on("click", ".remove-size", function() {
        $(this).closest("tr").remove(); // حذف سایز (ردیف)
    });

    // افزودن بازه جدید
    $(document).on("click", ".add-range", function() {
        const range = `
            <div class="range-row">
                <input type="number" name="" placeholder="Min" required>
                <input type="number" name="" placeholder="Max" required>
                <input type="number" name="" placeholder="Price Per Page" required>
                <button type="button" class="remove-range button">Remove</button>
            </div>`;
        $(this).before(range); // افزودن بازه به قسمت قبل از دکمه
    });

    // حذف بازه
    $(document).on("click", ".remove-range", function() {
        $(this).closest(".range-row").remove(); // حذف بازه
    });
});
