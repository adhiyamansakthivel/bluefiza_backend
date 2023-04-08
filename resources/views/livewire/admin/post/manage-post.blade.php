
<div>
    <section class="content" wire:ignore.self>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <!-- /.card -->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Manage Blog Posts: {{count($bPosts)}} </h3>
                  <div class="card-tools">
                    <div class="input-group ">
                      <select class="custom-select form-control-border"  wire:model="orderterm">
                        <option  Default>Desc</option>
                        <option >Asc</option>
                      </select>
                      <input type="text" class="form-control" placeholder="Search " wire:model.debounce.500ms="searchTerm">
                      <div class="input-group-append">
                        <div class="btn btn-primary">
                          <i class="fas fa-search"></i>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
             
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th style="width: 120px">Date</th>
                                <th style="width: 280px">Title</th>
                                <th style="width: 180px">Slug</th>
                                <th>Category</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($bPosts))
                            @foreach($bPosts as $post)
                            <tr>
                                <td>#</td>
                                <td>{{ \Carbon\Carbon::parse($post->postedon)->format('d-m-Y') }}</td>
                                <td>{{$post->blp_title}}</td>
                                <td>{{$post->blp_slug}}</td>
                                <td>{{$post->catname}}</td>
                                <td>
                                    @if($post->blp_active == '1')
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-danger">Deactivated</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" >
                                         <i class="fas fa-folder">
                                         </i>
                                          View
                                    </a>
                                    <a class="btn btn-info btn-sm">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm"  wire:click.prevent = "destroy('{{$post->blp_key}}')">
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
                                <th>Id</th>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    
    </section>

</div>