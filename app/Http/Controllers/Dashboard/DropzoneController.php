<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Dropzone\StoreRequest;
use RuntimeException;

class DropzoneController extends Controller
{
    public function store(StoreRequest $request)
    {
        $path = storage_path('tmp/uploads');
        if (!file_exists($path)) {
            if (!mkdir($path, 0755, true) && !is_dir($path)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
            }
        }

        $file = $request->file('file');
        $originalName = date('HisYmd') . time() . random_int(1111, 99999) . '.' . $file->getClientOriginalExtension();
        $name = uniqid('', true) . '_' . $originalName;
        $file->move($path, $name);

        return response()->json([
            'original_name' => $originalName,
            'name'          => $name,
        ]);
    }
}
