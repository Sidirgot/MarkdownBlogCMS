<?php

namespace App\Http\Controllers\Backend\Api\Markdown;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarkdownImageUploadRequest;
use App\Traits\HandleImages;

class MarkdownController extends Controller
{
    use HandleImages;

    /**
     * Get all the images from the public/uploads folder
     *
     * @return array with the image and the full url
     */
    public function index()
    {
        return $this->fetch_images();
    }

    /**
     * Upload images
     *
     * @param App\Http\Requests\MarkdownImageUploadRequest $request.
     */
    public function upload(MarkdownImageUploadRequest $request)
    {
        $this->folder('uploads')->uploadImage($request->validated()['image']);

        $images = $this->fetch_images();

        return response()->json($images, 201);
    }

    /**
     * Deletes an image from the disk
     *
     */
    public function destroy()
    {
        $this->deleteImage(request()->image);

        return response()->json('deleted', 200);
    }

    /**
     * Get all the images from the disk/folder.
     *
     * @return void
     */
    private function fetch_images()
    {
        return $this->folder('uploads')->get_all_images();
    }
}
