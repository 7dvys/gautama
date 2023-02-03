export async function fetchBackend(url){
    
    const fetchResponse = await fetch(url);
    const data = await fetchResponse.json();
    return data;
}

export async function fetchFrontend(url){
    const fetchResponse = await fetch(url);
    const data = await fetchResponse.text();
    return data;
}
