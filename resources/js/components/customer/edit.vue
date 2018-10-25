<template lang="html">
  <div class="">
    <h1>Editar Comensal</h1>
    <hr>
    <form @submit='submit()' autocomplete="off">
      <input class="form-control form-group" v-model='customer.name' type="text" placeholder="Nombres" required>
      <input class="form-control form-group" v-model='customer.father_surname' type="text" placeholder="Apellido Paterno" required>
      <input class="form-control form-group" v-model='customer.mother_surname' type="text" placeholder="Apellido Materno" required>
      <input class="form-control form-group" v-model='customer.dni' type="text" maxlength="8" placeholder="N° de DNI" required>
      <select class="custom-select form-group" @change='setBusiness($event.target.value)'>
        <option value='' disabled selected>Seleccione Empresa...</option>
        <option v-for='(item, index) in businesses' :value='index'>{{ item.name }}</option>
      </select>
      <select class="custom-select form-group" @change='setOffice($event.target.value)' required>
        <option value="" disabled selected>Seleccione Sucursal...</option>
        <option v-for='(item, index) in currentBusiness.offices' :value='index'>{{ item.name }}</option>
      </select>
      <select class="custom-select form-group" @change='setJob($event.target.value)' required>
        <option value="" disabled selected>Seleccione Grupo Laboral...</option>
        <option v-for='(item, index) in currentBusiness.jobs' :value='index'>{{ item.name }}</option>
      </select>
      <button class="btn btn-info float-right" type="submit" name="button">Guardar <i data-feather='save'></i> </button>
    </form>
  </div>
</template>

<script>
export default {
  mounted() {
    var id = this.$route.params.id;
    this.$http.get('businesses').then(response => {
      console.log(response);
      this.businesses = response.body.businesses;
    }, response => {

    });
    this.$http.get(`customers/${id}`).then(response => {
      console.log(response);
      this.customer = response.body.customer;
    }, response => {

    })
  },
  data() {
    return {
      customer: {},
      currentBusiness: {},
      currentOffice: {},
      currentJob: {},
      businesses: [],
    }
  },
  methods: {
    submit: function() {
      this.$http.post('customers', {customer: this.customer}).then(response => {
        console.log(response);
      }, response => {
        console.log(response);
      })
    },
    setBusiness: function(index) {
      this.currentBusiness = this.businesses[index];
      this.customer.business_id = this.currentBusiness.id;
    },
    setOffice: function(index) {
      this.currentOffice = this.currentBusiness.offices[index];
      this.customer.office_id = this.currentOffice.id;
    },
    setJob: function(index) {
      this.currentJob = this.currentBusiness.jobs[index];
      this.customer.job_id = this.currentJob.id;
    }
  }
}
</script>

<style lang="css">
</style>
