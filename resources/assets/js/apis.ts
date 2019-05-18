import axios from "axios";
export default {
  
  api_url :  document.head.querySelector('meta[name="app-api"]').content,
  getAlquileresDataForAgenda() {
    return axios.get(this.api_url+'alquileres/data')
  },
  getServices() {
    return axios.get(this.api_url+"services");
  },
  getEmpresa(id) {
    return axios.get(this.api_url+"empresas/" + id);
  },
  getEmpresas() {
    return axios.get(this.api_url+"empresas");
  },
  getCliente(id) {
    return axios.get(this.api_url+"clientes/" + id);
  },
  getClientes() {
    return axios.get(this.api_url+"clientes");
  },
  getVehiculo(id) {
    return axios.get(this.api_url+"vehiculos/" + id);
  },
  getVehiculos() {
    return axios.get(this.api_url+"vehiculos");
  },
  getMarcas() {
    return axios.get(this.api_url+"marcas");
  },
  getAlquiler(id) {
    return axios.get(this.api_url+"alquileres/" + id);
  },
  getAlquileres(page, cliente_id, vehiculo_id) {
    let baseUrl = this.api_url+"alquileres?";

    if (page) baseUrl += "page=" + page + "&";
    if (cliente_id != null) baseUrl += "cliente=" + cliente_id + "&";
    if (vehiculo_id != null) baseUrl += "vehiculo=" + vehiculo_id + "&";

    return axios.get(baseUrl);
  }
};
