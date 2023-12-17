<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;

class PostCatalogueComposer
{
    /**
     * Bind data to the view.
     * Bind data vào view. $view->with('ten_key_se_dung_trong_view', $data);
     * @param  View  $view
     * @return void
     */
    protected $postCatalogueRepository;
    public function __construct(
        PostCatalogueRepository $postCatalogueRepository
    )
    {
        $this->postCatalogueRepository = $postCatalogueRepository;
    }

    public function compose(View $view)
    {
        $postCatalogues = [
            '1' => 'Danh mục 1',
            '2' => 'Danh mục 2',
            '3' => 'Danh mục 3',
        ];
        // $postCatalogues = $this->postCatalogueRepository->pagination($request);
        $view->with('postCatalogues', $postCatalogues);
    }
}