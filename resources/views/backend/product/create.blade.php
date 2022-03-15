@extends('backend.layouts.master')

@section('main-content')

    <div class="card">
        <h5 class="card-header">Add Product</h5>
        @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
        <div class="card-body">
            <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{old('title')}}"
                           class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
                    @error('summary')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label">Description</label>
                    <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="is_featured">Is Featured</label><br>
                    <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes
                </div>
                {{-- {{$categories}} --}}

                <div class="form-group">
                    <label for="cat_id">Category <span class="text-danger">*</span></label>
                    <select name="cat_id" id="cat_id" class="form-control">
                        <option value="">--Select any category--</option>
                        @foreach($categories as $key=>$parent_cat)
                            <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
                            @php
                                $child_cats = App\Models\Category::where('parent_id', $parent_cat->id)->orderBy('title','ASC')->get();
                            @endphp
                            @foreach($child_cats as $i =>$child_cat)
                                <option value='{{$child_cat->id}}'>  - {{$child_cat->title}}</option>

                                @php
                                    $child_cats2 = App\Models\Category::where('parent_id', $child_cat->id)->orderBy('title','ASC')->get();
                                @endphp
                                @foreach($child_cats2 as $child_cat2)
                                    <option value='{{$child_cat2->id}}'>     - {{$child_cat2->title}}</option>
                                    @php
                                        $child_cats3 = App\Models\Category::where('parent_id', $child_cat2->id)->orderBy('title','ASC')->get();
                                    @endphp
                                    @foreach($child_cats3 as $child_cat3)
                                        <option value='{{$child_cat3->id}}'>        - {{$child_cat3->title}}</option>
                                    @endforeach

                                @endforeach
                            @endforeach
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="price" class="col-form-label">Price<span class="text-danger">*</span></label>
                    <input id="price" type="number" name="price" placeholder="Enter price" value="{{old('price')}}"
                           class="form-control">
                    @error('price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price_logo" class="col-form-label">Logo Price</label>
                    <input id="price_logo" type="number" name="price_logo" placeholder="Enter price" value="{{old('price_logo')}}"
                           class="form-control">
                    @error('price_logo')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price_customize" class="col-form-label">Customize Price</label>
                    <input id="price_customize" type="number" name="price_customize" placeholder="Enter price" value="{{old('price_customize')}}"
                           class="form-control">
                    @error('price_customize')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="discount" class="col-form-label">Discount(%)</label>
                    <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"
                           value="{{old('discount')}}" class="form-control">
                    @error('discount')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="size">Size</label>
                    <select name="size[]" class="form-control selectpicker" multiple data-live-search="true">
                        <option value="">--Select any size--</option>
                        <option value="S">Small (S)</option>
                        <option value="M">Medium (M)</option>
                        <option value="L">Large (L)</option>
                        <option value="XL">Extra Large (XL)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">Varation</label>
                </div>
                <div class="form-group">
                    <label for="">Blue: </label>

                    <div class="input-group">
                        <input  id="var_blue" class="form-control" type="file" name="var_blue"
                               value="{{old('var_blue')}}" accept="image/*" >
                    </div>
                    @error('var_blue')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Rouge: </label>

                    <div class="input-group">
                        <input  id="var_red" class="form-control" type="file" name="var_red"
                               value="{{old('var_red')}}" accept="image/*" >
                    </div>
                    @error('var_red')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Blanc: </label>

                    <div class="input-group">
                        <input  id="var_white" class="form-control" type="file" name="var_white"
                               value="{{old('var_white')}}" accept="image/*" >
                    </div>
                    @error('var_white')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Rose: </label>

                    <div class="input-group">
                        <input  id="var_pink" class="form-control" type="file" name="var_pink"
                               value="{{old('var_pink')}}" accept="image/*" >
                    </div>
                    @error('var_pink')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Jaune: </label>

                    <div class="input-group">
                        <input  id="var_yellow" class="form-control" type="file" name="var_yellow"
                               value="{{old('var_yellow')}}" accept="image/*" >
                    </div>
                    @error('var_yellow')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Orange: </label>

                    <div class="input-group">
                        <input  id="var_orange" class="form-control" type="file" name="var_orange"
                               value="{{old('var_orange')}}" accept="image/*" >
                    </div>
                    @error('var_orange')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Vert: </label>

                    <div class="input-group">
                        <input  id="var_green" class="form-control" type="file" name="var_green"
                               value="{{old('var_green')}}" accept="image/*" >
                    </div>
                    @error('var_green')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="condition">Condition</label>
                    <select name="condition" class="form-control">
                        <option value="">--Select Condition--</option>
                        <option selected value="default">Default</option>
                        <option value="new">New</option>
                        <option value="hot">Hot</option>
                    </select>
                    @error('condition')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stock">Quantity <span class="text-danger">*</span></label>
                    <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"
                           value="{{old('stock')}}" class="form-control">
                    @error('stock')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                    <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
                        <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    @error('photo')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $('#lfm').filemanager('image');

        $(document).ready(function () {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 100
            });
        });

        $(document).ready(function () {
            $('#description').summernote({
                placeholder: "Write detail description.....",
                tabsize: 2,
                height: 150
            });
        });
        // $('select').selectpicker();

    </script>

    {{--<script>--}}
    {{--  $('#cat_id').change(function(){--}}
    {{--    var cat_id=$(this).val();--}}
    {{--    // alert(cat_id);--}}
    {{--    if(cat_id !=null){--}}
    {{--      // Ajax call--}}
    {{--      $.ajax({--}}
    {{--        url:"/admin/category/"+cat_id+"/child",--}}
    {{--        data:{--}}
    {{--          _token:"{{csrf_token()}}",--}}
    {{--          id:cat_id--}}
    {{--        },--}}
    {{--        type:"POST",--}}
    {{--        success:function(response){--}}
    {{--          if(typeof(response) !='object'){--}}
    {{--            response=$.parseJSON(response)--}}
    {{--          }--}}
    {{--          // console.log(response);--}}
    {{--          var html_option="<option value=''>----Select sub category----</option>"--}}
    {{--          if(response.status){--}}
    {{--            var data=response.data;--}}
    {{--            // alert(data);--}}
    {{--            if(response.data){--}}
    {{--              $('#child_cat_div').removeClass('d-none');--}}
    {{--              $.each(data,function(id,title){--}}
    {{--                html_option +="<option value='"+id+"'>"+title+"</option>"--}}
    {{--              });--}}
    {{--            }--}}
    {{--            else{--}}
    {{--            }--}}
    {{--          }--}}
    {{--          else{--}}
    {{--            $('#child_cat_div').addClass('d-none');--}}
    {{--          }--}}
    {{--          $('#child_cat_id').html(html_option);--}}
    {{--        }--}}
    {{--      });--}}
    {{--    }--}}
    {{--    else{--}}
    {{--    }--}}
    {{--  })--}}
    {{--</script>--}}
@endpush
