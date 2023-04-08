
<div>
    <section class="content" >
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
  
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Sub Category </h3>
              </div>
              <form wire:submit.prevent="subcategoryName">
                <div class="card-body">
                  <div class="form-group">
                    <label>Sub Category Name</label>
                    <input type="text" class="form-control" wire:model="scategoryname" >
                  </div>
                  <div class="form-group">
                    <label>Select Category </label>
                    <select class="custom-select rounded-0" id="exampleSelectRounded0" wire:model="categname">
                        <option value="0" default>select Category</option>
                        @if(!empty($categoryList))
                        @foreach($categoryList as $catVal)
                            <option value="{{$catVal->blc_key}}">{{$catVal->blc_name}}</option>
                        @endforeach
                        @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Sub Category Slug </label>
                    <input type="text" class="form-control" wire:model="scatslugValue" >
                  </div>
                  <div class="form-group">
                    <label>Background color</label>
                    <input type="color" class="form-control" wire:model="scatbgc" >
                    <span style="background-color:{{$scatbgc}};color:white">{{$scatbgc}}</span>
                  </div>
                  <div class="form-group">
                    <label>Font color </label>
                    <input type="color" class="form-control" wire:model="scatfnc" >
                    <span style="color:{{$scatfnc}};">{{$scatfnc}}</span>
                  </div>
                  <div class="form-group">
                    <label>Meta Title </label>
                    <input type="text" class="form-control" wire:model="scatmtitle" >
                  </div>
                  <div class="form-group">
                    <label>Meta Keywords</label>
                    <input type="text" class="form-control" wire:model="scatmkeyword" >
                  </div>
                  <div class="form-group">
                    <label>Meta Description </label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." wire:model="scatmdesc"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" value="store">Save</button>
                </div>
              </form>
            </div>
  
          </div>
        </div>
      </div>
    </section>

    
