<template lang="html">
  <div class="">
    <div class="d-flex justify-content-between">
      <span class="h1">Empresas</span>
      <div class="">
        <router-link class="btn btn-info" to='/business/create'>Agregar <i data-feather='plus'></i> </router-link>
      </div>
    </div>
    <hr>
    <table class="table table-striped table-bordered">
      <thead>
        <th>Razon Social</th>
        <th>RUC</th>
        <th>Domicilio Fiscal</th>
        <th>Sucursales</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for='(item, index) in businesses'>
          <td>{{ item.name }}</td>
          <td>{{ item.ruc }}</td>
          <td>{{ item.address }}</td>
          <td>
            <span v-for='(subItem, subIndex) in item.offices'>
              {{ subItem.name }},
            </span>
          </td>
          <td> <router-link :to='{path: `business/${item.id}/edit`}'>Editar</router-link> </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$http.get('businesses').then(response => {
      this.businesses = response.body.businesses;
    }, response => {
      console.log(response);
    });
  },
  data() {
    return {
      businesses: []
    }
  }
}
</script>

<style lang="css">
</style>
