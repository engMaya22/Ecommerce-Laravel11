@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>Add Product</h3>
                <ul class="flex flex-wrap items-center justify-start breadcrumbs gap10">
                    <li>
                        <a href="{{route('admin.index')}}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{route('admin.products')}}">
                            <div class="text-tiny">Products</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit product</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data" action="{{route('admin.product.update')}}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$product->id}}" />
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="mb-10 body-title">Product name <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0" value="{{$product->name}}" aria-required="true" required="">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('name')
                    <span class="text-center alert alert-danger">
                       {{$message}}
                    </span>
                    @enderror

                    <fieldset class="name">
                        <div class="mb-10 body-title">Slug <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter product slug" name="slug" tabindex="0" value="{{$product->slug}}" aria-required="true" required="">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('slug')
                    <span class="text-center alert alert-danger">
                       {{$message}}
                    </span>
                    @enderror

                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="mb-10 body-title">Category <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="category_id">
                                    <option>Choose category</option>
                                     @foreach ($categories as $category )
                                      <option {{ $category->id == $product->category->id ? 'selected':''}}

                                        value="{{$category->id}}">{{$category->name}}</option>
                                     @endforeach

                                </select>
                            </div>
                        </fieldset>
                        @error('category_id')
                        <span class="text-center alert alert-danger">
                           {{$message}}
                        </span>
                        @enderror
                        <fieldset class="brand">
                            <div class="mb-10 body-title">Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="brand_id">
                                    <option>Choose Brand</option>
                                    @foreach ($brands as $brand )
                                    <option {{ $brand->id == $product->brand->id ? 'selected':''}} value="{{$brand->id}}">{{$brand->name}}</option>
                                   @endforeach

                                </select>
                            </div>
                        </fieldset>
                        @error('brand_id')
                        <span class="text-center alert alert-danger">
                           {{$message}}
                        </span>
                        @enderror
                    </div>

                    <fieldset class="shortdescription">
                        <div class="mb-10 body-title">Short Description <span
                                class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150" name="short_description" placeholder="Short Description" tabindex="0" aria-required="true"
                            required="">
                            {{$product->short_description}}

                        </textarea>
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('short_description')
                    <span class="text-center alert alert-danger">
                       {{$message}}
                    </span>
                    @enderror

                    <fieldset class="description">
                        <div class="mb-10 body-title">Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Description"
                            tabindex="0" aria-required="true" required="">
                            {{$product->description}}
                        </textarea>
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('description')
                    <span class="text-center alert alert-danger">
                       {{$message}}
                    </span>
                    @enderror



                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="flex-grow upload-image">
                            <div class="item" id="imgpreview" >
                                <img src="{{$product->getThumbnailImage}}"
                                    class="effect8" alt="{{$product->name}}">
                            </div>
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span
                                            class="tf-color">click to browse</span></span>
                                    <input type="file"  id="myFile" name="main_image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('main_image')
                    <span class="text-center alert alert-danger">
                       {{$message}}
                    </span>
                    @enderror

                    <fieldset>
                        <div class="mb-10 body-title">Upload Gallery Images</div>
                        <div class="mb-16 upload-image">
                            @if( $product->images)
                             @foreach ( $product->images as $img )
                              <div class="item gitems">
                                <img src="{{asset('storage/uploads/products/orginal/'. $img )}}" alt="$img">
                              </div>
                             @endforeach
                            @endif
                            <div id="galUpload" class="item up-load">
                                <label class="uploadfile" for="gFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="text-tiny">Drop your images here or select <span
                                            class="tf-color">click to browse</span></span>
                                    <input type="file" id="gFile" name="images[]" accept="image/*"
                                        multiple="">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('images')
                    <span class="text-center alert alert-danger">
                       {{$message}}
                    </span>
                    @enderror

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="mb-10 body-title">Regular Price <span
                                    class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter regular price"
                                name="regular_price" tabindex="0" value="{{$product->regular_price}}" aria-required="true"
                                required="">
                        </fieldset>
                        @error('regular_price')
                        <span class="text-center alert alert-danger">
                           {{$message}}
                        </span>
                        @enderror
                        <fieldset class="name">
                            <div class="mb-10 body-title">Sale Price <span
                                    class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter sale price" name="sale_price" tabindex="0" value="{{$product->sale_price}}" aria-required="true"
                                required="">
                        </fieldset>
                        @error('sale_price')
                        <span class="text-center alert alert-danger">
                           {{$message}}
                        </span>
                        @enderror
                    </div>


                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="mb-10 body-title">SKU <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter SKU" name="sku"
                                tabindex="0" value="{{$product->sku}}" aria-required="true" required="">
                        </fieldset>
                        @error('featured')
                        <span class="text-center alert alert-danger">
                           {{$message}}
                        </span>
                        @enderror
                        <fieldset class="name">
                            <div class="mb-10 body-title">Quantity <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter quantity"
                                name="quantity" tabindex="0" value="{{$product->quantity}}" aria-required="true"
                                required="">
                        </fieldset>
                        @error('quantity')
                        <span class="text-center alert alert-danger">
                           {{$message}}
                        </span>
                        @enderror
                    </div>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="mb-10 body-title">Stock</div>
                            <div class="mb-10 select">
                                <select class="" name="stock_status">
                                    <option {{$product->stock_status == 'instock'? 'selected' : ""}} value="instock">InStock</option>
                                    <option  {{$product->stock_status == 'outofstock'? 'selected' : ""}} value="outofstock">Out of Stock</option>
                                </select>
                            </div>
                        </fieldset>
                        @error('featured')
                        <span class="text-center alert alert-danger">
                           {{$message}}
                        </span>
                        @enderror
                        <fieldset class="name">
                            <div class="mb-10 body-title">Featured</div>
                            <div class="mb-10 select">
                                <select class="" name="featured">
                                    <option  {{!$product->featured ? 'selected' : ""}} value="0">No</option>
                                    <option  {{$product->featured ? 'selected' : ""}} value="1">Yes</option>
                                </select>
                            </div>
                        </fieldset>
                        @error('featured')
                        <span class="text-center alert alert-danger">
                           {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="cols gap10">
                        <button class="w-full tf-button" type="submit">Update product</button>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
    </div>
@endsection
@push('scripts')
  <script>
    $(function(){
        $("#myFile").on("change",function(e){
            const photoInput = $("#myFile");
            const [file] = this.files;
            if(file){
                $("#imgpreview img").attr('src',URL.createObjectURL(file));
                $("#imgpreview").show();//jquery to make div visible

            }

        });
        // images preview
        $("#gFile").on("change",function(e){
            const photoInput = $("#gFile");
            const photos = this.files;
            $.each(photos , function(key , val){
                $("#galUpload").prepend(`<div class="item gitems">
                     <img src="${URL.createObjectURL(val)}" />
                    </div>`);

            });

        });

        $("input[name='name']").on("change",function(){
             const name = $(this).val();
             $("input[name='slug']").val(StringToSlug(name));
        })
    });
    function StringToSlug(Text){
        return Text.toLowerCase()
                    .replace(/[^\w\s-]/g, "") // Remove special characters
                    .replace(/\s+/g, "-"); // Replace spaces with hyphens
    }

  </script>

@endpush
