<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-dt/css/jquery.dataTables.min.css') }}">

@if (count($users))
    <table class="table table-striped table-bordered table-hover" 
        id="dataTables-example">
        <thead>
            <tr>
                <th class="colum" width="10%">STT</th>
                <th class="colum">Họ tên</th>
                <th class="colum">Email</th>
                <th class="colum">Quyền</th>
                <th class="colum" width="12%">Xóa</th>
            </tr>
        </thead>

        <tbody id="dataTables-example" class="user-list">
            @foreach ($users as $key => $user)
                <tr class="odd gradeX" align="center"
                    id="row-{!! $user->id !!}">
                    <td>{!! ++$key !!}</td>
                    <td>{!! $user->name !!}</td>
                    <td>{!! $user->email !!}</td>
                    <td>{!! config('myconfig.auth')[$user->is_admin] !!}
                    </td>
                    <td class="colum" width="12%">
                        @if($user->is_admin == 0)
                            <a href="javascript:void(0)"
                                data-id="{!! $user->id !!}"
                                class="delete">
                                <span class="glyphicon 
                                    glyphicon-trash">
                                </span>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h4 align="center">@lang('message.empty_data')</h4>
@endif

<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable.js') }}"></script>
<script type="text/javascript">
    var db = new datatable;
    db.init('#dataTables-example');
</script>
