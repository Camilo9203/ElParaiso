<template>
  <div class="col-12">
    <div class="col-12 text-left">
      <router-link class="btn btn-sm btn-primary" :to="{ name: 'data' }"
        ><span class="material-icons">home</span></router-link
      >
      <a
        href=""
        data-toggle="modal"
        data-target="#fileModal"
        class="btn btn-sm btn-primary"
        ><span class="material-icons">attachment</span> Nuevo Archivo</a
      >
      <a
        href=""
        data-toggle="modal"
        data-target="#categoryModal"
        class="btn btn-sm btn-primary"
        ><span class="material-icons">category</span> Categorias</a
      >
    </div>
    <!-- Table -->
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title" v-text="'Documentación de ' + folder.name"></h4>
        <h5 class="card-category" v-text="'C.C. ' + folder.id"></h5>
        <p class="card-category">Aquí puede administrar archivos</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table
            id="fileTable"
            class="table table-hover table-striped text-center"
            style="width: 100%"
          >
            <thead class="text-primary">
              <tr>
                <th>Nombre</th>
                <th>Creado</th>
                <th>Categoria</th>
                <th>Fecha de Creación</th>
                <th>Fecha de Actualización</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="file in files" :key="file.id">
                <td v-text="file.name"></td>
                <td v-text="file.created"></td>
                <td v-text="file.category.name"></td>
                <td v-text="since(file.created_at)"></td>
                <td v-text="dirHuman(file.updated_at)"></td>
                <td class="td-actions">
                  <!-- <a href="#" @click.prevent="loadFieldsUpdate(folder.id)">
                    <i class="material-icons">edit</i>
                    <div class="ripple-container"></div>
                  </a> -->
                  <a href="#" @click="deleteFile(file)">
                    <i class="material-icons">delete</i>
                  </a>
                  <a href="#" @click.prevent="downloadFile(file)">
                    <i class="material-icons">download</i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modals -->
    <!-- Form File -->
    <div
      class="modal fade"
      id="fileModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="fileModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="card">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title" v-if="update == 0">
                  <strong>Subir Archivo</strong>
                </h4>
                <h4 class="card-title" v-if="update != 0">
                  <strong>Editar Archivo</strong>
                </h4>
              </div>

              <div class="card-body">
                <!-- {{-- File --}} -->
                <div class="bmd-form-group mt-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">attach_file</i>
                      </span>
                    </div>
                    <input
                      type="file"
                      name="file"
                      accept=".pdf"
                      @change="getFile"
                      class="form-control"
                    />
                  </div>

                  <div
                    v-if="!$v.file.required"
                    class="error text-danger pl-3"
                    for="category"
                    style="display: block"
                  >
                    <strong>Archivo requerido</strong>
                  </div>
                </div>

                <!-- {{-- Category --}} -->
                <div
                  class="bmd-form-group mt-3"
                  :class="{ 'has-danger': $v.category_id.$error }"
                >
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">category</i>
                      </span>
                    </div>
                    <v-select
                      :options="categories"
                      :reduce="(categories) => categories.id"
                      label="name"
                      v-model="$v.category_id.$model"
                      @input="selectCategory"
                      class="col-10"
                    ></v-select>
                  </div>
                  <!-- Error -->
                  <div
                    v-if="!$v.category_id.required"
                    class="error text-danger pl-3"
                    for="category"
                    style="display: block"
                  >
                    <strong>Categoria requerida</strong>
                  </div>
                </div>

                <!-- {{-- addField --}} -->
                <div
                  class="bmd-form-group mt-3"
                  :class="{ 'has-danger': $v.addField.$error }"
                  v-if="setCategory != null"
                >
                  <!-- Number -->
                  <div
                    class="input-group"
                    v-if="(setCategory != 1) & (setCategory != 10)"
                  >
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">confirmation_number</i>
                      </span>
                    </div>
                    <input
                      type="number"
                      v-model="$v.addField.$model"
                      class="form-control col-10"
                      placeholder="0000"
                      required
                    />
                  </div>
                  <!-- NameDocument -->
                  <div class="input-group" v-if="setCategory == 10">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">insert_drive_file</i>
                      </span>
                    </div>
                    <input
                      type="text"
                      v-model="$v.addField.$model"
                      class="form-control col-10"
                      placeholder="Nombre del documento"
                      required
                    />
                  </div>
                  <!-- Death -->
                  <div class="input-group" v-if="setCategory == 1">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">face</i>
                      </span>
                    </div>
                    <v-select
                      :options="options"
                      v-model="$v.addField.$model"
                      class="col-10"
                    ></v-select>
                  </div>
                  <!-- Errors -->
                  <div
                    v-if="!$v.addField.required"
                    class="error text-danger pl-3"
                    for="number"
                    style="display: block"
                  >
                    <strong>Campo requerido</strong>
                  </div>
                  <div
                    v-if="!$v.addField.minLength"
                    class="error text-danger pl-3"
                    for="number"
                    style="display: block"
                  >
                    <strong>Minimo 2 caracteres</strong>
                  </div>
                </div>

                <!-- Created -->
                <div
                  class="bmd-form-group mt-3"
                  :class="{ 'has-danger': $v.created.$error }"
                >
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">date_range</i>
                      </span>
                    </div>
                    <input
                      type="date"
                      v-model="$v.created.$model"
                      class="form-control"
                      placeholder="Fecha de creación"
                      required
                    />
                  </div>
                  <div
                    v-if="!$v.created.required"
                    class="error text-danger pl-3"
                    for="category"
                    style="display: block"
                  >
                    <strong>Fecha de creación requerida</strong>
                  </div>
                </div>
                <!-- {{-- Buttons --}} -->
                <div class="card-footer justify-content-center">
                  <!-- Close -->
                  <button
                    @click.prevent="clearFields()"
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                    data-backdrop="false"
                  >
                    Cerrar
                  </button>
                  <!-- Create -->
                  <button
                    v-if="update == 0"
                    :disabled="$v.$invalid"
                    @click="saveFile()"
                    type="submit"
                    class="btn btn-primary"
                  >
                    Crear Archivo
                  </button>
                  <!-- Edit -->
                  <button
                    v-if="update != 0"
                    :disabled="$v.$invalid"
                    @click="updateFile()"
                    type="submit"
                    class="btn btn-primary"
                  >
                    Editar Archivo
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Categories -->
    <div
      class="modal fade"
      id="categoryModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="categoryModalLabel"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-lg modal-dialog-scrollable"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-body">
            <div class="card">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title"><strong>Categorias</strong></h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="fileTable"
                    class="table table-hover table-striped text-center"
                    style="width: 100%"
                  >
                    <thead class="text-primary">
                      <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="category in categories" :key="category.id">
                        <td v-text="category.id"></td>
                        <td v-text="category.name"></td>
                        <td v-text="category.description"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
  required,
  numeric,
  minLength,
  maxLength,
} from "vuelidate/lib/validators";
import moment from "moment";
import axios from "axios";
moment.locale("es");

