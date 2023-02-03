import { includeTools,tools } from "/frontend/js/modules/tools.js";
import { fetchBackend } from "/frontend/js/modules/fetchTools.js";
import { blockTools,unBlockTools } from "/frontend/js/modules/tools.js";

export const tables = setTables();


export async function checkFonts(){
    let mlProducts;
    let cbProducts;
    let cbVendors;
    let error;
    let dataFontsTool = tools.dataFonts;

    includeTools(dataFontsTool);

    for (const table in await tables) {
        switch (table) {
            case 'cbProducts':
                cbProducts = await fetchBackend('/backend/backend.php/database/getRowsCount?table=cbProducts');
                if(cbProducts[0][0][0] == 0){
                    error = 1};
                break;
            case 'mlProducts':
                mlProducts = await fetchBackend('/backend/backend.php/database/getRowsCount?table=mlProducts');
                if(mlProducts[0][0][0] == 0){
                    error = 1};
                break;
            case 'cbVendors':
                cbVendors = await fetchBackend('/backend/backend.php/database/getRowsCount?table=cbVendors');
                if(cbVendors[0][0][0] == 0){
                    error = 1};
                break;
        }
    }    

    if (typeof mlProducts === 'undefined') {
        // crear ml productos
        fetchBackend('/backend/backend.php/database/createTable?tableName=mlProducts')
        error = 1;
    }
    if (typeof cbProducts === 'undefined') {
        // craer cb productos
        fetchBackend('/backend/backend.php/database/createTable?tableName=cbProducts')
        error = 1;

    }
    if (typeof cbVendors === 'undefined') {
        // craer cb proveedores
        fetchBackend('/backend/backend.php/database/createTable?tableName=cbVendors')
        error = 1;

    }

    if(error){
        blockTools();
    }

}

export async function setTables(){
    let data = await fetchBackend('/backend/backend.php/database/getTables')
    return data;
}

checkFonts();
