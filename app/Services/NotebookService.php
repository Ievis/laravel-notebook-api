<?php

namespace App\Services;

use App\Models\NotebookRecord;

class NotebookService
{
    public static function storeRecord(array $data)
    {
        $image = FileService::save(request()->file);
        $data = array_merge($data, [
            'user_id' => TokenService::getUserByToken()->id,
            'image' => $image
        ]);

        return NotebookRecord::create($data);
    }

    public static function updateRecord(NotebookRecord $record, array $data)
    {
        $image = FileService::save(request()->file);
        $data = array_merge($data, [
            'image' => $image
        ]);
        $record->update($data);

        return $record;
    }

    public static function deleteRecord(int $id)
    {
        $is_deleted = NotebookRecord::destroy($id);

        return self::getDeletedJSON($is_deleted);
    }

    private static function getDeletedJSON(bool $is_deleted)
    {
        $error_code = $is_deleted ? 0 : 1;

        return response()->json([
            'success' => $is_deleted,
            'error-code' => $error_code,
            'message' => 'Record was deleted successfully'
        ]);
    }
}