<section class="content" wire:ignore.self>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
      <!-- /.card -->
        <div class="card ">
          
          <!-- form start -->
        <!-- /.card-header -->
        <div class="card-body">


            <div class="card-header">
                <h3 class="card-title">Manage Sub Categories </h3>

              <div class="card-tools">
                <div class="input-group ">
                  <select class="custom-select form-control-border"  wire:model="orderterm">
                    <option  Default>Asc</option>
                    <option  Default>Desc</option>
                  </select>
                  <input type="text" class="form-control" placeholder="Search " wire:model.debounce.500ms="searchTerm">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <div class="mailbox-controls">
              
              <!-- /.btn-group -->
                Categories Count: {{count($scategoryList)}}
                <!-- /.btn-group -->
            </div>

        
          <table  class="table table-bordered">
                          <thead>
                            <tr>
                              <th style="width: 10px">Id</th>
                              <th>Sub Category Name</th>
                              <th>Slug</th>
                              <th>Background</th>
                              <th>Font</th>
                              <th>Category</th>
                              <th>Add Post</th>
                              <th style="width: 13px">Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          @if(!empty($scategoryList))
                          @foreach($scategoryList as $scategoryValue)
                          <tr>
                           
                            <td>{{$countDummy++}}. </td>
                            <td>{{$scategoryValue->blcs_name}}</td>
                            <td>{{$scategoryValue->blcs_slug}}</td>
                            <td><span style="background-color:{{$scategoryValue->blcs_bgcolor}};color:white">{{$scategoryValue->blcs_bgcolor}}</span></td>
                            <td><span style="color:{{$scategoryValue->blcs_fontcolor}};">{{$scategoryValue->blcs_fontcolor}}</span></td>
                            <td>{{$scategoryValue->blc_name}}</td>
                            <td><p>Add Post</p></td>
                            <td>
                              @if($scategoryValue->blcs_active == '1')
                              <span class="badge bg-success">Active</span>
                              @else
                              <span class="badge bg-danger">Deactivated</span>
                              @endif
                            </td>

                            <td>
                              <a class="btn btn-primary btn-sm" href="#" wire:click.prevent =" modelView('{{$scategoryValue->blcs_key}}')">
                                   <i class="fas fa-folder">
                                   </i>
                                    View
                              </a>
                              <a class="btn btn-info btn-sm"  wire:click.prevent =" modelValue('{{$scategoryValue->blcs_key}}')" >
                                  <i class="fas fa-pencil-alt" >
                                  </i>
                                  Edit
                              </a>
                              <a class="btn btn-danger btn-sm" wire:click.prevent = "destroy('{{$scategoryValue->blcs_key}}')">
                                  <i class="fas fa-trash">
                                  </i>
                                  Delete
                              </a>
                                                           
                            </td>
                          </tr>
                          @endforeach
                          @endif
   
                          </tbody>
                          <tfoot>
                            <tr>
                              <th style="width: 10px">Id</th>
                              <th>Sub Category Name</th>
                              <th>Slug</th>
                              <th>Background</th>
                              <th>Font</th>
                              <th>Category</th>
                              <th>Add Post</th>
                              <th style="width: 13px">Status</th>
                              <th>Action</th>
                            </tr>
                          </tfoot>
                        </table>
                       
                        <!-- /.card-body -->
                      </div>
                      
                    </div>
                    <!-- /.card -->
                   
      </div>

      {{-- view Category Modal --}}
      <div class="modal fade" id="modal-default-view" wire:ignore.self>
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Category View</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             @if(!empty($modelValView))
             <div class="card-body">
                <strong>Category Name</strong>
                <p class="text-muted">{{$modelValView->blc_name}}</p>
                <hr>

                <strong>Category Slug</strong>
                <p class="text-muted">{{$modelValView->blc_slug}}</p>
                <hr>

                <strong>Navigation Name</strong>
                <p class="text-muted">{{$modelValView->bln_name}}</p>
                <hr>

                <strong>Meta Title </strong>
                <p class="text-muted">{{$modelValView->blc_metatitle}}</p>
                <hr>

                <strong>Meta Keywords</strong>
                <p class="text-muted">{{$modelValView->blc_keywords}}</p>
                <hr>

                <strong>Meta Description</strong>
                <p class="text-muted">{{$modelValView->blc_metadesc}}</p>
                <hr>

                <strong>status</strong>
                @if($modelValView->blc_active == '1' || $modelValView->blc_active == 'true')
                <p class="text-muted"><i class="fas fa-check" style="color: green"></i>Active</p>
                @else
                <p class="text-muted"><i class="far fa-times-circle" style="color: red"></i>Deactivated</p>
                @endif
                <hr>


              </div>
              <!-- /.card-body -->
            
             @endif
            </div>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      {{-- view Edit Category Modal --}}


      {{-- Edit Category Modal --}}
      <div class="modal fade" id="modal-default" wire:ignore.self>
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             @if(!empty($edit_catname))
             <form wire:submit.prevent="editCategoryName('{{$modelaValue}}')">
              <div class="card-body">
                <div class="form-group">
                  <label >Category Name</label>
                  <input type="text" class="form-control" wire:model="edit_catname">
                </div>
                <div class="form-group">
                  <label >Category Slug</label>
                  <input type="text" class="form-control" wire:model="edit_slug_valid">
                </div>
                <div class="form-group">
                    <label>Select Navigation </label>
                    <select class="custom-select rounded-0" id="exampleSelectRounded0" wire:model="edit_naviname">
                        <option value="{{$edit_navigation->bln_key}}" default>{{$edit_navigation->bln_name}}</option>
                        @if(!empty($navigationList))
                        @foreach($navigationList as $navVal)
                            <option value="{{$navVal->bln_key}}">{{$navVal->bln_name}}</option>
                        @endforeach
                        @endif
                    </select>
                  </div>
                <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" class="form-control" wire:model="edit_mtitle">
                </div>
                <div class="form-group">
                    <label>Meta keywords</label>
                    <input type="text" class="form-control" wire:model="edit_mkeyword">
                </div>
                <div class="form-group">
                    <label>Meta description</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." wire:model="edit_mdesc"></textarea>
                </div>
                
              </div>
              <!-- /.card-body -->
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="store" class="btn btn-primary" value="store">Save changes</button>
                </div>
            </form>
             @endif
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      {{-- End Edit Category Modal --}}





    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->

</section>
  
 
    
  
  
  </div>