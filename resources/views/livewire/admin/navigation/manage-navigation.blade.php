
<div>
    <section class="content" >
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
  
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Navigation </h3>
              </div>
              <form wire:submit.prevent="naviName">
                <div class="card-body">
                  <div class="form-group">
                    <label >Navigation Name</label>
                    <input type="text" class="form-control" wire:model="navname" required>
                  </div>
                  <div class="form-group">
                    <label >Navigation Color</label>
                    <input type="color" class="form-control" wire:model="navcolor" required>
                    <span style="background-color:{{$navcolor}};color:white">{{$navcolor}}</span><br/>
                    <span style="color:{{$navcolor}};">{{$navcolor}}</span>
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
                  <h3 class="card-title">Manage Navigation </h3>
  
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
                  Navigation Count: {{count($navList)}}
                  <!-- /.btn-group -->
              </div>
  
          
            <table  class="table table-bordered">
                            <thead>
                              <tr>
                                <th style="width: 10px">Id</th>
                                <th>Navigation Name</th>
                                <th>Background</th>
                                <th>Font</th>
                                <th>Add Categories</th>
                                <th style="width: 13px">Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @if(!empty($navList))
                            @foreach($navList as $navVal)
                            <tr>
                             
                              <td>{{$countDummy++}}. </td>
                              <td>{{$navVal->bln_name}}</td>
                              <td><span style="background-color:{{$navVal->bln_color}};color:white">{{$navVal->bln_color}}</span></td>
                              <td><span style="color:{{$navVal->bln_color}};">{{$navVal->bln_color}}</span></td>
                              <td><a href="{{url('/manage-navigations/categories/'.$navVal->bln_key)}}">Add Categories</a></td>
  
                              <td>
                                @if($navVal->bln_active == '1')
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Deactivated</span>
                                @endif
                              </td>
  
                              <td>
                                
                                <a class="btn btn-info btn-sm"  wire:click.prevent =" modelValue('{{$navVal->bln_key}}')" >
                                    <i class="fas fa-pencil-alt" >
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" wire:click.prevent = "destroy('{{$navVal->bln_key}}')">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                                                             
                              </td>
                            </tr>
                            @endforeach
                            @else
                            <p>No records found..</p>
                            @endif
     
                            </tbody>
                            <tfoot>
                              <tr>
                                <th>Id</th>
                                <th>Navigation Name</th>
                                <th>Background</th>
                                <th>Font</th>
                                <th>Add Categories</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </tfoot>
                          </table>
                         
                          <!-- /.card-body -->
                        </div>
                        
                      </div>
                      <!-- /.card -->
                     
        </div>
  
  
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
               @if(!empty($edit_navname))
               <form wire:submit.prevent="editNaviName('{{$modelaValue}}')">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Navigation Name</label>
                    <input type="text" class="form-control" wire:model="edit_navname" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Navigation Color</label>
                    <input type="color" class="form-control" wire:model="edit_navcolor" >
                    <span style="background-color:{{$edit_navcolor}};color:white">{{$edit_navcolor}}</span><br/>
                    <span style="color:{{$edit_navcolor}};">{{$edit_navcolor}}</span>
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
  
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  
  </section>
  
  
  
    
  
  
  </div>