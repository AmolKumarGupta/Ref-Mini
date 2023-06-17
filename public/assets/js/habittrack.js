let trackModal = new bootstrap.Modal('#modal-track');

window.livewire.on('closeModal', function() {
    trackModal.hide();
})

document.addEventListener('DOMContentLoaded', function() {
    $('#track').DataTable({
        ajax: AJAX_URL,
        processing: true,
        serverSide: true,
        columns: [
            { data: 'id' },
            { data: 'name' },
            {
                data: 'id', render: function(data, type, row, meta) {
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
