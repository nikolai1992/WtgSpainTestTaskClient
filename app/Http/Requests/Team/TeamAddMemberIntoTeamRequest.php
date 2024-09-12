<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class TeamAddMemberIntoTeamRequest extends FormRequest
{
	public function rules()
	{
		return [
			'user_id' => 'required|integer',
		];
	}

	public function authorize()
	{
		return true;
	}
}
