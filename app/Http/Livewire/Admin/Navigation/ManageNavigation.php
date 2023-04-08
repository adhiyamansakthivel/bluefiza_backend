<?php

namespace App\Http\Livewire\Admin\Navigation;

use Livewire\Component;
use App\Models\BlNavigation;

class ManageNavigation extends Component
{
    public $navname = '';
    public $navcolor = '';
    public $navSlugName;
    public $slugValue;
    public $delete_id;
    public $countDummy = 1;
    public $searchTerm;
    public $orderterm = 'asc';
    public $modelaValue = '';
    public $edit_navname = '';
    public $edit_navcolor = '';
    public $edit_navstatus = '';

    protected $listeners = ['deleteConfirmed' => 'n_delete'];

    


    public function naviName()
    {
        $uniqkey = random_int(100000, 999999);
        $navigation = new BlNavigation();
        $navigation->bln_name = $this->navname;
        $navigation->bln_color = $this->navcolor;
        $codegenSalt = (($navigation->bln_name).($uniqkey + microtime(1)));
        $navigation->bln_key = hash('sha256', $codegenSalt);  
        $navigation->bln_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-',  $navigation->bln_name)));
        $navigation->save();

        $this->dispatchBrowserEvent('swal', [
            'icon'=>'success',
            'title'=> 'Navigation Successfully Added',
            'showConfirmButton'=> false,
            'timer'=> 1500
        ]);
        $this->navname = '';
        $this->navcolor = '';
    }



    public function modelValue($id)
    {
        $openModel = BlNavigation::where('bln_key', $id)->firstOrFail();
        $this->edit_navname = $openModel->bln_name;
        $this->edit_navcolor = $openModel->bln_color;
        $this->modelaValue = $openModel->bln_key;

        $this->dispatchBrowserEvent('show-edit');
    }


    public function editNaviName($id)
    {
        $post = BlNavigation::where('bln_key',$id)->firstOrFail();
        $post->bln_name = $this->edit_navname;
        $post->bln_color = $this->edit_navcolor;
        $post->save();
        $this->dispatchBrowserEvent('show-edit-hide');
        $this->dispatchBrowserEvent('swal', [
            'icon'=>'success',
            'title'=> 'Navigation Updated successfully',
            'showConfirmButton'=> false,
            'timer'=> 1500
        ]);
        $this->edit_navname = '';
        $this->edit_navcolor = '';
        $this->modelaValue = '';
    }




    public function destroy($id)
    {
        $post = BlNavigation::where('bln_key',$id)->firstOrFail();
        $navname = $post->bln_name;  
        $this->dispatchBrowserEvent('swal:delete', ['title'=> 'Are you sure? ',
            'text'=> "want to delete this navigation? : $navname ",
            'icon'=> 'warning',
            'showCancelButton'=> true,
            'confirmButtonColor'=> '#3085d6',
            'cancelButtonColor'=> '#d33',
            'confirmButtonText' => 'Yes, delete it!',
        ]);

        $this->delete_id = $id;

    }


    public function n_delete()
    {
        $post = BlNavigation::where('bln_key', $this->delete_id);       
        $post->delete();

        $this->dispatchBrowserEvent('swal', [
            'icon'=>'success',
            'title'=> 'Navigation Successfully Deleted',
            'showConfirmButton'=> false,
            'timer'=> 1500
        ]);

    }


    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        
        $navList = BlNavigation::where('bln_name','like',$searchTerm )->orderBy('id',$this->orderterm)->get();


        return view('livewire.admin.navigation.manage-navigation', compact('navList'));
    }
}
