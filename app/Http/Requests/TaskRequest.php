<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => 'required|max:50',
            'limit-time' => 'required|date_format:Y/m/d H:i:s',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タスク名',
            'limit-time' => '期限日時',
        ];
    }
}
