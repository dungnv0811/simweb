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
        $names =  [];
        try {
            foreach ($images as $key => $image) {
                $ext = is_object($image) ? $image->getClientOriginalExtension() :  pathinfo($image)['basename'];
                $filename = time() . '-' .  uniqid() .  '.' . $ext;
                $image->move(public_path('uploads/images' . DIRECTORY_SEPARATOR  . $folder), $filename);
                $names[$key] = $filename;
            }
        } catch (\Exception $e) {
            info($e);
        }
        return $names;
    }

    public function getImageUrl($images, string $path)
    {
        $result = [];
        foreach ($images as $key => $image) {
            $result[$key] = storage_path('images' . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $image);
        }
        return $result;
    }

}
