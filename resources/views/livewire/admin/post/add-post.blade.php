
<div>
    <section class="content" wire:ignore.self>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Add New Post</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form wire:submit.prevent="postSave"  enctype="multipart/form-data" >
                    <div class="card-body">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control"  placeholder="enter title" wire:model = "ptitle">
                      </div>
                      <div class="form-group">
                        <label >Title Slug url</label>
                        <input type="text" class="form-control"  placeholder="enter slug url" wire:model ="pslug">
                      </div>
                      <div class="form-group">
                        <label >Category</label>
                        <select class="custom-select rounded-0" wire:model ="pcat">
                            <option value="0" default>Select Category</option>
                            @if(!empty($blogCat))
                            @foreach($blogCat as $categ)
                            <option value="{{$categ->blc_key}}">{{$categ->blc_name}}</option>
                            @endforeach
                            @else
                            <option>No Category Available</option>
                            @endif
                        </select>
                      </div>
                      <div class="form-group" wire:ignore>
                        <label >Post Images</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" wire:model="photo" multiple accept="image/*">
                            <label class="custom-file-label" >Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>
                        </div>
                      </div>
                      @error('photo.*') <span class="error" style="color:red">{{ $message }}</span> @enderror
                      <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." wire:model="pdesc"></textarea>
                      </div>
                        <div class="form-group">
                            <label>Meta Title</label>
                            <input type="text" class="form-control"  placeholder="enter title" wire:model ="pmtitle">
                        </div>
                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <input type="text" class="form-control"  placeholder="enter title" wire:model ="pmkeyword">
                        </div>
                        <div class="form-group">
                            <label>Meta Description </label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..." wire:model="pmdesc"></textarea>
                        </div>
                    </div>
                   
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
                <!-- /.card -->
    
    
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
              <div class="card-header">
                <h3 class="card-title">Add Blog Posts </h3>
              </div>
              <!-- form start -->
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                              <tr>
                                <th>Post Title</th>
                                <th>Selected</th>
                                <th>Category</th>
    
                              </tr>
                              </thead>
                              <tbody>

                              <tr>
                                <td> </td>
                                <td>

                                </td>
                                <td> 
                                    
                                 </td>
  
                              </tr>

  
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Post Title</th>
                                  <th>Selected</th>
                                  <th>Category</th>
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