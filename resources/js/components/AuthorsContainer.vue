<template>
  <div class="container rounded shadow">
    <modal-component title="Agregar autor" trigger="agregar">
      <template #body>
        <form @submit.prevent="agregarNuevoAutor">
          <div class="mb-3">
            <label for="username" class="form-label">Nombre de autor</label>
            <input v-model="formulario.username" type="text" class="form-control" id="username">
            <div id="username" class="form-text text-danger">El campo no puede estar vacio</div>
          </div>
          <div class="mb-3">
            <label for="lastname" class="form-label">Apellido de autor</label>
            <input v-model="formulario.lastname" type="text" class="form-control" id="lastname">
            <div id="lastname" class="form-text text-danger">El campo no puede estar vacio</div>
          </div>
          <div class="mb-3">
            <label for="location" class="form-label">Locación de autor</label>
            <input v-model="formulario.location" type="text" class="form-control" id="location">
          </div>
          <button type="submit" class="btn btn-primary">Subir</button>
        </form>
      </template>
    </modal-component>
    <modal-component title="Editar autor" trigger="editar">
      <template #body>
        <form @submit.prevent="editarAutor">
          <div class="mb-3">
            <label for="username" class="form-label">Nombre de autor</label>
            <input v-model="formulario.username" type="text" class="form-control" id="username">
            <div id="username" class="form-text text-danger">El campo no puede estar vacio</div>
          </div>
          <div class="mb-3">
            <label for="lastname" class="form-label">Apellido de autor</label>
            <input v-model="formulario.lastname" type="text" class="form-control" id="lastname">
            <div id="lastname" class="form-text text-danger">El campo no puede estar vacio</div>
          </div>
          <div class="mb-3">
            <label for="location" class="form-label">Locación de autor</label>
            <input v-model="formulario.location" type="text" class="form-control" id="location">
          </div>
          <button type="submit" class="btn btn-primary">Subir</button>
        </form>
      </template>
    </modal-component>
    <div class="row align-items-center justify-content-between p-2">
      <div class="col-6 fs-3">Autores</div>
      <div class="col-6 d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar">
          Agregar
        </button>
      </div>
    </div>
    <slot :data="{ autores: autores }" />
  </div>
</template>

<script>
const hostname = "http://localhost:8000/api"
export default {
  data: () => ({
    autores: [],
    formulario: {
      username: '',
      lastname: '',
      location: ''
    }
  }),
  mounted() {
    this.obtenerAutores()
  },
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
    async agregarNuevoAutor() {
      try {
        await fetch(`${hostname}/authors`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.formulario)
        })
        alert('Autor agregado')
        await this.obtenerAutores()
      } catch (error) {
        console.log(error)
      }
    },
    obtenerParametrosDeUrl(parametroABuscar) {
      const parametro = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
      });
      return parametro[parametroABuscar]
    }
  },
  async editarAutor() {
      try {
        const id = this.obtenerParametrosDeUrl('id')
        const response = await fetch(`${hostname}/authors/${id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.formulario)
        })
        alert('Autor editado')
        await this.obtenerAutores()
        console.log(response)
      } catch (error) {
        console.log(error)
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
</script>