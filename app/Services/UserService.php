<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function updateUser(Request $request, $id)
    {
        $param = $request->only($this->user->getFillable());
        try {
            $this->user->where(['users.id' => $id])->update($param);
        } catch (\Exception $e) {
            info($e);
            return false;
        }
        return true;

    }

}
