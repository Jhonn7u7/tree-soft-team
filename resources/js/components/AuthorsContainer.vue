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
const hostname = "http://localhost:8000/api"
export default {
  data: () => ({
    autores: []
  }),
  methods: {
    async obtenerAutores() {
      try {
        const response = await fetch(`${hostname}/authors`, {
          method: "GET"
        });
        const data = await response.json();
        this.autores = data.map(autor => ({
          id: autor.id,
          username: autor.username,
          lastname: autor.lastname,
          location: autor.location,
          createdAt: this.formatDate(autor.created_at),
          updatedAt: this.formatDate(autor.updated_at),
        }));
      }
      catch (error) {
        console.log(error);
      }
    },
     //fin de methods}
   computed: {
      formatDate() {
        const intl = new Intl.DateTimeFormat("es", {
          dateStyle: "medium"
        });
        return (time) => {
          return intl.format(new Date(time));
        };
      }
  },
  }
}
</script>