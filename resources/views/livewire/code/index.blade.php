<div class="container">

    <div class="row">
        <div class="container">
            @if (session()->has('message'))
            <div class="alert alert-success text-center font-weight-bold h4">
                {{ session('message') }}
            </div>

            @endif
        </div>
        <div class="col-md-4 col-sm-6 ">
            <div class="col-12">
                <form class="form-inline">
                    <label class="my-1 mr-2">Preference</label>
                    <select wire:model='CodeLocation' class="custom-select my-1 mr-sm-2">
                        <option >Choose...</option>
                        <option selected>Create</option>
                        <option>Route</option>
                        <option>Class</option>
                        <option>Design</option>
                    </select>
            </div>
<form class="form-inline">
    <div class="form-group">
        <label for="inputPassword6">Table</label>
        <input type="text"   class="form-control mx-sm-3" >
      
    </div>
</form>
            @if($CodeLocation=="Create")
            <div>
                <form>
                    <div class="form-group">
                        <label for="code">Title :</label>
                        <input wire:model='form.title' type="text" class="form-control" id="title">
                    </div>
                    <div class="form-group">
                        <label for="code">Code :</label>
                        <input wire:model='form.code' type="text" class="form-control" id="code">
                    </div>
                    <div class="form-group">
                        <label for="code">Notes :</label>
                        <input wire:model='form.notes' type="text" class="form-control" id="notes">
                    </div>
                    @if( $isNew ==true)
                    <button wire:click.prevent='submit' class="btn btn-info btn-block">Add Code</button>
                    @else
                    <button wire:click.prevent='update' class="btn btn-info btn-block">Update Task</button>
                    @endif

                </form>
            </div>
            @else
            
            @endif



        </div>
        <div class="col-md-8 col-sm-6 ">
            <h1 class="text-center "> Code ( {{$count}} ) </h1>
            <table class="table table-dark  ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Code</th>
                        <th scope="col">Notes</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach($codes as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{$item->title}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->notes}}</td>
                        <td>
                            <button wire:click='destroy({{$item->id}})' class="btn btn-danger btn-small">Del</button>
                            <button wire:click='show({{$item }})' class="btn btn-info btn-small">Show</button>
                        </td>
                    </tr>
                    @endforeach




                </tbody>
            </table>
            <div class="links">

                {{ $codes->links() }}

            </div>
        </div>
    </div>
</div>

</div>