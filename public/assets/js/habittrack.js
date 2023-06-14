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
                    return `<div class="badge badge-success">exercise</div>`
                }
            },
            { data: 'time' },
            { data: 'date', render: (data, type, row) => row.formattedDate }
        ]
    })
});
