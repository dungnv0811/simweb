<?php


namespace App\Libraries\Traits;


use Illuminate\Http\UploadedFile;
use \Intervention\Image\Facades\Image As InterventionImage;
use Illuminate\Support\Facades\Storage;


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
                $resizeImage = InterventionImage::make($image);
                //Resize image.
                $resizeImage
//                    ->resize(100, 100, function($constraint){
//                        $constraint->aspectRatio();
//                    })
                    ->save(public_path('uploads/images' . DIRECTORY_SEPARATOR  . $folder  . DIRECTORY_SEPARATOR . $filename), 60);
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

    /**
     * @param $images
     */
    public function deleteImage($images)
    {
        try {
            foreach (json_decode($images) as $key => $image) {
                unlink(public_path('uploads/images' . DIRECTORY_SEPARATOR . config('define.image.product') . DIRECTORY_SEPARATOR . $image));
            }
        } catch (\Exception $e) {
            info($e);
        }
    }

}
