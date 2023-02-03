import { checkFonts } from "/frontend/js/modules/setup.js";
import { toolBox,tools } from "/frontend/js/modules/tools.js";

let dataFontsToolContainer = toolBox.getElementsByClassName(tools.dataFonts.id)[0];
let dataFontsCards = dataFontsToolContainer.getElementsByClassName('card');

// Drag and drop luego
for(const card of dataFontsCards){

    ['drag','dragstart','dragenter','dragleave','dragover','drop'].forEach(element => {
        card.addEventListener(element,preventDefaults)
    });
    
    card.addEventListener('submit',preventDefaults,false);
    card.addEventListener('submit',submitForm,false);
    card.addEventListener('drop',uploadFormDrop,false);
}

function submitForm(e){
    let formData = new FormData(e.target);
    let table;

    switch (e.target.classList[0]) {
        case 'mlProducts':
            table='mlProducts';
            break;
        case 'cbProducts':
            table='cbProducts';
            break;
        case 'cbVendors':
            table='cbVendors';
            break;
    }
    uploadData(formData,table);
}

function uploadFormDrop(e){
    let cardForm = e.target.getElementsByTagName('form')[0];
    let dt = e.dataTransfer;
    let file = dt.files[0];
    let table;

    switch (cardForm.classList[0]) {
        case 'mlProducts':
            table='mlProducts';
            break;
        case 'cbProducts':
            table='cbProducts';
            break;
        case 'cbVendors':
            table='cbVendors';
            break;
    }

    
    let formData = new FormData(cardForm);
    formData.set('file',file);

    uploadData(formData,table);

    dt.clearData();

}

function uploadData(formData,table){
    let url = '/backend/backend.php/files/upload?table='+table;
    let entries = formData.entries();
    let data = entries.next();
    if(data.value[1].name !== ""){
        fetch(url,{
            method:'POST',
            body:formData
        })
        .then(response =>response.json())
        .then(data =>console.log(data))
    
        checkFonts();
    }
  

}

function preventDefaults(e){
    e.preventDefault();
    e.stopPropagation();
}

function addHighlightZone(e){
    e.target.classList.add('highlight'); 
}

function removeHighlightZone(e){
    e.target.classList.remove('highlight');       
}