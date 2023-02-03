import {fetchFrontend} from '/frontend/js/modules/fetchTools.js'; 

export let tools;
export let toolBox;

tools = document.getElementsByClassName('tool');
toolBox = document.getElementsByClassName('toolBox')[0];

for(const tool of tools){
    if(tool.id !== 'dataFonts'){
        tool.addEventListener('click',(e)=>includeTools(e.target),{'once':'true'});
    }
    tool.addEventListener('click',(e)=>displayTool(e.target));
}

export async function includeTools(toolName){
    let uriToolHtml = `/frontend/toolHtml/${toolName.id}.html`;
    let uriToolJs = `/frontend/js/toolJs/${toolName.id}.js`;
    let cardPromise = fetchFrontend(uriToolHtml);
    cardPromise.then((html)=>{
        let toolContainer = document.createElement('div');
        toolContainer.classList.add('toolContainer');
        toolContainer.classList.add(toolName.id);
        toolContainer.innerHTML = html;
        toolBox.appendChild(toolContainer);
    })
    .then(()=>{
        import(uriToolJs);
    })
    
}

// Display toolContainer
export function displayTool(toolName){
    let toolContainers = toolBox.getElementsByClassName('toolContainer');
    
    activeTool(toolName);
    for(const toolContainer of toolContainers){
        toolContainer.style.display = "none";

        if (toolContainer.classList.contains(toolName.id)) {
        toolContainer.style.display = "grid";
        }
    }
}

// Para darle estilo a la tool
export function activeTool(toolName){
    for (const tool of tools) {
        tool.classList.remove('active');
    }
    toolName.classList.add('active');
}

export function blockTools(){
    for (const tool of tools) {
        if (tool.id !== 'dataFonts') {
            tool.style.display = 'none'            
        }
    }
}

export function unBlockTools(){
    for (const tool of tools) {
        if (tool.id !== 'dataFonts') {
            tool.style.display = 'flex'            
        }
    }
}