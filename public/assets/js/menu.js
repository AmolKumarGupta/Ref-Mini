"use strict";

let createModal = new bootstrap.Modal( document.querySelector('#modal-menusection-create') );

function create( e ) {
    e.preventDefault();
    
    const form = e.target;
    const fd = new FormData( form );
    const name = fd.get('name');
    form.querySelector(`[data-error="name"]`).textContent = "";

    fetch(createUrl, {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({name}),

    }).then((response) => {
        if (! response.ok) {
            throw response.json();
        }
        return response.json()

    }).then((data) => {
        livewire.emit('refreshMenuSection');
        createModal.hide();

    }).catch((err) => {
        if (err instanceof Promise) {
            err.then((d) => {
                let arr = Object.entries(d);
                arr.forEach( ([key, val]) => {
                    console.log({key, val});
                    form.querySelector(`[data-error="${key}"]`).textContent = val;
                })
            })
        }
    });

}