<?php

namespace App\View\Composers;

use Illuminate\View\View;

class PublishComposer
{
    /**
     * Bind data to the view.
     * Bind data vào view. $view->with('ten_key_se_dung_trong_view', $data);
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $publishs = [
            '1' => 'Hoạt động',
            '2' => 'Bị khóa',
        ];
        $follows = [
            '1' => 'Theo dõi',
            '2' => 'Không theo dõi',
        ];
        $view->with([
            'publishs' => $publishs,
            'follows' => $follows,
        ]);
    }
}