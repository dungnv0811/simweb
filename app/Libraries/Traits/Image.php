<?php


namespace App\Libraries\Traits;


use Illuminate\Http\UploadedFile;


trait Image
{
    private $storage;

    public function __construct($storage)
    {
        $this->storage = config('filesystems.disks.' . config('filesystems.default'));
    }

    public function upload(array $images, string $folder)
    {
        try {
            foreach ($images as $image) {
                $ext = is_object($image) ? $image->getClientOriginalExtension() :  pathinfo($image)['basename'];
                $filename = time() . '-' .  uniqid() .  '.' . $ext;
                $image->move(storage_path('images' . DIRECTORY_SEPARATOR  . $folder), $filename);
            }
        } catch (\Exception $e) {
            info($e);
        }
        return $filename;
    }

}