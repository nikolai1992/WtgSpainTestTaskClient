<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\TeamAddMemberIntoTeamRequest;
use App\Http\Requests\Team\TeamStoreRequest;
use App\Services\WTGApiServices;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    private WTGApiServices $wtgApiService;
    public function __construct()
    {
        $this->wtgApiService = app(WTGApiServices::class);
    }
	public function index()
	{
        $teams = $this->wtgApiService->getTeams();
        return view('dashboard.team.index', compact('teams'));
	}

	public function create()
	{
        return view('dashboard.team.create');
	}

	public function store(TeamStoreRequest $request)
	{
        $data = $request->validated();
        $team = $this->wtgApiService->storeTeam($data);
        if ($team) {
            return redirect()->route('team.index');
        } else {
            return redirect()->back();
        }
	}

	public function show($id)
	{

	}

	public function edit($id)
	{
        $team = $this->wtgApiService->showTeam($id);

        return view('dashboard.team.edit', compact('team'));
	}

	public function update(Request $request, $id)
	{
	}

	public function destroy($id)
	{
	}

    public function addMember(int $teamId)
    {
        $members = $this->wtgApiService->getAllMembers();

        return view('dashboard.team.add-member', compact('members', 'teamId'));
    }

    public function removeMemberRequest(int $teamId, int $userId)
    {
        $this->wtgApiService->removeMemberFromTeam($teamId, $userId);
        return redirect()->route('team.index');
    }

    public function addMemberRequest(TeamAddMemberIntoTeamRequest $request, int $teamId)
    {
        $data = $request->validated();
        $this->wtgApiService->addMemberIntoTeam($teamId, $data);

        return redirect()->route('team.index');
    }
}
