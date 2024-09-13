<?php

namespace App\Http\Controllers\Dashboard\Task;

use App\Enums\TaskStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Services\WTGApiServices;
use Carbon\Carbon;

class TaskController extends Controller
{
    private WTGApiServices $wtgApiService;
    public function __construct()
    {
        $this->wtgApiService = app(WTGApiServices::class);
    }
	public function index()
	{

	}

	public function create()
	{
        $statuses = TaskStatusEnum::cases();
        $teams = $this->wtgApiService->getTeams();

        return view('dashboard.task.create', compact('statuses', 'teams'));
	}

	public function store(TaskStoreRequest $request)
	{
        $data = $request->validated();
        $task = $this->wtgApiService->storeTask($data);
        if ($task) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }
	}

	public function show($id)
	{
        $task = $this->wtgApiService->showTask($id);
        $task->created_at = Carbon::parse($task->created_at)->format('Y-m-d H:i:s');
        $task->updated_at = Carbon::parse($task->updated_at)->format('Y-m-d H:i:s');
        $comments = $this->wtgApiService->showComments($id);

        return view('dashboard.task.show', compact('task', 'comments'));
	}

	public function edit($id)
	{
        $task = $this->wtgApiService->showTask($id);
        $task->created_at = Carbon::parse($task->created_at)->format('Y-m-d H:i:s');
        $task->updated_at = Carbon::parse($task->updated_at)->format('Y-m-d H:i:s');
        $statuses = TaskStatusEnum::cases();
        $teams = $this->wtgApiService->getTeams();

        return view('dashboard.task.edit', compact(
            'task',
            'statuses',
            'teams'
        ));
	}

	public function update(TaskUpdateRequest $request, $id)
	{
        $data = $request->validated();
        $task = $this->wtgApiService->updateTask($id, $data);

        if ($task) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }
	}

	public function destroy($id)
	{
        $this->wtgApiService->deleteTask($id);
        return redirect()->route('dashboard');
	}
}
