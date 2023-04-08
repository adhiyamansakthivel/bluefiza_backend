<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\BlCategory;
use App\Models\BlNavigation;

class ManageCategory extends Component
{
    public $catkey;
    public $categoryname ='';
    public $catslugValue = '';
    public $catmtitle = '';
    public $catmdesc = '';
    public $catbgc = '';
    public $catmkeyword = '';
    public $naviname ='';
    public $countDummy = 1;
    public $delete_id ='';
    public $modelaValue = '';
    public $modelValView = '';
    public $edit_catname = '';
    public $edit_catslug = '';
    public $edit_slug_valid = '';
    public $edit_mtitle ='';
    public $edit_mdesc ='';
    public $edit_mkeyword = '';
    public $edit_navigation = '';
    public $edit_naviname = '';
    public $searchTerm;
    public $orderterm = 'asc';
    public $edit_catbgc = '';


    protected $listeners = ['deleteConfirmed' => 'cat_delete'];


    public function categoryName() //Add New Category
    {
        $navigation = BlNavigation::where('bln_key',$this->naviname)->firstOrFail(); 

        $uniqkey = random_int(100000, 999999);
        $category = new BlCategory();
        $category->blc_name = $this->categoryname;
        $codegenSalt = (($category->blc_name).($uniqkey + microtime(1)));
        $category->blc_key = hash('sha256', $codegenSalt);  
        $category->blc_slug = $this->catslugValue;
        $category->blc_color = $this->catbgc;
        $category->blcnav_id = $navigation->id;
        $category->blc_metatitle = $this->catmtitle;
        $category->blc_metadesc = $this->catmdesc;
        $category->blc_keywords = $this->catmkeyword;

        $category->save();

        $this->categoryname = '';
        $this->catslugValue = '';
        $this->catmtitle ='';
        $this->catmdesc = '';
        $this->catmkeyword='';
        $this->naviname = '';
        $this->catbgc = '';
        
        $this->dispatchBrowserEvent('swal', [
            'icon'=>'success',
            'title'=> 'Category Successfully Added',
            'showConfirmButton'=> false,
            'timer'=> 2500
        ]);

    }

    public function destroy($id) // delete requiring confirmation
    {
        $post = BlCategory::where('blc_key',$id)->firstOrFail();
        $cname = $post->blc_name;  
        $this->dispatchBrowserEvent('swal:delete', ['title'=> 'Are you sure? ',
            'text'=> "want to delete this Category? : $cname ",
            'icon'=> 'warning',
            'showCancelButton'=> true,
            'confirmButtonColor'=> '#3085d6',
            'cancelButtonColor'=> '#d33',
            'confirmButtonText' => 'Yes, delete it!',
        ]);

        $this->delete_id = $id;

    }

    public function cat_delete() //delete after confirmation
    {
        $post = BlCategory::where('blc_key', $this->delete_id);       
        $post->delete();

        $this->dispatchBrowserEvent('swal', [
            'icon'=>'success',
            'title'=> 'Category Successfully Deleted',
            'showConfirmButton'=> false,
            'timer'=> 2000
        ]);

    }


    public function modelView($id) //show modal for view category 
    {
        $this->modelValView = BlCategory::join('bl_navigations', 'bl_navigations.id', 'blcnav_id')
        ->where('blc_key', $id)->firstOrFail();

        $this->dispatchBrowserEvent('show-view');
    }

    public function modelValue($id) //show modal for edit category 
    {
        $openModel = BlCategory::where('blc_key', $id)->firstOrFail();
        $navig = BlNavigation::where('id', $openModel->blcnav_id)->firstOrFail();
        $this->edit_catname = $openModel->blc_name;
        $this->edit_slug_valid = $openModel->blc_slug;
        $this->edit_catbgc = $openModel->blc_color;
        $this->modelaValue = $openModel->blc_key;
        $this->edit_mtitle = $openModel->blc_metatitle;
        $this->edit_mkeyword = $openModel-> blc_keywords;
        $this->edit_mdesc = $openModel->blc_metadesc;
        $this->edit_navigation = $navig;

        $this->dispatchBrowserEvent('show-edit');
    }

    
    public function editCategoryName($id) //Category update and hide modal
    {
        $post = BlCategory::where('blc_key',$id)->firstOrFail();
        $navig = BlNavigation::where('bln_key', $this->edit_naviname )->firstOrFail();

        $post->blc_name = $this->edit_catname;
        $post->blc_slug = $this->edit_slug_valid;
        $post->blcnav_id =  $navig->id;
        $post->blc_color = $this->edit_catbgc;
        $post->blc_metatitle = $this->edit_mtitle;
        $post->blc_keywords = $this->edit_mkeyword;
        $post->blc_metadesc = $this->edit_mdesc;
        $post->save();
        $this->dispatchBrowserEvent('show-edit-hide');
        $this->dispatchBrowserEvent('swal', [
            'icon'=>'success',
            'title'=> 'Category Updated successfully',
            'showConfirmButton'=> false,
            'timer'=> 1500
        ]);
        $this->edit_catname = '';
        $this->modelaValue = '';
        $this->edit_mtitle ='';
        $this->edit_mdesc ='';
        $this->edit_mkeyword = '';
        $this->edit_catbgc ='';
    }
    
    public function render()
    {
        if(!empty($this->naviname)){
            $navigation = BlNavigation::where('bln_key',$this->naviname)->firstOrFail(); 

            $mergeSlug = ($navigation->bln_name." ".$this->categoryname);
            $this->catslugValue = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $mergeSlug)));
        }else{
            $this->catslugValue = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->categoryname)));
        }


        $this->edit_slug_valid = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->edit_catname )));

        $searchTerm = '%'.$this->searchTerm.'%';


        $navigationList = BlNavigation::where('bln_active', '1')->get();

        $categoryList = BlCategory::join('bl_navigations', 'bl_navigations.id', 'blcnav_id')
        ->where('blc_name','like',$searchTerm )
        ->orderBy('bl_categories.id',$this->orderterm)
        ->get();


        return view('livewire.admin.category.manage-category', compact('navigationList','categoryList'));
    }
}
