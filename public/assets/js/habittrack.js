let trackModal = new bootstrap.Modal('#modal-track');

window.livewire.on('closeModal', function() {
    trackModal.hide();
})

window.livewire.on('reloadTable', function() {
    $('#track').DataTable().ajax.reload();
})

document.addEventListener('DOMContentLoaded', function() {
    $('#track').DataTable({
        ajax: AJAX_URL,
        processing: true,
        serverSide: true,
        columns: [
            { data: 'id' },
            {
                data: 'name',
                render: function(data, type, row, meta) {
                    return `<div class="extras-wrapper">
                        ${data}
                        <div class="extras-items">
                        <i class="fa fa-pen text-xs text-success" role="button"></i>
                        <i class="fa fa-info-circle text-xs text-info" role="button"></i>
                        </div>
                    </div>`
                }

            },
            {
                data: 'id',
                className: "text-center",
                render: function(data, type, row, meta) {
                    if (!row.category) {
                        return '';
                    }

                    return `<div
                    class="badge badge-success"
                    style="color: ${row.category.color}; background-color: ${row.category.bgcolor};"
                    >${row.category.name}</div>`
                }
            },
            {
                data: 'time', render: function(data, type, row, meta) {
                    return row.formattedTime
                }
            },
            { data: 'date', render: (data, type, row) => row.formattedDate }
        ]
    })
});
