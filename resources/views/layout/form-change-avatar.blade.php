<h4>Update Avatar</h4>
<div class="d-flex flex-wrap justify-content-between">
    <div class="col-12 col-sm-12 col-md-8">
        <form action="{{ route($action, $param ?? '') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="preview_image" id="preview_image"
                        accept=".jpg,.jpeg,.svg,.png,.gif">
                    <label class="custom-file-label" for="preview_image" aria-describedby="inputGroupFileAddon02">Choose
                        file</label>
                </div>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-primary">Upload</button>
                    <button type="reset" class="btn btn-outline-primary">Reset</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-8 col-sm-4">
        <img src="{{ null !== $avatar ? asset('storage/uploads/avatar/' . $avatar) : asset('assets/images/faces-clipart/pic-1.png') }}"
            class="img-thumbnail" id="preview_image" alt="">
    </div>
</div>
@if ($errors->any() && $errors->has('preview_image'))
    @foreach ($errors as $e)
        <p class="text-danger">{{ $e }}</p>
    @endforeach
@endif
