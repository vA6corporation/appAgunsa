<template>
  <div class="position-relative form-group">
    <input
      class="form-control"
      type="text"
      v-model='key'
      :placeholder="placeholder"
      @keyup='keyUp($event)'
      @focus='focus = true'
      @blur='focus = false'
      required>
    <ul class="list-group position-absolute w-100 text-capitalize" v-if='results.length'>
      <a class="list-group-item" href="#" v-for='(item, index) in results' @click.prevent='pickItem(index)'>
        {{ `${item.father_surname} ${item.mother_surname} ${item.name}` }}
      </a>
    </ul>
    <ul class="list-group position-absolute w-100" v-else-if='key && focus'>
      <li class="list-group-item">Sin resultados</li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    placeholder: {
      type: String,
      required: true,
    },
    items: {
      type: Array,
      required: true,
    }
  },
  data () {
    return {
      focus: null,
      active: '',
      key: '',
      results: [],
    };
  },
  methods: {
    pickItem: function(index) {
      var item = this.results[index];
      this.key = `${item.father_surname} ${item.mother_surname} ${item.name}`
      this.results = [];
      this.$root.$emit('pickItem', item);
    },
    keyUp (event) {
      if (this.key) {
        this.results = [];
        this.results = this.items.filter((item) => {
          var name = `${item.father_surname} ${item.mother_surname} ${item.name}`
          return name.indexOf(event.target.value) >= 0;
          // return item.name.indexOf(event.target.value) >= 0
        })
      } else {
        this.results = [];
      }
    }
  }
}
</script>
