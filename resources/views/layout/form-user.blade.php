<form action="{{-- {{ route($action, $param ?? '') }} --}}"
    method="post" class="need-validate">
    {{ csrf_field() }}
    {{-- USER_ID NAME GENDER EMAIL PHONE BIRTHDAY ADDRESS
    --}}
    <div class="form-group">
        <label for="user_id">USER_ID</label>
        {!! Form::text('user_id', $user_profile->user_id ?? '', [
        'id' => 'user_id',
        'class' => 'form-control',
        'pattern' => '[0-9a-zA-Z]*',
        'required',
        'autocomplete' => 'off',
        isset($user_profile->user_id) ? 'readonly' : '',
        ]) !!}
    </div>
    <div class="form-group">
        <label for="name">NAME</label>
        {!! Form::text('name', $user_profile->name ?? '', [
        'id' => 'name',
        'class' => 'form-control',
        'pattern' => '[a-zA-Z \.\p{L}]*',
        'required',
        'autocomplete' => 'off',
        ]) !!}
    </div>
    <div class="form-group">
        <label for="gender">GENDER</label>
        <div class="d-flex btn-group btn-group-toggle" data-toggle="buttons">
            <label class="form-check-label btn btn-outline-secondary">
                Male
                {!! Form::radio('gender', 'male', ($user_profile->gender ?? '') == 'male' ? 1 : 0, [
                'class' => 'custom-control-input',
                'required',
                ]) !!}
            </label>
            <label class="form-check-label btn btn-outline-secondary">
                Female
                {!! Form::radio('gender', 'female', ($user_profile->gender ?? '') == 'female' ? 1 : 0, [
                'class' => 'custom-control-input',
                'required',
                ]) !!}
            </label>
            <label class="form-check-label btn btn-outline-secondary">
                Other
                {!! Form::radio('gender', 'other', ($user_profile->gender ?? '') == 'other' ? 1 : 0, [
                'class' => 'custom-control-input',
                'required',
                ]) !!}
            </label>
        </div>
        <div class="invalid-feedback">Gender is required</div>
    </div>
    <div class="form-group">
        <label for="email">EMAIL</label>
        {!! Form::email('email', $user_profile->email ?? '', [
        'id' => 'email',
        'class' => 'form-control',
        'pattern' => '[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$',
        'required',
        'autocomplete' => 'off',
        ]) !!}
    </div>
    <div class="form-group">
        <label for="phone">PHONE</label>
        {!! Form::tel('phone', $user_profile->phone ?? '', [
        'id' => 'phone',
        'class' => 'form-control',
        'pattern' => '^[+]?[(]?[0-9]{1,4}[)]?[\s\d]*$',
        'minlength' => 8,
        'maxlength' => 14,
        'required',
        'autocomplete' => 'off',
        ]) !!}
    </div>
    <div class="form-group">
        <label for="birthday">BIRTHDAY</label>
        {!! Form::date('birthday', $user_profile->birthday ?? '', [
        'id' => 'birthday',
        'class' => 'form-control',
        'required',
        'max' => date_format(date_sub(date_create(date('Y') . '-12-31'), date_interval_create_from_date_string('16 years')), 'Y-m-d'),
        ]) !!}
    </div>
    <div class="form-group">
        <label for="address">ADDRESS</label>
        {!! Form::text('address', $user_profile->address ?? '', [
        'id' => 'address',
        'class' => 'form-control',
        'required',
        'pattern' => '[a-zA-Z0-9 ,.-/()\p{L}]*',
        'autocomplete' => 'off',
        ]) !!}
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
@include('layout.show-form-errors')
