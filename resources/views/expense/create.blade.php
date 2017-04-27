<div class="modal fade bs-example-modal-lg create" tabindex="-1" 
    role="dialog" aria-labelledby="myLargeModalLabel" 
    id="expense-create">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                    aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title title" align="center">Thêm Chi Tiêu</h3>
            </div>

            <div class="form-error"></div>
            
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('name', 'Chi Tiêu') !!}
                    {!! Form::text('name', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Mời Bạn Nhập Chi Tiêu'
                    ]) !!}
                </div>

                <div class="form-group">
                   {!! Form::label('price', 'Giá') !!}
                   {!! Form::text('price', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Mời Bạn Nhập Giá'
                   ]) !!}
                </div>

                <div class="form-group">
                   {!! Form::label('category_id', 'Chuyên Mục') !!}
                   {!! Form::select('category_id', $categories, null, [
                        'class' => 'form-control',
                        'placeholder' => ' -- Mời Bạn Chọn Chuyên Mục'
                   ]) !!}
                </div>

                <div class="form-group">
                   {!! Form::label('description', 'Mô Tả') !!}
                   {!! Form::textarea('description', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Mời Bạn Nhập Mô Tả'
                   ]) !!}
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" 
                    data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">
                    Thêm</button>
            </div>
        </div>
    </div>
</div>
