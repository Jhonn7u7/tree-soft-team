<template>



  <div class="container rounded shadow">
    <modal-component title="Agregar autor" trigger="agregar">
      <template #body>
        <form>
          <div class="mb-3">
            <label for="username" class="form-label">Nombre de autor</label>
            <input v-model="formulario.username" type="text" class="form-control" id="username">
            <div v-if="isEmpty(formulario.username)" id="username" class="form-text text-danger">El campo no puede estar vacio</div>
          </div>
          <div class="mb-3">
            <label for="lastname" class="form-label">Apellido de autor</label>
            <input v-model="formulario.lastname" type="text" class="form-control" id="lastname">
            <div v-if="isEmpty(formulario.lastname)" id="lastname" class="form-text text-danger">El campo no puede estar vacio</div>
          </div>
          <div class="mb-3">
            <label for="location" class="form-label">Locación de autor</label>
            <input v-model="formulario.location" type="text" class="form-control" id="location">
          </div>
        </form>
      </template>
      <template #actions>
          <button type="submit" class="btn btn-primary" @click="agregarNuevoAutor" data-bs-dismiss="modal">Subir</button>
      </template>
    </modal-component>




    <modal-component title="Eliminar autor" trigger="eliminar">
      <template #body>
        <p>¿Estas seguro que deseas eliminar el registro?</p>
      </template>
      <template #actions>
          <button class="btn btn-danger" data-bs-dismiss="modal" @click="eliminarAutor">Eliminar</button>
      </template>
    </modal-component>

    <modal-component title="Editar autor" trigger="editar">
      <template #body>
        <form @submit.prevent="editarAutor" >
          <div class="mb-3">
            <label for="username" class="form-label">Nombre de autor</label>
            <input v-model="formulario.username" type="text" class="form-control" id="username">
            <div v-if="isEmpty(formulario.username)" id="username" class="form-text text-danger">El campo no puede estar vacio</div>
          </div>
          <div class="mb-3">
            <label for="lastname" class="form-label">Apellido de autor</label>
            <input v-model="formulario.lastname" type="text" class="form-control" id="lastname">
            <div v-if="isEmpty(formulario.lastname)" id="lastname" class="form-text text-danger">El campo no puede estar vacio</div>
          </div>
          <div class="mb-3">
            <label for="location" class="form-label">Locación de autor</label>
            <input v-model="formulario.location" type="text" class="form-control" id="location">
          </div>
          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Subir</button>
        </form>
      </template>
      <!-- <template #actions>
      </template> -->
    </modal-component>



    <div class="row align-items-center justify-content-between p-2">
      <div class="col-6 fs-3">Autores</div>
      <div class="col-6 d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar">
          Agregar
        </button>
      </div>
    </div>
    <div class="row">
      <div class="col-4">
        <input v-model="buscar" type="text" class="form-control" placeholder="Buscar autor | Nombre | Apellido">
      </div>
    </div>
    <slot :data="{ autores: filtrado }" />
  </div>
</template>

<script>
const hostname = "http://localhost:8000/api"

export default {

  data: () => ({
    autores: [],
    buscar: '',
    formulario: {
      username: '',
      lastname: '',
      location: ''
    },
  
  }),
  mounted() {
    this.obtenerAutores()
    // this.datosEditar()
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
    },



    async datosEditar(idllegado){

      console.log(idllegado);

      //   try {
      //   const id = this.obtenerParametrosDeUrl('id')
      //   const response = await fetch(`${hostname}/authors/${id}`, {
      //     method: 'GET',
      //   })
      //   const data = await response.json();
      //   this.autores = data.map(autor => ({
      //     id: autor.id,
      //     username: autor.username,
      //     lastname: autor.lastname,
      //     location: autor.location,
      //     createdAt: this.formatDate(autor.created_at),
      //     updatedAt: this.formatDate(autor.updated_at),
      //   }));

      //   console.log(data);
      // } catch (error) {
      //   console.log(error)
      // }

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
    async eliminarAutor() {
      try {
        const id = this.obtenerParametrosDeUrl('id')
        const response = await fetch(`${hostname}/authors/${id}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json'
          }
        })
        console.log(response)
        alert('Elminado con exito')
        await this.obtenerAutores()
      } catch (error) {
        console.log(error)
      }
    },
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
    },
    filtrado() {
      const aBuscar = this.buscar.toLowerCase()
      return this.autores.filter(
        autor =>
          autor.username.toLowerCase().trim().includes(aBuscar) ||
          autor.lastname.toLowerCase().trim().includes(aBuscar)
      )
    },
    isEmpty() {
      return (elementoARevisar = "") => {
        return elementoARevisar.length <= 0
      }
    }
  },
}
</script>