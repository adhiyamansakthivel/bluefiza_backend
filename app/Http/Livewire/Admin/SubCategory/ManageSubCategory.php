<?php

namespace App\Http\Livewire\Admin\SubCategory;

use Livewire\Component;
use App\Models\BlSubCategory;
use App\Models\BlCategory;

class ManageSubCategory extends Component
{
    public $scatkey;
    public $scategoryname ='';
    public $scatslugValue = '';
    public $scatbgc = '';
    public $scatfnc = '';
    public $scatmtitle = '';
    public $scatmdesc = '';
    public $scatmkeyword = '';
    public $categname ='';
    public $countDummy = 1;
    public $delete_id ='';
    public $modelaValue = '';
    public $modelValView = '';
    public $edit_scatname = '';
    public $edit_scatslug = '';
    public $edit_slug_valid = '';
    public $edit_smtitle ='';
    public $edit_smdesc ='';
    public $edit_smkeyword = '';
    public $edit_scatename = '';
    public $edit_categname = '';
    public $searchTerm;
    public $orderterm = 'asc';

    protected $listeners = ['deleteConfirmed' => 'cat_delete'];


    public function subcategoryName() //Add New sub Category
    {
        $category = BlCategory::where('blc_key',$this->categname)->firstOrFail(); 

        $uniqkey = random_int(100000, 999999);
        $scategory = new BlSubCategory();
        $scategory->blcs_name = $this->scategoryname;
        $codegenSalt = (($scategory->blcs_name).($uniqkey + microtime(1)));
        $scategory->blcs_key = hash('sha256', $codegenSalt);  
        $scategory->blcs_slug = $this->scatslugValue;
        $scategory->blcs_bgcolor = $this->scatbgc;
        $scategory->blcs_fontcolor= $this->scatfnc;
        $scategory->blcscat_id = $category->id;
        $scategory->blcs_metatitle = $this->scatmtitle;
        $scategory->blcs_metadesc = $this->scatmdesc;
        $scategory->blcs_keywords = $this->scatmkeyword;

        $scategory->save();

        $this->scategoryname = '';
        $this->scatslugValue = '';
        $this->scatmtitle ='';
        $this->scatmdesc = '';
        $this->scatmkeyword='';
        $this->categname = '';

        $this->dispatchBrowserEvent('swal', [
            'icon'=>'success',
            'title'=> 'Sub Category Successfully Added',
            'showConfirmButton'=> false,
            'timer'=> 2500
        ]);

    }

    public function destroy($id) // delete requiring confirmation
    {
        $post =  BlSubCategory::where('blcs_key',$id)->firstOrFail();
        $cname = $post->blcs_name;  
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
        $post = BlSubCategory::where('blcs_key', $this->delete_id);       
        $post->delete();

        $this->dispatchBrowserEvent('swal', [
            'icon'=>'success',
            'title'=> 'Sub Category Successfully Deleted',
            'showConfirmButton'=> false,
            'timer'=> 2000
        ]);

    }


    public function modelView($id) //show modal for view category 
    {
        $this->modelValView = BlSubCategory::join('bl_categories', 'bl_categories.id', 'blcscat_id')
        ->where('blcs_key', $id)->firstOrFail();

        $this->dispatchBrowserEvent('show-view');
    }

    public function modelValue($id) //show modal for edit category 
    {
        $openModel = BlSubCategory::where('blcs_key', $id)->firstOrFail();
        $categ= BlCategory::where('id', $openModel->blcscat_id)->firstOrFail();
        $this->edit_scatname = $openModel->blcs_name;
        $this->edit_slug_valid = $openModel->blcs_slug;
        $this->modelaValue = $openModel->blcs_key;
        $this->edit_smtitle = $openModel->blcs_metatitle;
        $this->edit_smkeyword = $openModel-> blcs_keywords;
        $this->edit_smdesc = $openModel->blcs_metadesc;
        $this->edit_categname = $categ;

        $this->dispatchBrowserEvent('show-edit');
    }

    
    public function editCategoryName($id) //Category update and hide modal
    {
        $post =BlSubCategory::where('blcs_key',$id)->firstOrFail();
        $categ = BlCategory::where('blc_key', $this->edit_categname)->firstOrFail();

        $post->blcs_name = $this->edit_scatename;
        $post->blcs_slug = $this->edit_slug_valid;
        $post->blcscat_id =  $categ->id;
        $post->blcs_metatitle = $this->edit_smtitle;
        $post->blcs_keywords = $this->edit_smkeyword;
        $post->blcs_metadesc = $this->edit_smdesc;
        $post->save();
        $this->dispatchBrowserEvent('show-edit-hide');
        $this->dispatchBrowserEvent('swal', [
            'icon'=>'success',
            'title'=> 'Category Updated successfully',
            'showConfirmButton'=> false,
            'timer'=> 1500
        ]);
        $this->edit_scatname = '';
        $this->modelaValue = '';
        $this->edit_smtitle ='';
        $this->edit_smdesc ='';
        $this->edit_smkeyword = '';
    }

    public function render()
    {
        $this->scatslugValue = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->scategoryname )));
        $this->edit_slug_valid = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->edit_scatname )));

        $searchTerm = '%'.$this->searchTerm.'%';


        $categoryList = BlCategory::where('blc_active', '1')->get();

        $scategoryList = BlSubCategory::join('bl_categories', 'bl_categories.id', 'blcscat_id')
        ->where('blcs_name','like',$searchTerm )
        ->orderBy('bl_sub_categories.id',$this->orderterm)
        ->get();

        return view('livewire.admin.sub-category.manage-sub-category', compact('categoryList','scategoryList'));
    }
}
