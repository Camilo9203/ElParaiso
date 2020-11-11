<div v-for="category in categories" class="accordion" id="accordionCategory">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
            <button class="btn btn-primary btn-block text-left" type="button" data-toggle="collapse" data-target="#category.name" aria-expanded="true" aria-controls="collapseOne" v-text="category.name">
            </button>
            </h2>
        </div>
        <div id="category.name" class="collapse" aria-labelledby="headingOne" data-parent="#accordionCategory">
            <div class="card-body">
                @include('files._show')
            </div>
        </div>
    </div>
</div>