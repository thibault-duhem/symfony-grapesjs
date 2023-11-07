import grapesjs from 'grapesjs';
import newsletterPreset from 'grapesjs-preset-newsletter';
import ckeditor from 'grapesjs-plugin-ckeditor';


import "./styles/app.css"
import "grapesjs/dist/grapes.min.js"
import "grapesjs/dist/css/grapes.min.css"
import "grapesjs-plugin-ckeditor/dist/index.js"
let $pageId=document.getElementById('gjs').getAttribute('data-page-id');


const editor = grapesjs.init({
    container : '#gjs',
    plugins: [newsletterPreset,ckeditor],
    pluginsOpts: {
        'gjs-plugin-ckeditor': {
            options: {
                language: 'en',
                extraPlugins: 'colorbutton,colordialog',
                autoParagraph: false,
                enterMode: 2,
                toolbar: [
                    { name: 'styles', items: ['Format' ] },
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'], },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                    { name: 'clipboard', items: ['Undo', 'Redo' ] },
                ]
            }
        }
    },
    storageManager: {
        type: 'remote', // Type of the storage, available: 'local' | 'remote'
        autosave: true, // Store data automatically
        autoload: true, // Autoload stored data on init
         stepsBeforeSave: 20, // If autosave enabled, indicates how many changes are necessary before store method is triggered
        options: {
            remote: {
                headers: {}, // Custom headers for the remote storage request
                urlStore: '/api/page/store/'+$pageId, // Endpoint URL where to store data project
                urlLoad: '/api/page/load/'+$pageId, // Endpoint URL where to load data project
                fetchOptions: opts => (opts.method === 'POST' ?  { method: 'PATCH' } : {}),
                onStore: data => ({ id: $pageId, data, html:  editor.getHtml(), css: editor.getCss() }),
                onLoad: result => result.data,
            },
        }
    },
    commands: {
        defaults: [
            {
                id: 'store-data',
                run(editor) {
                    editor.store();
                },
            }
        ]
    }
});

let btn_update_edit = document.getElementsByName("btn_update_and_edit")[0];
let btn_update_close = document.getElementsByName("btn_update_and_list")[0];

btn_update_edit.addEventListener('click', function(event) {
    editor.runCommand('store-data');
});

btn_update_close.addEventListener('click', function(event) {
    editor.runCommand('store-data');
});
