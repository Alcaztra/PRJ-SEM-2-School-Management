@isset($result)
    @if ($result)
        <div class='alert alert-info alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Notify !</strong> Profile updated, please login againt.</div>
    @endif
@endisset
<h4 class="">Profile Information</h4>
<div class="table-responsive">
    <table class="table table-striped">
        @foreach (($user_profile = Auth::guard($guard_name)->user())->toArray() as $key => $value)
            <tr>
                <th class="text-uppercase">{{ $key }}</th>
                <td>
                    @if ($key == 'avatar')
                        <img src="{{ null !== $user_profile->avatar ? asset('storage/uploads/avatar/' . $user_profile->avatar) : asset('assets/images/faces-clipart/pic-1.png') }}"
                            class="img-thumbnail" alt="">
                    @elseif ($key == 'birthday')
                        {{ date_format(date_create($value), 'Y, M d') }}
                    @else
                        {{ $value }}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>
