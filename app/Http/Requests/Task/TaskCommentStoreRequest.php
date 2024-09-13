<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskCommentStoreRequest extends FormRequest
{
	public function rules()
	{
		return [
			'content' => 'required|string',
            'task_id' => 'required|integer',
		];
	}

	public function authorize()
	{
		return true;
	}
}
