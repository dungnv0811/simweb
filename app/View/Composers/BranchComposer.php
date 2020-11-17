<?php


namespace App\View\Composers;


use App\Services\BranchService;
use Illuminate\View\View;

class BranchComposer
{
    public function compose(View $view)
    {
       $branches = BranchService::branches();
       $view->with('branches', $branches);
    }

}
