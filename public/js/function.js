var fileObj;

function uploadAvatar(e) {
    e.preventDefault();
    fileObj = e.dataTransfer.files[0];
    var formData = new FormData();
    formData.append('file',fileObj);
    $.ajax({
        type : 'POST',
        url : updateAvatarRoute,
        contentType : false,
        processData : false,
        data : formData,
        success: function(response) {
            console.log(response);
        }
    })
}
