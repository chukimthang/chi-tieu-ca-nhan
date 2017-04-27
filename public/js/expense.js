function expense() {
  var current = this;

  this.init = function(url) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });
    current.add();
    current.delete();
    current.update();
    current.filterCategory();
    current.filterCategoryDate();
  }

  this.add = function() {
    $('#expense-create').on('click', '.btn.btn-primary', function() {
      var name = $('#name').val();
      var price = $('#price').val();
      var category_id = $('#category_id').val();
      var user_id = $('#user_id').val();
      var description = $('#description').val();
      
      var formData = new FormData();
      formData.append('name', name);
      formData.append('price', price);
      formData.append('category_id', category_id);
      formData.append('user_id', user_id);
      formData.append('description', description);
      
      $.ajax({
        url: url.add,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
      })
      .done(function(data) {
        if (data == 'fails') {
          alert('Số tiền mua của bạn lớn hơn số tiền hiện có');
        } else {
          swal("Đã thêm!", "Thêm thành công", "success");
          $('.modal').modal('hide');
          $('#expense-list').html(data);
        }
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

  this.update = function() {
    var dataId;

    $('#expense-list').on('click', '.update', function() {
      dataId = $(this).data('id');

      var name = $(this).parent().prevAll('#name-' + dataId).html();
      var price = $(this).parent().prevAll('#price-' + dataId).html();
      var category_id = $('#category-' + dataId).data('id');
      var description = $('#description-' + dataId).html();

      $('#edit-name').val($.trim(name));
      $('#edit-price').val($.trim(parseInt(price)) * 1000);
      $('#edit-category').val(category_id);
      $('#edit-description').val($.trim(description));
    });

    $('#expense-edit').on('click', '.btn.btn-primary', function() {
      var dataName = $('#edit-name').val();
      var dataPrice = $('#edit-price').val();
      var dataCategory = $('#edit-category').val();
      var dataDescription = $('#edit-description').val();
     
      var formData = new FormData();
      formData.append('id', dataId);
      formData.append('name', dataName);
      formData.append('price', dataPrice);
      formData.append('category_id', dataCategory);
      formData.append('description', dataDescription);

      $.ajax({
        url: url.update,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false
      })
      .done(function(data) {
        swal("Đã Cập Nhật!", "Cập nhật thành công", "success");
        $('#expense-list').html(data);
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
    $('#expense-list').on('click', '.delete', function() {
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
        $('#expense-list').html(data);
      })
      .fail(function() {
        alert('Lỗi !');
      });
    });
  }

  this.filterCategory = function() {
    $('#select-category').on('click', function() {
      var dataCategoryId = $(this).val();

      $.ajax({
        url: url.filterCategory,
        type: 'POST',
        data: {
          categoryId: dataCategoryId
        }
      })
      .done(function(data) {
        $('#expense-list').html(data);
      });
    });
  }

  this.filterCategoryDate = function() {
    $('.expense-filter').on('click', '.filter', function() {
      var dataCategoryId = $('#select-category').val();
      var dataStart = $('#start').val();
      var dataFinish = $('#finish').val();
      
      var formData = new FormData();
      formData.append('categoryId', dataCategoryId);
      formData.append('start', dataStart);
      formData.append('finish', dataFinish);

      $.ajax({
        url: url.filterCategoryDate,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false
      })
      .done(function(data) {
        $('#expense-list').html(data);
      });
    });
  }
}
