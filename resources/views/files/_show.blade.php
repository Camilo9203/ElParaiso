<div class="table-responsive">
  <table id="crudFile" class="table">
    <thead class=" text-primary">
      <th>
        Nombre
      </th>
        <th>
          Fecha de creación
        </th>
        <th>
          Fecha de actualización
        </th>
        <th>
          Acciones
        </th>
      </thead>
      <tbody>
        {{-- @forelse ($files as $file)
          @if ($file->folder_id == $folder->id) --}}
            <tr v-for="file in files">
              <td v-text="file.name"></td>
              <td v-text="file.created"></td>
              <td v-text="file.updated_at"></td>
              <td class="text-primary">
                <a href="">#</a> 
              </td>
            </tr>           
      </tbody>
    </table>
</div>