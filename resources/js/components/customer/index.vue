<template lang="html">
  <div>
    <div class="d-flex justify-content-between">
      <div class="">
        <span class="h1">Comensales</span>
      </div>
      <div class="my-auto">
        <router-link class="btn btn-info" to="/customer/create">Nuevo <i data-feather='plus'></i></router-link>
        <!-- <a href="" class="btn btn-info">Nuevo <i data-feather='plus'></i></a> -->
      </div>
    </div>
    <hr>
    <table class="table table-striped table-bordered">
      <thead>
        <th>N° de DNI</th>
        <th>Nombre</th>
        <th>Empresa</th>
        <th>Oficina</th>
        <th>Grupo Laboral</th>
        <th>Opciones</th>
      </thead>
      <tbody>
          <tr v-for='(item, index) in customers'>
            <td>{{ item.dni }}</td>
            <td class="text-capitalize">{{ `${item.father_surname} ${item.mother_surname} ${item.name}` }}</td>
            <td class="text-capitalize">{{ item.business.name }}</td>
            <td>{{ item.office.name }}</td>
            <td>{{ item.job.name }}</td>
            <td>
              <router-link :to='{path: `customer/${item.id}/edit`}'>Editar</router-link>
            </td>
          </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$http.get('customers').then(response => {
      this.customers = response.body.customers;
    }, response => {

    })
  },
  data() {
    return {
      customers: [],
    }
  }
}
</script>

<style lang="css">
</style>
