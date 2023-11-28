@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Tambah Produk')
    
@section('addProductAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Tambah Produk</h2>
    </header>

    <div class="panel-body">
        <h4 class="mb-2">Tambah Produk</h4>
        <form class="form-horizontal form-bordered" action="/admin-area/create/product/save" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row col-md-12">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="product_name">Nama Produk</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="product_name" placeholder="Masukan Nama Produk" id="product_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="product_name">Harga Produk</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="price" placeholder="Masukan Harga Produk" id="price" required>
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-md-2 control-label" for="product_name">Berat Produk</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="weight" placeholder="Masukan Berat Produk" id="weight" required>
                        <p>* Berat Produk Dalam Satuan Gram</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="sizes">Pilih Ukuran</label>
                    <div class="col-md-10">
                        <select multiple data-plugin-selectTwo class="form-control populate" name="sizes[]" id="sizes" required>
                            <optgroup label="Alaskan/Hawaiian Time Zone">
                                @foreach ($listSizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="description">Deskripsi</label>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control" name="description" placeholder="Masukan Deskripsi Produk" id="description"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="category">Pilih Kategori</label>
                    <div class="col-md-10">
                        <select multiple data-plugin-selectTwo class="form-control populate" name="categories[]" id="category" required>
                            @foreach ($listCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Gambar Produk 1</label>
                    <div class="col-md-10">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-append">
                                <div class="uneditable-input">
                                    <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                    <input type="file" name="image_product1" id="image_product1" required/>
                                </span>
                                <p>* Gambar Produk 1 wajib diisi</p>                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Gambar Produk 2</label>
                    <div class="col-md-10">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-append">
                                <div class="uneditable-input">
                                    <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                    <input type="file" name="image_product2" id="image_product2"/>
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
                                <div class="uneditable-input">
                                    <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                    <input type="file" name="image_product3" id="image_product3"/>
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
                        <button type="submit" class="btn btn-primary col-md-12 col-xs-12">Tambah</button>    
                    </div>
                </div>        
            </div>
        </form>
    </div>  
@endsection
                {{-- <option value="3c2ca3e1-8830-11ee-8b79-1831bf849076" selected>XS</option>
                <option value="3c2cb314-8830-11ee-8b79-1831bf849076" selected>S</option>
                <option value="3c2cbd29-8830-11ee-8b79-1831bf849076" selected>M</option>
                <option value="3c2ce6cc-8830-11ee-8b79-1831bf849076" selected>L</option>
                <option value="3c2d3988-8830-11ee-8b79-1831bf849076" selected>XL</option>
                <option value="3c2da3db-8830-11ee-8b79-1831bf849076" selected>XXL</option>
                <option value="3c2dc33c-8830-11ee-8b79-1831bf849076" selected>XXXL</option>
                <option value="3c2dd30f-8830-11ee-8b79-1831bf849076" selected>FREESIZE</option> --}}
