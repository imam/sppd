function deletealert(url){
    alertify.confirm("Anda yakin ingin menghapus item ini?",function(e) {
        e.preventDefault();
        $.ajax({
            method: 'DELETE',
            url: url,
        }).done(function(){
            alertify.alert('success');
            window.location.reload();
        }).fail(function(){
            alertify.alert('fail');
        })
    });
}