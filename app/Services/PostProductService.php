<?php


namespace App\Services;

use App\Libraries\Traits\Image;
use App\Models\PostProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostProductService
{
    use Image;

    /**
     * @var PostProduct
     */
    private $product;

    public function __construct(PostProduct $product)
    {
        $this->product = $product;
    }

    private function handleParam(array $param): array
    {
        $userId = Auth::id();
        $param['price'] = filter_var($param['price'], FILTER_SANITIZE_NUMBER_INT);
        $param['slug'] = $userId . '-' . time();
        $param['user_id'] = $userId;
        $param['short_description'] = substr($param['description'], 0, 160);
        return $param;
    }

    public function createProduct(Request $request)
    {
        $param = $request->only($this->product->getFillable());
        if ($request->hasFile('images')) {
            $param['images'] = json_encode($this->upload($param['images'], config('define.image.product')));
        }
        $data = $this->handleParam($param);
        $this->product->create($data);
    }


    public function getProductDetail($slug)
    {

        $columns = [
            'posts.*',
            'wards.path_with_type',
            'users.name AS username',
            'users.phone AS phone_number',

        ];
        $condition = [
            'posts.slug' => $slug
        ];
        return $this->product
            ->ward()
            ->user()
            ->where($condition)
            ->firstOrFail($columns);

    }

    /**
     * @param Request $request
     */
    public function updateProduct(Request $request)
    {
        $param = $request->only($this->product->getFillable());
        $data = $this->handleParam($param);
        $condition = ['posts.id' => $request->get('id')];
        $this->product->where($condition)->update($data);
    }

    public function getProducts(Request $request)
    {
        $column = ['posts.*'];
        $condition = [];
            if ($request->get('title')) {
                $condition[] = ['title', 'LIKE', '%' . $request->get('title') . '%'];
            }
            if ($request->get('ward')) {
                $condition[] = ['wards.code', '=', $request->get('ward')];
            }
            if ($request->get('city')) {
                $condition[] = ['cities.code', '=', $request->get('city')];
            }
            if ($request->get('district')) {
                $condition[] = ['districts.code', '=', $request->get('district')];
            }
            if ($request->get('price') && $request->get('price') != 10) {
                // TODO whereBetween('price', [$min_price, $max_price])
                $splitPrice = explode(',', $request->get('price'), 2);
                $minPrice = $splitPrice[0] * 1000000;
                $maxPrice = $splitPrice[1] * 1000000;
                $condition[] = [
                    function($query) use ($minPrice, $maxPrice) {
                        $query->where([
                            ['price', '>=', $minPrice],
                            ['price', '<=', $maxPrice],
                        ]);

                    }
                ];
            }
        return $this->product
            ->address()
            ->statusApprovedCondition()
            ->where($condition)
            ->orderByDesc('posts.id')
            ->paginate(6, $column);
    }

    public function getProductSuggestion()
    {
        $condition = [
            'is_recommended' => PostProduct::IS_RECOMMEND
        ];
        return $this->product
            ->where($condition)
            ->paginate(6);
    }

    /**
     * @param $id
     */
    public function changeStatusProduct($id)
    {
        $param = ['status' => PostProduct::APPROVED];
        try {
            $this->product
                ->where(['posts.id' => $id])
                ->update($param);
        } catch (\Exception $e) {
            info($e);
            return false;
        }
        return true;

    }


    public function deleteProduct(Request $request)
    {
        $post = $this->product->findOrFail($request->get('id'));
        $this->deleteImage($post->images);
        $post->delete();
    }

}
