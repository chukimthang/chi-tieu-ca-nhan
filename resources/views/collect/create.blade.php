<div class="modal fade create" tabindex="-1" role="dialog"
    id="collect-create">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h3 class="modal-title title" align="center">
                    Thêm thu nhập
                </h3>
            </div>
            
            <div class="form-error"></div>

            <div class="modal-body form">
                <div class="form-group">
                    {!! Form::label('Tiền thu') !!}
                    {!! Form::text('price', null, [
                        'class' => 'form-control',
                        'id' => 'collect-price'
                    ]) !!}
                </div>
            </div>

            <div class="modal-footer form">
                {!! Form::submit('Đóng', [
                    'class' => 'btn btn-default',
                    'data-dismiss' =>'modal'
                ]) !!}
                {!! Form::submit('Thêm', ['class' => 'btn btn-primary 
                    btn-create']) !!}
            </div>
        </div>
    </div>
</div>
