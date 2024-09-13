<?php

namespace App\Http\Controllers\Dashboard\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskCommentStoreRequest;
use App\Services\WTGApiServices;
use Illuminate\Http\Request;

class TaskCommentController extends Controller
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
    }

    public function store(TaskCommentStoreRequest $request)
    {
        $data = $request->validated();
        $this->wtgApiService->storeComment($request->task_id, $data);

        return redirect()->route('task.show', $request->task_id);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        $this->wtgApiService->deleteComment($id);

        return redirect()->back();
    }
}