export default {
  props: ["id"],
  data() {
    return {
      categories: [],
      files: [],
      folder: [],
      name: "",
      description: null,
      created: "",
      category_id: "",
      folder_id: "",
      file: "",
      errors: [],
      update: 0,
      setCategory: null,
      addField: "",
      options: ["Titular", "Fallecido"],
    };
  },
  created() {
    this.getFiles();
    this.folder_id = this.id;
    // GetCategories
    var url = "../api/categories/";
    axios.get(url).then((response) => {
      this.categories = response.data;
    });
    // GetFolders
    var url = "/folder-manager/" + this.id;
    axios.get(url).then((response) => {
      this.folder = response.data;
    });
  },
  validations: {
    addField: { required, minLength: minLength(2) },
    created: { required },
    category_id: { required },
    file: { required },
  },
  methods: {
    fileTable: function () {
      $(function () {
        $("#fileTable").DataTable({
          language: {
            url:
              "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json",
          },
        });
      });
    },
    since: function (d) {
      return moment(d).format("LL");
    },
    dirHuman: function (d) {
      return moment(d).fromNow();
    },
    getFiles: function () {
      var url = "/file-manager/" + this.id;
      axios.get(url).then((response) => {
        this.files = response.data;
        this.fileTable();
      });
    },
    getFile: function (event) {
      this.file = event.target.files[0];
    },
    selectCategory: function () {
      this.addField = "";
      this.name = "";
      this.setCategory = this.category_id;
      if (this.setCategory != 10) {
        this.name = this.categories[this.setCategory - 1].name;
      }
    },
    saveFile: function () {
      //Create formData
      var data = new FormData();
      this.name = this.name + " " + this.addField;
      //Add to image selected
      data.append("file", this.file);
      data.append(
        "name",
        this.name
          .trim()
          .toLowerCase()
          .replace(/\w\S*/g, (w) => w.replace(/^\w/, (c) => c.toUpperCase()))
      );
      data.append("created", this.created);
      data.append("category_id", this.category_id);
      data.append("folder_id", this.folder_id);
      //Add method PUT
      var url = "/file-manager";
      axios
        .post(url, data)
        .then((response) => {
          $("#fileTable").DataTable().destroy();
          this.getFiles();
          swal("¡Buen trabajo!", "¡Archivo creado con exito!", "success");
          this.clearFields();
        })
        .catch((error) => {
          console.log(response.data);
          this.errors = error.response.data;
          swal(
            "¡El archivo no fue creado!",
            "Revisa la información y vuelve a intentar",
            "warning"
          );
        });
    },
    downloadFile: function (file) {
      var url = "/downloads/" + file.id;
      window.open(url);
      axios
        .get(url)
        .then((response) => {
          swal("¡Archivo descargado exitosamente!", "", "success");
        })
        .catch(function (error) {
          console.log(error.response.data.errors);
          swal("¡Error al descargar archivo!", "", "warning");
        });
    },
    updateFolder: function () {
      var data = new FormData();
      data.append("file", this.file);
      data.append("name", this.name);
      data.append("created", this.created);
      data.append("category_id", this.category_id);
      data.append("folder_id", this.folder_id);
      var url = "/file-manager";
      axios
        .put(url, data)
        .then((response) => {
          $("#fileTable").DataTable().destroy();
          this.getFiles();
          this.name = "";
          this.created = "";
          this.category_id = "";
          this.file = "";
          this.errors = [];
          swal("¡Buen trabajo!", "¡Archivo actualizado con exito!", "success");
          $("#fileModal").modal("hide");
        })
        .catch((error) => {
          console.log(response.data);
          this.errors = error.response.data;
          swal(
            "¡El archivo no fue actualizado!",
            "Revisa la información y vuelve a intentar",
            "warning"
          );
        });
    },
    deleteFile: function (file) {
      var url = "../file-manager/" + file.id;
      swal({
        title: "¿Estás seguro?",
        text:
          "Una vez eliminado, usted no será capaz de recuperar este carpeta!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          axios
            .delete(url)
            .then((response) => {
              $("#fileTable").DataTable().destroy();
              this.getFiles();
              swal(
                "¡Buen trabajo!",
                "La carpeta fue eliminada con exito",
                "success"
              );
            })
            .catch(function (error) {
              this.getFiles();
              swal(
                "¡La carpeta no fue eliminada!",
                "Esta carpeta contiene archivos",
                "warning"
              );
            });
        } else {
          swal("¡Tu carpeta esta a salvo!");
        }
      });
    },
    loadFieldsUpdate: function (file) {
      this.update = file.id;
      var url = "../file-manager/" + file.id;
      $("#fileModal").modal("show");

      axios
        .get(url)
        .then((response) => {
          this.name = response.data.name;
          this.created = response.data.created;
          this.category_id = response.data.category_id;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    clearFields: function () {
      $("#fileModal").modal("hide");
      this.name = "";
      this.data = "";
      this.created = "";
      this.category_id = "";
      this.file = "";
      this.update = "";
      this.setCategory = null;
      this.addField = "";
      this.errors = [];
    },
  },
};
</script>
