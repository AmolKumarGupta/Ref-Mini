"use strict";

/* menu section */
let createModal = new bootstrap.Modal( document.querySelector('#modal-menusection-create') );
let editModal = new bootstrap.Modal( document.querySelector('#modal-menusection-edit') );

function openEditModal(that) {
    let data = JSON.parse(that.dataset.edit);
    let editForm = document.querySelector('#modal-menusection-edit');

    editForm.querySelector('input[name="name"]').value = data.name;
    editForm.querySelector('input[name="id"]').value = data.id;
    editModal.show();
}

function create (e) {
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


function edit (e) {
    e.preventDefault();

    const form = e.target;
    const fd = new FormData( form );
    const name = fd.get('name');
    const id = fd.get('id');
    form.querySelector(`[data-error="name"]`).textContent = "";

    Livewire.emit('updateSection', id, name);
}

function deleteMenuSection(id) {
    confirmAlert({}, () => livewire.emit('deleteMenuSection', id));
}

function deleteMenuItem(id) {
    confirmAlert({}, () => livewire.emit('deleteMenuItem', id));
}

window.addEventListener('focusError', event => {
    let editForm = document.querySelector('#modal-menusection-edit');
    editForm.querySelector(`[data-error="name"]`).textContent = event.detail.err;
});
window.addEventListener('sectionUpdated', event => {
    editModal.hide();
});

/* menu items */
let createItemModal = new bootstrap.Modal( document.querySelector('#modal-menuitem-create') );
let editItemModal = new bootstrap.Modal( document.querySelector('#modal-menuitem-edit') );

function setFormIconDisplay(that) {
    let val = that.value;
    if (val) {
        that.parentElement.querySelector('span>i').setAttribute('class', `fa fa-${ val }`);
    }else {
        that.parentElement.querySelector('span>i').setAttribute('class', `fa fa-home`);
    }
}

function createItem (e) {
    e.preventDefault();
    
    const form = e.target;
    const fd = new FormData( form );
    const name = fd.get('name');
    const section_id = document.querySelector('[data-active-section-id]').dataset.activeSectionId;
    const url = fd.get('url');
    const icon = fd.get('icon');

    form.querySelectorAll(`[data-error]`).forEach( function(ele) {
        ele.textContent = "";
    });

    fetch(createItemUrl, {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            name,
            section_id,
            url,
            icon
        }),

    }).then((response) => {
        if (! response.ok) {
            throw response.json();
        }
        return response.json()

    }).then((data) => {
        livewire.emit('refreshMenuItem');
        createItemModal.hide();

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

function openEditItemModal(that) {
    let data = JSON.parse(that.dataset.edit);
    let editForm = document.querySelector('#modal-menuitem-edit');

    editForm.querySelectorAll('input[name]').forEach((ele) => {
        if (ele.getAttribute('name') && data[ ele.getAttribute('name') ]) {
            ele.value = data[ ele.getAttribute('name') ];
        }

        if (ele.getAttribute('name') == 'icon') {
            setFormIconDisplay(ele);
        }
    });

    editItemModal.show();
}

function editItem (e) {
    e.preventDefault();

    const form = e.target;
    const fd = new FormData( form );
    let data = {
        id: fd.get('id'),
        name: fd.get('name'),
        url: fd.get('url'),
        icon: fd.get('icon'),
    }
    
    form.querySelectorAll(`[data-error]`).forEach( function(ele) {
        ele.textContent = "";
    });

    Livewire.emit('updateItems', JSON.stringify(data));
}

window.addEventListener('focusItemError', event => {
    let json = event.detail.err;
    if (json) {
        let errors = JSON.parse(json);
        let editForm = document.querySelector('#modal-menuitem-edit');

        Object.entries(errors).forEach( ([key, val]) => {
            editForm.querySelector(`[data-error="${key}"]`).textContent = val;
        });
    }
});
window.addEventListener('itemUpdated', event => {
    editItemModal.hide();
});