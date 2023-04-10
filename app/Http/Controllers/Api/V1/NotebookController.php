<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotebookRecordRequest;
use App\Http\Requests\UpdateNotebookRecordRequest;
use App\Http\Resources\V1\NotebookResource;
use App\Models\NotebookRecord;
use App\Models\User;
use App\Services\NotebookService;
use App\Services\TokenService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NotebookController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $records = NotebookRecord::filter($request->all())->simplePaginateFilter(10);

        return NotebookResource::collection($records);
    }

    public function show(Request $request, int $id)
    {
        $record = NotebookRecord::findOrFail($id);

        return new NotebookResource($record);
    }

    public function store(StoreNotebookRecordRequest $request)
    {
        $data = $request->validated();
        $record = NotebookService::storeRecord($data);

        return new NotebookResource($record);
    }

    public function update(UpdateNotebookRecordRequest $request, int $id)
    {
        $data = $request->validated();
        $record = NotebookRecord::findOrFail($id);
        $updated_record = NotebookService::updateRecord($record, $data);

        return new NotebookResource($updated_record);
    }

    public function delete(Request $request, int $id)
    {
        return NotebookService::deleteRecord($id);
    }
}
