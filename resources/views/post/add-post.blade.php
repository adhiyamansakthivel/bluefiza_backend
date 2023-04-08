@extends('layouts.admin.layout')

@section('title', 'Manage all categories')

@section('body')

 <!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add Posts</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Add Posts</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content" >
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
            <form method="POST" action="{{ route('savePost') }}"  enctype="multipart/form-data" >
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" name="postTitle" placeholder="enter title" >
                </div>
                <div class="form-group">
                  <label >Category</label>
                  <select class="custom-select rounded-0" name="postCat">
                      @if(!empty($blogCat))
                      @foreach($blogCat as $categ)
                      <option value="{{$categ->catKey}}">{{$categ->navName}} | {{$categ->catName}}</option>
                      @endforeach
                      @else
                      <option>No Category Available</option>
                      @endif
                  </select>
                </div>
                <div class="form-group" >
                  <label >Post Images</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="photos[]" id="exampleInputFile" multiple accept="image/*">
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
                  <textarea id="summernote" name="postCont">
                   
                  </textarea>                </div>
                  <div class="form-group" >
                      <label>Meta Title</label>
                      <input type="text" class="form-control" name="postmTitle"  placeholder="enter meta title" >
                  </div>
                  <div class="form-group" >
                      <label>Meta Keywords</label>
                      <input type="text" class="form-control" name="postmKeyword" placeholder="enter meta title" >
                  </div>
                  <div class="form-group" >
                      <label>Meta Description </label>
                      <textarea class="form-control" rows="3" name="postmDesc" placeholder="Enter ..." ></textarea>
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
  
{{-- @livewire('admin.post.add-post') --}}



@endsection