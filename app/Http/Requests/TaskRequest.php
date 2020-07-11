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

    protected function prepareForValidation()
    {
        $this->merge([
            'project_id' => trim($this->project_id) !== '' ? $this->project_id : NULL,
        ]);
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
            'limit_at' => 'required|date_format:Y/m/d',
            'project_id' => 'nullable|integer'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タスク名',
            'limit_at' => '期限日時',
            'project_id' => 'プロジェクト',
        ];
    }
}
