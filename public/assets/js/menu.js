"use strict";
function create( e ) {
    e.preventDefault();
    
    const form = e.target;
    const fd = new FormData( form );
    const name = fd.get('name');

    
}