<?php

namespace App\Http\Livewire\Admin\Post;

use Livewire\Component;
use App\Models\BlCategory;
use App\Models\BlNavigation;
use App\Models\BlPosts;
use Livewire\WithFileUploads;

class ManagePost extends Component
{

    
    use WithFileUploads;

    
    public $ids = 0;
    public $delete_id='';
    public $searchTerm;
    public $orderterm = 'desc';

    protected $listeners = ['deleteConfirmed' => 'post_delete'];


    public function destroy($id) // delete requiring confirmation
    {
        $post = BlPosts::where('blp_key',$id)->firstOrFail();
        $pname = $post->blp_title;  
        $this->dispatchBrowserEvent('swal:delete', ['title'=> 'Are you sure? ',
            'text'=> "want to delete this Blog Post? : $pname ",
            'icon'=> 'warning',
            'showCancelButton'=> true,
            'confirmButtonColor'=> '#3085d6',
            'cancelButtonColor'=> '#d33',
            'confirmButtonText' => 'Yes, delete it!',
        ]);

        $this->delete_id = $id;

    }

    public function post_delete() //delete after confirmation
    {
        $post = BlPosts::where('blp_key', $this->delete_id);       
        $post->delete();

        $this->dispatchBrowserEvent('swal', [
            'icon'=>'success',
            'title'=> 'Blog Post Successfully Deleted',
            'showConfirmButton'=> false,
            'timer'=> 2000
        ]);

    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';

        $bPosts = BlPosts::join('bl_categories', 'bl_categories.id', 'blpcat_id')
        ->select('blp_key', 'blp_title', 'blp_slug', 'blp_active', 
        'bl_posts.created_at as postedon', 'bl_categories.blc_key as catkey', 'bl_categories.blc_name as catname')
        ->where('blp_title','like',$searchTerm )
        ->orderBy('bl_posts.id',$this->orderterm)
        ->get();


        return view('livewire.admin.post.manage-post',compact('bPosts'));
    }
}
