<template lang="html">
  <div class="col-12">
    <h1>Nueva Empresa</h1>
    <hr>
    <form @submit.prevent='submit()' autocomplete="off">
      <input class="form-control form-group" type="text" v-model='business.name' placeholder="Razon Social" required>
      <input class="form-control form-group" type="text" v-model='business.ruc' maxlength="11" placeholder="N° de RUC" required>
      <input class="form-control form-group" type="text" v-model='business.address' placeholder="Domicilio Fiscal" required>
      <div class="form-group">
        <ul class="list-group">
          <li class="list-group-item list-group-item-info d-flex justify-content-between">
            Oficinas
            <a href='#' data-toggle='modal' data-target='#officeModal'>Agregar</a>
          </li>
          <li class="list-group-item text-capitalize" v-for='(item, index) in business.offices'>{{ item.name }}</li>
        </ul>
      </div>
      <div class="form-group">
        <ul class="list-group">
          <li class="list-group-item list-group-item-info d-flex justify-content-between">
            Grupos Laborales
            <a href='#' data-toggle='modal' data-target='#jobModal'>Agregar</a>
          </li>
          <li class="list-group-item text-capitalize" v-for='(item, index) in business.jobs'>{{ item.name }}</li>
        </ul>
      </div>
      <button class="btn btn-info float-right" type="submit">Guardar <i data-feather='save'></i></button>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="officeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form @submit.prevent='addOffice()'>
            <div class="modal-header">
              <h5 class="modal-title">Nueva Sucursal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input class="form-control" v-model='office' type="text" placeholder="Nombre de la sucursal" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar <i data-feather='x'></i> </button>
              <button type="submit" class="btn btn-primary">Guardar <i data-feather='save'></i> </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form @submit.prevent='addJob()'>
            <div class="modal-header">
              <h5 class="modal-title">Nuevo Grupo Laboral</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input class="form-control" v-model='job' type="text" placeholder="Nombre del grupo laboral" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar <i data-feather='x'></i> </button>
              <button type="submit" class="btn btn-primary">Guardar <i data-feather='save'></i> </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      office: '',
      job: '',
      business: {
        offices: [
          {name: 'principal'},
        ],
        jobs: [
          {name: 'administrativo'},
        ],
      },
    }
  },
  methods: {
    submit: function() {
      this.$http.post('businesses', {business: this.business}).then(response => {
        this.$router.push({path: '/business'});
        this.$root.$emit('message', 'La empresa se ha creado correctamente');
      }, response => {
        console.log(response);
      });
    },
    addOffice: function() {
      this.business.offices.push({name: this.office});
      $('.modal').modal('hide');
    },
    addJob: function() {
      this.business.jobs.push({name: this.job});
      $('.modal').modal('hide');
    }
  }
}
</script>

<style lang="css">
</style>
