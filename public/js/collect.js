function collect() {
  var current = this;

   this.init = function(url) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });
    current.add();
    current.delete();
    current.filter();
  }

  this.add = function() {
    $('#collect-create').on('click', '.btn.btn-primary', function() {
      var dataPrice = $('#collect-price').val();
      $.ajax({
        url: url.add,
        type: 'POST',
        data: {
          price: dataPrice
        }
      })
      .done(function(data) {
        swal("Đã thêm!", "Thêm thành công", "success");
        $('#collect-all').html(data);
        $('.modal').modal('hide');
      })
      .fail(function(data) {
        var errors = '';
        $('.form-error').html('');
        for(datos in data.responseJSON){
          errors += data.responseJSON[datos] + '<br>';
        }
        $('.form-error').show().html(errors);
      });
    });
  }

  this.delete = function() {
    $('#collect-all').on('click', '.delete', function() {
      var dataId = $(this).data('id');
      $.ajax({
        url: url.delete,
        type: 'POST',
        data: {
          id: dataId
        }
      })
      .done(function(data) {
        swal("Đã xóa!", "Xóa thành công", "success");
        $('#collect-all').html(data);
      });
      $(this).parent().parent().remove();
    });
  }

  this.filter = function() {
    $('#collect-filter').on('click', '.filter', function() {
      var dataStart = $('#start').val();
      var dataFinish = $('#finish').val();
      
      $.ajax({
        url: url.filter,
        type: 'POST',
        data: {
          start: dataStart,
          finish: dataFinish 
        }
      })
      .done(function(data) {
        $('#collect-all').html(data);
      });
    });
  }
}
