<?php

namespace App\Http\Controllers\Backend\Api\Markdown;

use App\Http\Controllers\Controller;
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
        return $this->getAllImages();
    }

    /**
     * Upload images
     *
     */
    public function upload()
    {
        $this->validate(request(), [
            'image' => 'required|file|image|max:5000'
        ]);

        $this->uploadImage(request()->file('image'));

        $images = $this->getAllImages();

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
}
