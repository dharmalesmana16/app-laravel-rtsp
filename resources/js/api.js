import axios from "axios";

export default  async function fetchWilayah(){
    const response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`)
    const data = await response.json();
    return data;
}

