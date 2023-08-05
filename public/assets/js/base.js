"use strict";

function confirmAlert(
    options,
    confirmCallback = ()=>{},
    cancelCallback = ()=>{}
) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn bg-gradient-success',
          cancelButton: 'btn bg-gradient-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: options.title ? options.title: 'Are you sure?',
        text: options.text ? options.text: "You won't be able to revert this!",
        icon: options.icon ? options.icon: 'warning',
        showCancelButton: true,
        confirmButtonText: options.confirmButtonText ? options.confirmButtonText: 'Yes, delete it!',
        cancelButtonText: options.cancelButtonText ? options.cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            confirmCallback();

        }else if (result.dismiss === Swal.DismissReason.cancel) {
            cancelCallback();
        }
    })
}