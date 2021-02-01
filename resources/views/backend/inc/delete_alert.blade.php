@section('script')
<script>
function deleteItem($id) {
    swal({
        title: '你確定要刪除嗎？',
        text: '這動作不能復原',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '我確定刪除',
        cancelButtonText: '不要刪除'
    }).then((result) => {
        if (result.value) {
            $('#form-delete' +  $id).submit();
        }
    });
}
</script>
@endsection