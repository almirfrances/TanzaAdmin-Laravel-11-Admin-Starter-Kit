<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class BreadcrumbComposer
{
    public function compose(View $view)
    {
        $breadcrumbs = session('breadcrumbs', []);

        $view->with('breadcrumbs', $breadcrumbs);
    }
}
