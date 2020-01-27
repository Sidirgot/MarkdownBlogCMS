<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HandleImages
{

    /**
     * References one of the disk drives declared in config/filesystems
     *
     * @var string
     */
    private $disk = 'public_uploads';

    /**
     * References the name of the folder to be used inside the disk
     *
     * @var string
     */
    private $folder_name = 'uploads';

    /**
     * Uploads an Image to the $disk/$folder_name,
     * Var $profile indicates if the file is a user's profile avatar,
     * if $profile is set to true, the file is saved under the
     * assets folder in the specified disk
     *
     * @param \Illuminate\Http\UploadedFile $image
     */
    public function uploadImage($image, $profile = false)
    {
        return $image->storeAs($profile ? 'assets' : $this->folder_name, $image->getClientOriginalName(), $this->disk);
    }

    /**
     * Deletes an image from the disk and uploads a new One
     * $profile var indicates if the file is a user profile avatar
     * if $profile is set to true, the file is saved under the
     * assets folder in the specified disk
     *
     * @param string $oldImage path
     * @param \Illuminate\Http\UploadedFile $newImage
     * @param boolean $profile
     */
    public function updateImage($oldImage, $newImage, $profile = false)
    {
        $this->deleteImage($oldImage);

        return $this->uploadImage($newImage, $profile ? true : '');
    }

    /**
     * Deletes an image from the $disk/$folder_name
     *
     * @param string $image path
     */
    public function deleteImage($image)
    {
        if (Storage::disk($this->disk)->exists($image)) {
            Storage::disk($this->disk)->delete($image);
        };
    }

    /**
     * Get's every image from the $disk/$folder_name
     *
     * @return array $image with the image and the full url
     */
    public function getAllImages()
    {
        $images = [];
        // Get all the files from the specified folder on the disk.
        $files =  Storage::disk($this->disk)->files($this->folder_name);

        foreach ($files as $key => $file) {
            // Create a full url for each image.
            $url = url('/') . '/' . $file;

            // Add 2 keys in a returned array for the actual image and its full url
            $images[$key]['image'] = $file;
            $images[$key]['url'] = $url;
        }

        return $images;
    }
}
