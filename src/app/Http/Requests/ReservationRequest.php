<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'store_id' => 'required|exists:stores,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'number_of_people' => 'required|integer|min:1|max:9',
        ];
    }
    public function attributes()
    {
        return [
            'store_id' => '店舗ID',
            'date' => '予約日',
            'time' => '予約時間',
            'number_of_people' => '人数',
        ];
}
}