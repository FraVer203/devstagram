<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListarPost extends Component
{

    // Aquí le estamos pasando la información de home.blade a listar-post.blade
    public $posts;
    public function __construct($posts)
    {
        // Aquí traemos la variable que no lee
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.listar-post');
    }
}
