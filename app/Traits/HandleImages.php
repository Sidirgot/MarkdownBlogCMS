<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Image;

trait HandleImages
{
   /**
     * Working Disk.
     * 
     * @var string
     */
    private string $workingDisk = 'public';

    /**
     * Working Directory.
     * 
     * @var string
     */
    private string $workingDir;

    /**
     * Image Width
     *
     * @var integer
     */
    private $width = 800;

    /**
     * Set the working disk.
     *
     * @param string
     */
    public function disk(string $disk = null)
    {
        $this->workingDisk = $disk ? $disk : $this->workingDisk;

        return $this;
    }

    /**
     * Set the working folder.
     *
     * @param string $folder
     */
    public function folder(string $folder)
    {
        $this->workingDir = $folder . '/';

        return $this;
    }

    /**
     * Set the image width
     *
     * @param int $width
     */
    public function setWidth(int $width)
    {
        $this->width = $width ? $width : $this->width;

        return $this;
    }

    /**
     * Uploads an Image to the $workingDisk/$workingDir storage foler.
     *
     * @param \Illuminate\Http\UploadedFile $image
     */
    public function uploadImage(UploadedFile $image)
    {
        $imageName = $this->generateName($image->getClientOriginalExtension());

        $resizedImage = $this->resize($image);

        $this->save($imageName, $resizedImage);

        return $this->workingDir . $imageName;
    }

    /**
     * Deletes an image from the workingDisk/workingDir.
     *
     * @param string $oldImage path
     * @param \Illuminate\Http\UploadedFile $newImage
     */
    public function updateImage(string $oldImage, UploadedFile $newImage)
    {
        $this->deleteImage($oldImage);

        return $this->uploadImage($newImage);
    }

    /**
     * Deletes an image from the workingDisk/workingDir.
     *
     * @param string $image path
     */
    public function deleteImage($image)
    {
        if (Storage::disk($this->workingDisk)->exists($image)) {
            Storage::disk($this->workingDisk)->delete($image);
        };
    }

    /**
     * Resize the image to specified width maintaining the aspect ratio.
     *
     * @param UploadedFile $image
     */
    protected function resize(UploadedFile $image)
    {
        $result = Image::make($image)->resize($this->width, null, function ($constraint) {
            $constraint->aspectRatio();     
        });

        $result->stream();

        return $result;
    }

    /**
     * Save the image to the workingDisk/workingDir.
     *
     * @param string $imageName
     * @param $image
     * @return void
     */
    protected function save(string $imageName, $image)
    {
        Storage::disk($this->workingDisk)->put($this->workingDir . $imageName, $image);
    }

    /**
     * Get's every image from the $workingDisk/$workingDir
     *
     * @return array with 2 keys [ image and full url of the image ]
     */
    public function get_all_images()
    {
        $images = [];
        // Get all the files from the specified folder on the disk.
        $files =  Storage::disk($this->workingDisk)->files($this->workingDir);

        foreach ($files as $key => $file) {
            // Create a full url for each image.
            $url = url('/') . '/storage/' . $file;

            // Add 2 keys in a returned array for the actual image and its full url
            $images[$key]['image'] = $file;
            $images[$key]['url'] = $url;
        }

        return $images;
    }

     /**
     * Generate image name based on the current unix time.
     *
     * @param [type] $mime
     * @return string
     */
    protected function generateName($mime)
    {
        return time().".".$mime;
    }
}
