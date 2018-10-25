<template lang="html">
  <div class="">
    <h1>Reporte de Venta</h1>
    <hr>
    <div class="d-flex justify-content-between">
      <div class="">
        <a class="btn btn-info mr-3" :href='salesLink' target="_blank">Descargar Excel <i data-feather='download'></i></a>
      </div>
      <div class="">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Empresa</span>
          </div>
          <select class="custom-select" v-model='businessId'>
            <option value="">Todas las empresas...</option>
            <option :value='item.id' v-for='(item, index) in businesses'>{{ item.name }}</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <form class="form-inline" @submit.prevent='submit()'>
          <div class="input-group">
            <input class="form-control" v-model='startDate' type="date" required>
            <input class="form-control" v-model='endDate' type="date" required>
            <div class="input-group-append">
              <button class="btn btn-info" type="submit" name="button">Filtrar <i data-feather='filter'></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <table class="table table-striped table-bordered text-capitalize">
      <thead>
        <th>Empresa</th>
        <th>Oficina</th>
        <th>Grupo Labroral</th>
        <th>Comensal</th>
        <th>Comida</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for='(item, index) in sales'>
          <td>{{ item.customer.business.name }}</td>
          <td>{{ item.customer.office.name }}</td>
          <td>{{ item.customer.job.name }}</td>
          <td>{{ `${item.customer.father_surname} ${item.customer.mother_surname} ${item.customer.name}` }}</td>
          <td>{{ item.type }}</td>
          <td> <a href="#">Detalles</a> </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$http.get('businesses').then(response => {
      console.log(response);
      this.businesses = response.body.businesses;
    }, response => {
      console.log(response);
    })
  },
  data() {
    return {
      sales: [],
      businessId: '',
      currentBusiness: {},
      businesses: [],
      startDate: '',
      endDate: '',
    }
  },
  computed: {
    salesLink: function() {
      return `/sales/salesExcel/${this.startDate}/${this.endDate}/${this.currentBusiness.id || ''}`;
    }
  },
  methods: {
    submit: function() {
      this.$http.get(`sales/betweenDates/${this.startDate}/${this.endDate}/${this.businessId}`).then(response => {
        console.log(response);
        this.sales = response.body.sales;
      }, response => {
        console.log(response);
      })
    }
  }
}
</script>

<style lang="css">
</style>
