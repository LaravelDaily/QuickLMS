<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpatieMediaController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        if (! $request->has('model_name') && ! $request->has('file_key') && ! $request->has('bucket')) {
            return abort(500);
        }

        $model = 'App\\' . $request->input('model_name');
        try {
            $model = new $model();
        } catch (ModelNotFoundException $e) {
            abort(500, 'Model not found');
        }

        $files      = $request->file($request->input('file_key'));
        $addedFiles = [];
        foreach ($files as $file) {
            try {
                $media        = $model->addMedia($file)->toMediaLibrary($request->input('bucket'));
                $addedFiles[] = $media;
            } catch (\Exception $e) {
                abort(500, 'Could not upload your file');
            }
        }

        return response()->json(['files' => $addedFiles]);
    }
}
