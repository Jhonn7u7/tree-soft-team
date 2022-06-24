<template>
  <table class="table">
    <thead>
      <tr class="text-center">
        <th scope="col">#</th>
        <th v-for="(head, i) in headings" :key="i">{{ head }}</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr class="text-center" v-for="(row, i) in contents" :key="i + 1">
        <td v-for="(prop, j) of row" :key="j">
          {{ prop ? prop : 'No definido' }}
        </td>
        <td class="d-flex justify-content-center align-items-center gap-2">
          <button @click="manejadorDeEdicion(row)" type="button" class="btn btn-warning" data-bs-toggle="modal"
            data-bs-target="#editar">
            Editar
          </button>
          <button @click="manejadorDeEdicion(row)" type="button" class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#eliminar">
            Eliminar
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ["headings", "contents"], // -> ['id', 'name']
  methods: {
    async manejadorDeEdicion({ id }) {
      if ('URLSearchParams' in window) {
        var searchParams = new URLSearchParams(window.location.search)
        searchParams.set("id", id);
        var newRelativePathQuery = window.location.pathname + '?' + searchParams.toString();
        history.pushState(null, '', newRelativePathQuery);
      }
    }
  }
}
</script>