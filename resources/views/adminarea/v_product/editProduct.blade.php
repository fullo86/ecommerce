@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Edit Produk')
    
@section('editProductAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit Produk</h2>
    </header>
    <div class="panel-body">
        <h4 class="mb-2">Edit Produk</h4>
        <form class="form-horizontal form-bordered" action="/admin-area/edit/product/update/{{ $productValue->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row col-md-12">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="product_name">Nama Produk</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="product_name" placeholder="Masukan Nama Produk" id="product_name" value="{{ $productValue->product_name }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="product_name">Harga Produk</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="price" placeholder="Masukan Harga Produk" id="price" value="{{ $productValue->price }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="product_name">Berat Produk</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="weight" placeholder="Masukan Berat Produk" id="weight" value="{{ $productValue->weight }}" required>
                        <p>* Berat Produk Dalam Satuan Gram</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="sizes">Pilih Ukuran</label>
                    <div class="col-md-10">
                        <select multiple data-plugin-selectTwo class="form-control populate" name="sizes[]" id="sizes">
                            @foreach ($sizeValue as $size)
                                <option value="{{$size->id}}" 
                                    @if(in_array($size->id, $selectedSizes)) selected @endif>
                                    {{$size->size_name}}
                                </option>
                            @endforeach            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="description">Deskripsi</label>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control" name="description" placeholder="Masukan Deskripsi Produk" id="description">{{ $productValue->description }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="category">Pilih Kategori</label>
                    <div class="col-md-10">
                        <select multiple data-plugin-selectTwo class="form-control populate" name="categories[]" id="category">
                            @foreach ($categoryValue as $category)
                                <option value="{{$category->id}}" 
                                    @if(in_array($category->id, $selectedCategories)) selected @endif>
                                    {{$category->category_name}}
                                </option>
                            @endforeach            
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Gambar Produk 1</label>
                    <div class="col-md-10">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-append">
                                @if($productValue->image_product1)
                                    <img src="{{ asset('storage/images/product/'.$productValue->image_product1) }}" alt="image_product1" width="100px" height="150px" style="margin-bottom: 5px;">
                                @else
                                    <p>No image Uploaded</p>
                                @endif                                
                                <div class="uneditable-input">
                                    <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                    <input type="file" name="image_product1" id="image_product1" value="{{ $productValue->image_product1 }}"/>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Gambar Produk 2</label>
                    <div class="col-md-10">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-append">
                                @if($productValue->image_product2)
                                <img src="{{ asset('storage/images/product/'.$productValue->image_product2) }}" alt="image_product2" width="100px" height="150px" style="margin-bottom: 5px;">
                            @else
                                <p>No image Uploaded</p>
                            @endif
                                <div class="uneditable-input">
                                    <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                    <input type="file" name="image_product2" id="image_product2" value="{{ $productValue->image_product2 }}"/>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Gambar Produk 3</label>
                    <div class="col-md-10">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-append">
                                @if($productValue->image_product3)
                                <img src="{{ asset('storage/images/product/'.$productValue->image_product3) }}" alt="image_product3" width="100px" height="150px" style="margin-bottom: 5px;">
                            @else
                                <p>No image Uploaded</p>
                            @endif                                
                                <div class="uneditable-input">
                                    <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                    <input type="file" name="image_product3" id="image_product3" value="{{ $productValue->image_product3 }}"/>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-xs-6">
                        <a href="/admin-area/category" class="btn btn-primary col-md-12 col-xs-12">Batal</a>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <button type="submit" class="btn btn-primary col-md-12 col-xs-12">Update</button>    
                    </div>
                </div>        
            </div>
        </form>
    </div>
@endsection