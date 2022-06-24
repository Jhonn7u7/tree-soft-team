<template>
  <div class="container rounded shadow">
    <div class="row align-items-center justify-content-between p-2">
      <div class="col-6 fs-3">Autores</div>
      <div class="col-6 d-flex justify-content-end">
        <button class="btn btn-primary">Agregar</button>
      </div>
    </div>
    <slot :data="{ message: 'hola' }" />
  </div>
</template>

<script>
export default {

}
</script>