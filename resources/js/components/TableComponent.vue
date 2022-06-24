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
      <tr class="text-center" v-for="(row, i) in contents" :key="i">
        <td v-for="prop of row" :key="prop">
          {{ prop ? prop : 'No definido' }}
        </td>
        <td class="d-flex justify-content-center align-items-center gap-2">
          <button class="btn btn-warning">Editar</button>
          <button class="btn btn-danger">Eliminar</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ['headings', 'contents'] // -> ['id', 'name']
}
</script>