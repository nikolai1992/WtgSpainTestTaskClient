<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
	public function rules(): array
	{
		return [
            'title'       => 'required|max:255',
            'description' => 'nullable',
            'status'      => 'max:255|required',
            'team_id'     => 'nullable|numeric|integer',
		];
	}
}
