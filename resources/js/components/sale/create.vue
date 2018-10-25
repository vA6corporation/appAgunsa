<template>
  <div>
    <div class="d-flex justify-content-between">
      <div class="">
        <!-- <div class="">
          <span class="h1">Registro de orden</span>
        </div> -->
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Horario de orden</span>
          </div>
          <select class="custom-select" v-model='order.type' required>
            <option value="desayuno">Desayunos</option>
            <option value="almuerzo">Almuerzos</option>
            <option value="cena">Cenas</option>
          </select>
        </div>
      </div>
      <div class="my-auto">
        <button class="btn btn-info" type="button" @click='submit()'>Guardar <i data-feather='save'></i></button>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-4">
        <form @submit.prevent='addOrder()'>
          <select class="custom-select form-group" v-model='order.option' required>
            <option value="opcion1">Opcion1</option>
            <option value="opcion2">Opcion2</option>
            <option value="ejecutivo">Ejecutivo</option>
            <option value="dieta">Dieta</option>
          </select>
          <select class="custom-select form-group" v-model='order.entry' required>
            <option value="entrada">Entrada</option>
            <option value="sopa">Sopa</option>
          </select>
          <textarea class="form-control form-group" v-model='order.observation' rows="2" placeholder="Observacion(Opcional)"></textarea>
          <textarea class="form-control form-group" v-model='excel' @input='loadExcel()' rows="2" placeholder="Copiar desde Excel(Opcional)"></textarea>
          <typeahead ref='tepeahead' placeholder='Nombres del Cliente' :items='customers'></typeahead>
          <button class="btn btn-info float-right" type="submit">Agregar Orden <i data-feather='plus'></i> </button>
        </form>
      </div>
      <div class="col-8">
        <!-- <h3>Desayunos</h3>
        <hr> -->
        <table class="table table-sm table-striped text-capitalize">
          <thead>
            <th>Cliente</th>
            <!-- <th>Empresa</th> -->
            <th>Opcion</th>
            <th>Entrada/Sopa</th>
            <th>Acciones</th>
          </thead>
          <tbody>
            <tr v-for='(item, index) in sales'>
              <input type="text" :name='`sales[${index}][customer_id]`' :value='item.customer_id' hidden>
              <input type="text" :name='`sales[${index}][type]`' :value='order.type' hidden>
              <input type="text" :name='`sales[${index}][entry]`' :value='item.entry' hidden>
              <input type="text" :name='`sales[${index}][option]`' :value='item.option' hidden>
              <input type="text" :name='`sales[${index}][observation]`' :value='item.observation' hidden>
              <td>{{ item.customer_name }}</td>
              <!-- <td>Empresa</td> -->
              <td>{{ item.option }}</td>
              <td>{{ item.entry }}</td>
              <td>
                <a href="#" @click='removeOrder(index)'>Quitar</a>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- <ul class="list-group">
          <li class="list-group-item" v-for='(item, index) in orders'>{{ item.customer_name }}</li>
        </ul> -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$root.$on('pickItem', data => {
      console.log(data);
      var customer = data;
      this.order.customer_name = `${customer.father_surname} ${customer.mother_surname} ${customer.name}`;
      this.order.customer_id = customer.id;
    });
    this.$http.get('customers').then(response => {
      console.log(response);
      this.customers = response.body.customers;
    }, response => {
      // var customer = data;
      // this.order.customer_name = `${customer.father_surname} ${customer.mother_surname} ${customer.name}`;
      // this.order.customer_id = customer.id;
    })
  },
  data() {
    return {
      order: {
        customer_name: '',
        customer_id: '',
        type: 'desayuno',
        entry: 'entrada',
        option: 'opcion1',
        observation: '',
      },
      excel: '',
      sales: [],
      customers: [],
    }
  },
  methods: {
    addOrder: function() {
      if (this.order.customer_id) {
        var order = {};
        Object.assign(order, this.order);
        this.sales.push(order);
        this.order.customer_id = '';
        this.$refs.tepeahead.key = '';
      } else {
        this.$root.$emit('message', 'El cliente no ha podido ser identificado');
      }
    },
    removeOrder: function(index) {
      this.sales.splice(index, 1);
    },
    submit: function(event) {
      this.$http.post('sales', {sales: this.sales}).then(response => {
        console.log(response);
        this.$root.$emit('message', 'Ordenes ingresadas correctamente');
        this.sales = [];
      }, response => {
        console.log(response);
      })
    },
    loadExcel: function() {
      // 73064758		X	X
      // 55555555		X				X
      // 99999999		X			X
      var orders = [];
      var ordersString = this.excel.split('\n');
      ordersString.splice(ordersString.length-1, 1);
      ordersString.forEach((item, index) => {
        var order = {};
        var orderString = item.split('\t');
        var customerDni = orderString[0];
        this.customers.forEach(customer => {
          if(customer.dni == customerDni) {
            order.customer_id = customer.id;
            order.customer_name = `${customer.father_surname} ${customer.mother_surname} ${customer.name}`;
          };
          if(orderString[1]) {
            order.entry = 'sopa';
          } else {
            order.entry = 'entrada';
          }
          if(orderString[3]) {
            order.option = 'opcion1';
          } else if(orderString[4]) {
            order.option = 'opcion2';
          } else if(orderString[5]) {
            order.option = 'ejecutivo';
          } else {
            order.option = 'dieta';
          }
        });
        this.sales.push(order);
        this.excel = '';
      });
      // this.excel.split('\n').forEach((row, index) => {
      //   // orders.push(row);
      //   row.split('\t').forEach((item, subIndex) => {
      //     var customerDni = item[0];
      //     this.customers.forEach(customer => {
      //       if(customer.dni == customerDni) {};
      //     });
      //   });
      // });
      console.log(orders);
      // this.excel.split('\n').forEach((row, index) => {
      //   console.log(row);
      //   order[index] = row.split('\t');
      //   row.split('\t').forEach((item, subIndex) => {
      //     if(item) {
      //       console.log(item)
      //     } else {
      //       console.log('vacio');
      //     }
      //
      //   });
      // });
    },
    loadTemplate: function() {
      try {
        this.template.split('\n').forEach((column, index) => {
          //if(!column.split('\t').length < 7) throw Error('Los datos insertados son inconsistentes, le recomenedamos usar la plantilla de TaiSale');
          if(!index) {
            this.lineLength = column.split('\t').length;
            column.split('\t').forEach(item => {
              console.log('ingresamos');
              if(!this.tableHeaders.includes(item)) throw Error();
            });
          } else {
            console.log(this.lineLength == column.split('\t').length);
            if(this.lineLength == column.split('\t').length) {
              var product = {};
              column.split('\t').forEach((item, subIndex) => {
                product[this.tableHeaders[subIndex]] = item;
              });
              this.products.push(product);
            } else {
              if(column.length) {
                console.log('Error');
                throw Error();
              }
            }
          }
        })
      } catch(err) {
        showMessage('Los datos insertados son inconsistentes, porfabor use la plantilla de TaiSale');
        this.template = '';
      }
    },
  }
}
</script>
