let trackModal = new bootstrap.Modal('#modal-track');
let bulkTrackModal = new bootstrap.Modal('#bulk-modal-track');

window.livewire.on('closeModal', function() {
    trackModal.hide();
})

window.livewire.on('closeBulkModal', function() {
    bulkTrackModal.hide();
})

window.livewire.on('openModal', function() {
    trackModal.show();
})

window.livewire.on('reloadTable', function() {
    $('#track').DataTable().ajax.reload();
})

function setHabitTrack(id) {
    Livewire.emit('setHabitTrack', id);
}

document.addEventListener('DOMContentLoaded', function() {
    $('#track').DataTable({
        ajax: AJAX_URL,
        processing: true,
        serverSide: true,
        "order": [[0, 'desc']],
        columns: [
            { data: 'id' },
            {
                data: 'name',
                render: function(data, type, row, meta) {
                    return `<div class="extras-wrapper">
                        ${data}
                        <div class="extras-items">
                        <i onclick="setHabitTrack(${row.id})" class="fa fa-pen text-xs text-success" role="button"></i>
                        <i class="fa fa-info-circle text-xs text-info" role="button" data-bs-toggle="tooltip" data-bs-placement="top" title="${row.description}"></i>
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
        ],
        "drawCallback": function (settings) {
            let tooltipTriggerList = [].slice.call(document.querySelectorAll('#track [data-bs-toggle="tooltip"]'))
            let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        }
    })
});



$(function() {
    $('#single-track-btn').click(function () {
        Livewire.emit('single_refresh');
    });

    $('#bulk-track-btn').click(function () {
        Livewire.emit('bulk_refresh');
    });
})