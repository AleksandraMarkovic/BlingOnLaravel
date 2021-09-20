<form action="@if($action == 'products.update') {{ route($action, $product->id) }} @else {{ route($action) }} @endif" method="post" enctype="multipart/form-data" class="mt-3">
    @csrf
    @if($action == "products.update")
        @method('PUT')
    @endif
    <div class="mb-3">
        <label for="productName" class="form-label">Product name</label>
        <input type="text" class="form-control" id="productName" name="productName" value="{{ $product->name ?? old('name') }}"/>
        @error('productName')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="productDescription" class="form-label">Product description</label>
        <textarea name="productDescription" class="form-control" id="productDescription">{{ $product->description ?? old('description') }}</textarea>
        @error('productDescription')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="productImage" class="form-label mr-3">Product image</label>
        <input type="file"  id="productImage" name="productImage"/>
        @error('productImage')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="productColor" class="form-label mr-4">Product color</label>
        <select name="productColor" id="productColor">
            <option value="0">Choose...</option>
            @if(isset($product))
                <option value="{{ $product->color_id }}" selected>{{ $product->color }}</option>
                @foreach($colors as $color)
                    @if($product->color_id != $color->id)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endif
                @endforeach
            @else
                @foreach($colors as $color)
                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            @endif
        </select>
        @error('productColor')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="productType" class="form-label mr-4">Product type</label>
        <select name="productType" id="productType">
            <option value="0">Choose...</option>
            @if(isset($product))
                <option value="{{ $product->type_id }}" selected>{{ $product->type }}</option>
                @foreach($types as $type)
                    @if($product->type_id != $type->id)
                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endif
                @endforeach
            @else
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach
            @endif
        </select>
        @error('productType')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="brandName" class="form-label">Brand name</label>
        <input type="text" class="form-control" id="brandName" name="brandName" value="{{ $product->brand ?? old('brand') }}"/>
        @error('brandName')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="productPrice" class="form-label">Product price</label>
        <input type="text" class="form-control" id="productPrice" name="productPrice" value="{{ $product->price ?? old('price') }}"/>
        @error('productPrice')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <ul>
            <li class="mb-2">
                Additional images
            </li>
            <li>
                <input type="file"  id="image1" name="image1" class="mb-2"/>
                @error('image1')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </li>
            <li>
                <input type="file"  id="image2" name="image2" class="mb-2"/>
                @error('image2')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </li>
            <li>
                <input type="file"  id="image3" name="image3"/>
                @error('image3')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </li>
        </ul>
    </div>
    <div class="mb-3">
        <label for="productSize" class="form-label">Product sizes</label>
        @if(isset($product))
                <input type="text" class="form-control mb-2" id="productSize" name="productSize" value="@foreach($sizes as $size){{ $size->size }} @if(!$loop->index == count($sizes) -1),@endif @endforeach"/>
        @else
            <input type="text" class="form-control" id="productSize" name="productSize" />
        @endif
        <div class="form-text text-muted">If there is multiple sizes please separate them by comma ( , ).</div>
        @error('productSize')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-lg" id="submitBtn">Submit</button>
</form>
