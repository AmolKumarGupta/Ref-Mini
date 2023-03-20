"use strict";

var reposContainer = document.querySelector('#repos');
var sortableRepos = Sortable.create(reposContainer, {
    forceFallback: true,
    onUpdate: function (evt) {
        let children = Array.from(reposContainer.childNodes);
        let orderdata = [];
        children.forEach(function (child) {
            if (child instanceof HTMLElement) {
                orderdata.push(child.getAttribute('wire:key'));
            }
        });
        livewire.emit('sort', JSON.stringify(orderdata));
    },
});