function user() {
  var current = this;
  var dataImage;

  this.init = function (url) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });

    $('#upload-avatar').on('click', function () {
      if (typeof $('#avatar')[0].files[0] !== 'undefined') {
        current.uploadFile($('#avatar')[0].files[0]);
      } else {
        alert('Bạn chưa chọn ảnh');
      }
    });
    current.updateProfile();
    current.delete();
  };

  this.uploadFile = function (file) {
    var formData = new FormData();
    $('#upload-avatar').prop('disabled', true);
    $('#process-avatar').show();
    formData.append('upload', file);

    current.currentUpload = $.ajax({
      url: url.uploadAvatar,
      type: 'POST', 
      dataType: 'json',
      complete: function (data) {
        $('#upload-avatar').prop('disabled', false);
        $('#process-avatar').hide();
        switch (data.status) {
          case 200:
            dataImage = data.responseJSON.url;
            $('#display-avatar').html('');
            $('#display-avatar').append("<img src='" + dataImage 
              + "' alt='' width='100px' height='100px'>");
            break;
          case 500: 
            alert('Unknown error: ' + data.status);
            break;
          default :
            alert(data.responseJSON.message);
        }
      },
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    });
  };

  this.updateProfile = function() {
    var dataId;
    $('.submit-update-profile').on('click', '.btn-primary', function() {
      dataId = $(this).data('id');
      dataName = $('#name').val();
      dataAvatar = dataImage;
      dataPassword = $('#password').val();

      var formData = new FormData();
      formData.append('id', dataId);
      formData.append('name', dataName);
      formData.append('avatar', dataAvatar);
      formData.append('password', dataPassword);

      $.ajax({
        url: url.updateProfile,
        type: 'POST',
        dataType: 'json',
        data: formData,
        contentType: false,
        processData: false,
        success: function() {
          swal("Đã Cập Nhật!", "Cập nhật thành công", "success");
        },
        error: function(data) {
          var errors = '';
          for(datos in data.responseJSON){
            errors += data.responseJSON[datos] + '<br>';
          }
          $('.form-error-profile').show().html(errors);
        }
      })
    });
  }

  this.delete = function() {
    $('#user-all').on('click', '.delete', function() {
      var dataId = $(this).data('id');
      $.ajax({
        url: '/admin/user/deleteAjax',
        type: 'POST',
        data: {
          id: dataId
        }
      })
      .done(function(data) {
        swal("Đã xóa!", "Xóa thành công", "success");
        $('#user-all').html(data);
      })
    });
  }
}
