<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class TeamStoreRequest extends FormRequest
{
	public function rules()
	{
		return [
			'name' => 'required|string|max:255',
		];
	}

	public function authorize()
	{
		return true;
	}
}
