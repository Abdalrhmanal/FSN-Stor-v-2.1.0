<?php
// app/Http/Requests/ImportCodesRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportCodesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|mimes:txt|max:10240', // نوع الملف يجب أن يكون txt والحجم لا يتجاوز 10 كيلوبايت
            'category_id' => 'required|exists:categories,id', // يجب أن يكون هذا النوع موجود في جدول الفئات
            'price' => 'required|numeric', // يجب أن يكون السعر رقمًا
        ];
    }
}
?>
