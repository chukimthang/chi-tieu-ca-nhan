<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-dt/css/jquery.dataTables.min.css') }}">

@if (count($expenses))
    <table class="table table-striped table-bordered table-hover" 
        id="dataTables-example">
        <thead>
            <tr>
                <th width="8%">STT</th>
                <th class="colum">Tên chi tiêu</th>
                <th class="colum" width="15%">Giá (VNĐ)</th>
                <th class="colum" width="15%">Chuyên mục</th>
                <th hidden="true">Mô tả</th>
                <th class="colum" width="18%">Thời gian</th>
                <th width="8%">Sửa</th>
                <th width="8%">Xóa</th>
            </tr>
        </thead>
        <?php 
            $total = 0;
        ?>
        <tbody id="expense-list" name="expense-list">
            @foreach ($expenses as $key => $expense)
                <tr class="odd gradeX" align="center">
                    <?php
                        $total = $total + $expense->price; 
                    ?>
                    <td>{!! $key + 1 !!}</td>
                    <td id="name-{!! $expense->id !!}">
                        {!! $expense->name !!}</td>
                    <td id="price-{!! $expense->id !!}">
                        {!! number_format($expense->price) !!}</td>
                    <td id="category-{!! $expense->id !!}"
                        data-id="{!! $expense->category->id !!}">
                        {!! $expense->category->name !!}</td>
                    <td id="description-{!! $expense->id !!}" hidden="true">
                        {!! $expense->description !!}
                    </td>
                    <td>{!! $expense->created_at !!}</td>
                    <td class="center">
                        <a href="#" data-toggle="modal"
                            data-target=".bs-example-modal-lg.edit"
                            data-id="{!! $expense->id !!}" 
                            class="update">
                            <span class="glyphicon glyphicon-edit">
                            </span>
                        </a>
                    </td>
                    <td class="colum">
                        <a href="javascript:void(0)" 
                            data-id="{!! $expense->id !!}" 
                            class="delete">
                            <span class="glyphicon
                                glyphicon-remove-sign">
                            </span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <h4 align="center">Tổng tiền: 
            <span class="total-money">{!! number_format($total) !!}</span> VNĐ
        </h4>
    </div>

    <div class="current-money">
        <h3 align="right">Tiền quỹ hiện tại:
            <span class="total-money">
                {!! number_format($currentUser->total_money) !!}
            </span>
            VNĐ
        </h3>
    </div>
@else
    <h4 align="center">Không có dữ liệu</h4>
@endif

<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable.js') }}"></script>
<script>
    var db = new datatable;
    db.init('#dataTables-example');
</script>
