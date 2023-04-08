<?php

namespace App\Http\Livewire\Admin\Post;

use Livewire\Component;
use App\Models\BlCategory;
use App\Models\BlNavigation;
use App\Models\BlPosts;
use Livewire\WithFileUploads;

class AddPost extends Component
{

    use WithFileUploads;

    public $ptitle = '';
    public $pslug = '';
    public $pdesc = '';
    public $photo = [];
    public $pcat = '';
    public $pmtitle = '';
    public $pmkeyword = '';
    public $pmdesc = '';
    public $category = '';


    public function postSave()
    {

    }




    public function render()
    {
        $this->pslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->ptitle )));

        $blogCat = BlCategory::where('blc_active', '1')->orderBy('id', 'asc')->get(); 

        return view('livewire.admin.post.add-post', compact('blogCat'));
    }


}
