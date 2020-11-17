<?php


namespace App\Services;


use App\Models\Branch;

class BranchService extends BaseService
{
    private static $instance = NULL;


    private $branches = [];

    /**
     * BranchService constructor.
     */
    public function __construct()
    {
        $this->branches = Branch::pluck('name')->toArray();
    }

    public static function branches()
    {
        if (!self::$instance) {
            self::$instance = new BranchService();
        }
        return self::$instance->branches;
    }
}
