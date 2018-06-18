<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProjectFormRequest extends FormRequest
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
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'acceptance_criteria' => 'required|array',
            'start_date' => 'required',
            'deadline' => 'required',
            'impact' => 'required',
            'open_to' => 'required',
            'skills' => 'required|array',
            'max_users' => 'required|numeric|between:1,3',
            'estimated_hours' => 'required|numeric|max:20',
            'resources_link' => 'nullable|url',
            'flexible_start' => 'required|boolean',
            'on_site' => 'required|boolean',
            'renew' => 'required|boolean',
        ];
    }
}
