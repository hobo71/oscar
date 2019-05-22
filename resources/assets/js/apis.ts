import axios from "axios";
export default {
  
  getAlquileresDataForAgenda() {
    return axios.get("alquileres/data")
  },
  getServices() {
    return axios.get("services");
  },
  getEmpresa(id) {
    return axios.get("empresas/" + id);
  },
  getEmpresas() {
    return axios.get("empresas");
  },
  getCliente(id) {
    return axios.get("clientes/" + id);
  },
  getClientes() {
    return axios.get("clientes");
  },
  getVehiculo(id) {
    return axios.get("vehiculos/" + id);
  },
  getVehiculos() {
    return axios.get("vehiculos");
  },
  getMarcas() {
    return axios.get("marcas");
  },
  getAlquiler(id) {
    return axios.get("alquileres/" + id);
  },
  getAlquileres(page, cliente_id, vehiculo_id) {
    let baseUrl = "alquileres?";

    if (page) baseUrl += "page=" + page + "&";
    if (cliente_id != null) baseUrl += "cliente=" + cliente_id + "&";
    if (vehiculo_id != null) baseUrl += "vehiculo=" + vehiculo_id + "&";

    return axios.get(baseUrl);
  }
};
