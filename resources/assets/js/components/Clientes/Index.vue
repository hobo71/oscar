<template>
  <div>
    <base-header model="clientes" :total="filteredClientes.length">
      <a href="#" v-on:click.prevent="mergeContacts()" :class="'d-print-none btn border-0 btn-sm btn-outline-' + mergeBtn.class " >
        {{mergeBtn.text}} <i :class="'fa fa-' +mergeBtn.icon"></i> </a>
      <input type="text" v-model="query" class="w-25 form-control border-warning d-print-none" placeholder="Buscar..." >
    </base-header>
    <cliente-create></cliente-create>
    <base-loader v-if="clientes.length==0"></base-loader>
    <table class="table table-borderless table-sm table-hover" v-else>
      <thead>
        <tr>
          <th v-if="editmode"></th>
          <th>ID</th>
          <th>Cliente</th>
          <th>Alquileres</th>
          <th>DNI</th>
          <th>Email</th>
          <th class="d-print-none"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cliente in filteredClientes" :key="cliente.id" :class="[{'table-warning':frecuente(cliente.cantidad)}, {'o-50':cliente.cantidad ==0}]" >
          <td v-if="editmode">
            <input type="checkbox" v-model="selected" :value="cliente.id">
          </td>
          <td>
            <id-badge :number-id="cliente.id"></id-badge>
          </td>
          <td>
            <cliente-badge :id="cliente.id" :nombre="cliente.apellido + ', ' + cliente.nombre"></cliente-badge>
            <router-link :to="'/empresas/'+cliente.empresa_id" class="btn btn-sm btn-outline-warning border-0" >{{ cliente.empresa }}</router-link>
          </td>
          <td>
            <span class="badge badge-light text-muted px-2">{{ cliente.cantidad}}</span>
            <i v-if="frecuente(cliente.cantidad)" class="fa fa-star text-warning"></i>
          </td>
          <td>{{ cliente.dni }}</td>
          <td>
            <a :href="'mailto:' + cliente.email" class="btn btn-sm btn-outline-primary border-0" >{{ cliente.email }}</a>
          </td>

          <td class="text-right d-print-none">
            <base-go model="clientes" :id="cliente.id"></base-go>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import ClienteBadge from "../Clientes/Badge";
import ClienteCreate from "./Create";

import apis from "../../apis.ts";
export default {
  components: { ClienteBadge, ClienteCreate },
  data() {
    return {
      query: "",
      clientes: [],
      selected: [],
      editmode: false,
      mergeBtn: { class: "warning", text: "Unir Contactos", icon: "compress" }
    };
  },
  mounted() {
    this.$root.$on("clientesUpdate", () => {
      this.getClientes();
    });
    this.getClientes();
  },
  computed: {
    filteredClientes() {
      return this.clientes.filter(cliente => {
        return (
          cliente.nombre.toLowerCase().includes(this.query.toLowerCase()) ||
          cliente.apellido.toLowerCase().includes(this.query.toLowerCase())
        );
      });
    }
  },
  methods: {
    getClientes() {
      apis.getClientes().then(response => (this.clientes = response.data));
    },
    mergeContacts() {
      if (!this.editmode) {
        this.selected = [];
        this.editmode = true;
        this.mergeBtn = { class: "success", text: "Unir", icon: "check" };
      } else {
        axios
          .post(this._appApi+"clientes/merge", { selected: this.selected })
          .then(response => {
            console.log(response.data);
            this.getClientes();
            this.editmode = false;
            this.mergeBtn = {
              class: "warning",
              text: "Unir Contactos",
              icon: "compress"
            };
          })
          .catch(e => console.log(e));
      }
    },
    frecuente(cantidad) {
      return cantidad > 5;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
